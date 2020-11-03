<?php


namespace App\Http\Controllers;


use App\Customer;
use App\Loan;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class YearlyIncomeController extends Controller
{
    public function index()
    {
        $persianYear = jdate()->format('Y');
        $persianMonth = jdate()->format('m');
        $startDate = CalendarUtils::createCarbonFromFormat('Y/m/d', $persianYear . '/01/01')->format('Y-m-d');
        $persianEnd = jdate()->isLeapYear() ? $persianYear . '/12/30' : $persianYear . '/12/29';
        $endDate = CalendarUtils::createCarbonFromFormat('Y/m/d', $persianEnd)->format('Y-m-d');

        $balanceBeforeStartDate = $this->balanceBeforeDate($startDate);

        $customers = Customer::with(['bankbooks.loans.LoanReceipts' => function ($query) use ($startDate, $endDate) {
            $query->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate);
        }])->with(['bankbooks.bankbookReceipts'=> function ($query) use ($startDate, $endDate) {
            $query->where('date', '>=', $startDate)
                ->where('date', '<=', $endDate);
        }])->get(['id', 'fname', 'lname'])->sortBy('lname')->toArray();

        $monthIndexes = [
            "01" => 0,
            "02" => 0,
            "03" => 0,
            "04" => 0,
            "05" => 0,
            "06" => 0,
            "07" => 0,
            "08" => 0,
            "09" => 0,
            "10" => 0,
            "11" => 0,
            "12" => 0,
        ];



        /*
         * Loan
         */
        $loanMonthlyCount = $monthIndexes;
        $loanMonthlyPaid = $monthIndexes;
        $loans = Loan::where('created_date', '>=', $startDate)->where('created_date', '<=', $endDate)->get(['id', 'created_date', 'total']);

        foreach ($loans as $loan) {
            $loanPersianMonth = preg_replace('/.....(.*).../', '$1', convertNumbers($loan['created_date'], true));

            $loanMonthlyCount[$loanPersianMonth] += 1;

            $loanMonthlyPaid[$loanPersianMonth] += $loan->total;

        }



        $totalMonthlyIncome = $monthIndexes;

        foreach ($customers as $key => $customer) {
            $monthlyLoanReceipts = $monthIndexes;
            $monthlyBankbookDepositReceipts = $monthIndexes;
            $monthlyBankbookWithdrawReceipts = $monthIndexes;

            foreach ($customer['bankbooks'] as $bankbook) {

                foreach ($bankbook['bankbook_receipts'] as $bankbook_receipt) {
                    $receiptPersianMonth = preg_replace('/.....(.*).../', '$1', convertNumbers($bankbook_receipt['date'], true));

                    if ($bankbook_receipt['type'] == 'deposit') {
                        $monthlyBankbookDepositReceipts[$receiptPersianMonth] += $bankbook_receipt['amount'];
                    } else {
                        $monthlyBankbookWithdrawReceipts[$receiptPersianMonth] += $bankbook_receipt['amount'];
                    }

                }

                foreach ($bankbook['loans'] as $loan) {

                    foreach ($loan['loan_receipts'] as $loan_receipt) {
                        $receiptPersianMonth = preg_replace('/.....(.*).../', '$1', convertNumbers($loan_receipt['date'], true));
                        $monthlyLoanReceipts[$receiptPersianMonth] += $loan_receipt['amount'];
                    }
                }


            }

            $customers[$key]['customerTotalMonthly'] = $monthIndexes;
            foreach ($monthIndexes as $index => $value) {
                $customers[$key]['customerTotalMonthly'][$index] = ($monthlyLoanReceipts[$index] + $monthlyBankbookDepositReceipts[$index]) - $monthlyBankbookWithdrawReceipts[$index];
                $totalMonthlyIncome[$index] += $customers[$key]['customerTotalMonthly'][$index];
            }

        }

        foreach ($monthIndexes as $index => $value) {
            if ($index > $persianMonth) {
                $totalMonthlyBalance[$index] = 0;
                $balanceForNextMonth[$index] = 0;
                $balanceFromPreviousMonth[$index] = 0;
                continue;
            }

            if ($index == '01') {
                $totalMonthlyBalance[$index] = $balanceBeforeStartDate + $totalMonthlyIncome[$index];
                $balanceForNextMonth[$index] = $totalMonthlyBalance[$index] - $loanMonthlyPaid[$index];
                $balanceFromPreviousMonth[$index] = $balanceBeforeStartDate;
                continue;
            }
            $balanceFromPreviousMonth[$index] = $balanceForNextMonth[sprintf('%02d', $index-1)];
            $totalMonthlyBalance[$index] = $balanceForNextMonth[sprintf('%02d', $index-1)] + $totalMonthlyIncome[$index];
            $balanceForNextMonth[$index] = $totalMonthlyBalance[$index] - $loanMonthlyPaid[$index];
        }

        return view('owner.yearly-income', compact('customers', 'totalMonthlyIncome', 'monthIndexes', 'balanceBeforeStartDate', 'loanMonthlyCount', 'loanMonthlyPaid', 'totalMonthlyBalance', 'balanceForNextMonth', 'balanceFromPreviousMonth'));
    }

    protected function balanceBeforeDate($data)
    {
        $customers = Customer::with(['bankbooks.loans.LoanReceipts' => function ($query) use ($data) {
            $query->where('date', '<', $data);
        }])->with(['bankbooks.bankbookReceipts'=> function ($query) use ($data) {
            $query->where('date', '<', $data);
        }])->get(['id', 'fname', 'lname'])->toArray();

        $totalLoanReceipts = 0;
        $totalBankbookDepositReceipts = 0;
        $totalBankbookWithdrawReceipts = 0;
        foreach ($customers as $key => $customer) {

            foreach ($customer['bankbooks'] as $bankbook) {

                foreach ($bankbook['bankbook_receipts'] as $bankbook_receipt) {

                    if ($bankbook_receipt['type'] == 'deposit') {
                        $totalBankbookDepositReceipts += $bankbook_receipt['amount'];
                    } else {
                        $totalBankbookWithdrawReceipts += $bankbook_receipt['amount'];
                    }

                }

                foreach ($bankbook['loans'] as $loan) {

                    foreach ($loan['loan_receipts'] as $loan_receipt) {
                        $totalLoanReceipts += $loan_receipt['amount'];
                    }
                }


            }
        }

        return ($totalLoanReceipts + $totalBankbookDepositReceipts) - $totalBankbookWithdrawReceipts;

    }

}
