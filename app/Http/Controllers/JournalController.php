<?php

namespace App\Http\Controllers;

use App\BankbookReceipt;
use App\Loan;
use App\LoanReceipt;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index($dateFrom = '2019-06-01', $dateTo = '2019-06-30')
    {
        $total_bed = 0;
        $total_bes = 0;
        $left = 0;

        $journalRecords = collect();

        $loans = Loan::whereBetween('created_date', [$dateFrom, $dateTo])->get();

        $bankbookReceipts = BankbookReceipt::whereBetween('date', [$dateFrom, $dateTo])->with('bankbook')->get();

        $loanReceipts = LoanReceipt::whereBetween('date', [$dateFrom, $dateTo])->with('loan.bankbook')->get();

        foreach ($loans as $loan) {
            $loanRecord = [
                'date' => $loan->created_date,
                'title' => trans('global.journal.giveLoan'),
                'amount' => $loan->total,
                'bankbook_code' => $loan->bankbook->full_code,
                'bankbook_title' => $loan->bankbook->title,
                'column' => 'bes'
            ];

            $total_bes += $loan->total;
            $left -= $loan->total;
            $loanRecord['left'] = $left;

            $journalRecords->push($loanRecord);

        }

        foreach ($bankbookReceipts as $bankbookReceipt) {
            $bankbookRecord = [
                'date' => $bankbookReceipt->date,
                'amount' => $bankbookReceipt->amount,
                'bankbook_code' => $bankbookReceipt->bankbook->full_code,
                'bankbook_title' => $bankbookReceipt->bankbook->title,
            ];

            switch ($bankbookReceipt->type) {
                case 'deposit':
                    $bankbookRecord['title'] = trans('global.journal.BankbookDeposit');
                    $bankbookRecord['column'] = 'bed';
                    $total_bed += $bankbookRecord['amount'];
                    $left += $bankbookRecord['amount'];
                    $bankbookRecord['left'] = $left;
                    break;
                case 'withdraw':
                    $bankbookRecord['title'] = trans('global.journal.BankbookWithdraw');
                    $bankbookRecord['column'] = 'bes';
                    $total_bes += $bankbookRecord['amount'];
                    $left -= $bankbookRecord['amount'];
                    $bankbookRecord['left'] = $left;
                    break;
                default:
                    $bankbookRecord['title'] = trans('global.journal.wrongType');
                    $bankbookRecord['column'] = 'bes';
                    $total_bes += $bankbookRecord['amount'];
                    $left -= $bankbookRecord['amount'];
                    $bankbookRecord['left'] = $left;
            }

            $journalRecords->push($bankbookRecord);
        }

        foreach ($loanReceipts as $loanReceipt) {
            $loanReceiptRecord = [
                'date' => $loanReceipt->date,
                'title' => trans('global.journal.loanMonthlyPayed'),
                'amount' => $loanReceipt->amount,
                'bankbook_code' => $loanReceipt->loan->bankbook->full_code,
                'bankbook_title' => $loanReceipt->loan->bankbook->title,
                'column' => 'bed'
            ];

            $total_bed += $loanReceipt->amount;
            $left += $loanReceipt->amount;
            $loanReceiptRecord['left'] = $left;
            $journalRecords->push($loanReceiptRecord);

        }

        $journalRecords = $journalRecords->sortByDesc('date');

        return view('owner.journal', compact('journalRecords', 'total_bed', 'total_bes', 'left'));
    }
}
