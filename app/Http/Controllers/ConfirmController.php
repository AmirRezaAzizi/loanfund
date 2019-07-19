<?php

namespace App\Http\Controllers;


use App\BankbookReceipt;
use App\JournalRecord;
use App\Loan;
use App\LoanReceipt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;

class ConfirmController extends Controller
{
    public function confirm()
    {
        DB::beginTransaction();
        try {

            $loans = Loan::where('confirmed', 0)->with('bankbook')->get();
            foreach ($loans as $loan) {
                JournalRecord::create([
                    'bankbook_code' => $loan->bankbook->full_code,
                    'bankbook_title' => $loan->bankbook->title,
                    'title' => trans('global.journal.giveLoan'),
                    'journalable_type' => 'loan',
                    'journalable_id' => $loan->id,
                    'bed' => 0,
                    'bes' => $loan->total,
                    'date' => $loan->created_date,
                ]);
                $loan->confirmed = 1;
                $loan->save();
            }

            $bankbookReceipts = BankbookReceipt::where('confirmed', 0)->with('bankbook')->get();
            foreach ($bankbookReceipts as $bankbookReceipt) {
                $bankbookRecord = [
                    'date' => $bankbookReceipt->date,
                    'bankbook_code' => $bankbookReceipt->bankbook->full_code,
                    'bankbook_title' => $bankbookReceipt->bankbook->title,
                    'journalable_type' => 'bankbookReceipt',
                    'journalable_id' => $bankbookReceipt->id,
                ];

                switch ($bankbookReceipt->type) {
                    case 'deposit':
                        $bankbookRecord['title'] = trans('global.journal.BankbookDeposit');
                        $bankbookRecord['bed'] = $bankbookReceipt->amount;
                        $bankbookRecord['bes'] = 0;
                        break;
                    case 'withdraw':
                        $bankbookRecord['title'] = trans('global.journal.BankbookWithdraw');
                        $bankbookRecord['bed'] = 0;
                        $bankbookRecord['bes'] = $bankbookReceipt->amount;
                        break;
                }
                JournalRecord::create($bankbookRecord);
                $bankbookReceipt->confirmed = 1;
                $bankbookReceipt->save();
            }

            $loanReceipts = LoanReceipt::where('confirmed', 0)->with('loan.bankbook')->get();
            foreach ($loanReceipts as $loanReceipt) {
                JournalRecord::create([
                    'journalable_type' => 'loanReceipt',
                    'journalable_id' => $loanReceipt->id,
                    'bed' => $loanReceipt->amount,
                    'bes' => 0,
                    'date' => $loanReceipt->date,
                    'title' => trans('global.journal.loanMonthlyPayed'),
                    'bankbook_code' => $loanReceipt->loan->bankbook->full_code,
                    'bankbook_title' => $loanReceipt->loan->bankbook->title,
                ]);

                $loanReceipt->confirmed = 1;
                $loanReceipt->save();
            }

            DB::commit();

            return back()->with('success', trans('global.global.successConfirmAll'));
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            return back()->with('error', trans('global.error.ErrorFired'));
        }

    }
}
