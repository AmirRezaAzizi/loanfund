<?php

namespace App\Http\Controllers;

use App\Bankbook;
use App\Loan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class BulkReceiptController extends Controller
{
    public function index()
    {

        return view('owner.bulk-receipt');
    }

    public function store(Request $request)
    {
        switch ($request->action) {
            case 'bankbooks':
                return $this->createBankbookReceipts();
                break;

            case 'loans':
                return $this->createLoanReceipts();
                break;

            default:
                throw new \Exception('نوع اشتباه است.');
        }
    }

    public function createBankbookReceipts()
    {
        $date = convertNumbers(jdate()->format('Y/m/') . '30');

        $DBdate = CalendarUtils::createCarbonFromFormat('Y/m/d', convertNumbers($date, true))->format('Y-m-d');
        $bankbooks = Bankbook::active()
            ->where('monthly', '>', 0)
            ->whereHas('bankbookReceipts', function (Builder $query) use ($DBdate) {
                $query->where('date', $DBdate)
                    ->where('type', 'deposit');
            }, '==', 0)
            ->get();


        $today = Jalalian::forge('today')->format('%d %B %Y');
        $description = "این قبض در تاریخ $today بصورت گروهی ایجاد شده است.";

        $count = 0;
        try {
            DB::beginTransaction();

            foreach ($bankbooks as $bankbook) {
                $bankbook->bankbookReceipts()->create([
                    'amount' => $bankbook->monthly,
                    'description' => $description,
                    'type' => 'deposit',
                    'date' => $date,
                ]);

                $count += 1;
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }

        return view('owner.bulk-receipt')->with('successMsg', "تعداد $count قبض پس انداز با موفقیت ایجاد شد.");

    }

    public function createLoanReceipts()
    {
        $date = convertNumbers(jdate()->format('Y/m/') . '30');

        $DBdate = CalendarUtils::createCarbonFromFormat('Y/m/d', convertNumbers($date, true))->format('Y-m-d');
        $loans = Loan::active()
            ->where('monthly', '>', 0)
            ->whereHas('loanReceipts', function (Builder $query) use ($DBdate) {
                $query->where('date', $DBdate);
            }, '==', 0)
            ->get();


        $today = Jalalian::forge('today')->format('%d %B %Y');
        $description = "این قبض در تاریخ $today بصورت گروهی ایجاد شده است.";

        $count = 0;
        $debtIsLessThanMonthly = array();
        $doneLoans = array();
        try {
            DB::beginTransaction();

            foreach ($loans as $loan) {
                if ($loan->now_balance() >= $loan->monthly) {
                    $loan->loanReceipts()->create([
                        'amount' => $loan->monthly,
                        'description' => $description,
                        'date' => $date,
                    ]);

                    $count += 1;

                    if ($loan->now_balance() - $loan->monthly == 0) {
                        $loan->status = 'inactive';
                        $loan->closed_date = convertNumbers(jdate()->format('Y/m/d'));
                        $loan->description = $loan->description . ' | ' . "این وام در تاریخ $today در فرآیند صدور قبض گروهی غیرفعال شده است.";
                        $loan->save();

                        $doneLoans[] = $loan;
                    }

                } else {
                    $debtIsLessThanMonthly[] = $loan;
                }
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }

        return view('owner.bulk-receipt', [
            'successMsg' => "تعداد $count قبض وام با موفقیت ایجاد شد.",
            'debtIsLessThanMonthly' => $debtIsLessThanMonthly,
            'doneLoans' => $doneLoans,
        ]);
    }
}
