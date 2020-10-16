<?php

namespace App\Http\Controllers;

use App\Bankbook;
use App\Customer;
use App\Rules\DisableBankbook;
use App\Traits\Statusable;
use Illuminate\Http\Request;


class BankbookController extends Controller
{
    use Statusable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankbooks = Bankbook::where('status', 'active')->get();
        $title = 'فعال';

        $totalMonthly = $bankbooks->sum('monthly');
        $totalBalance = 0;
        $totalLoanMonthly = 0;
        $totalLoanBalance = 0;

        foreach ($bankbooks as $bankbook) {
            $totalBalance += $bankbook->now_balance();
            $activeLoan = $bankbook->activeLoan();

            if ($activeLoan) {
                $totalLoanMonthly += $activeLoan->monthly;
                $totalLoanBalance += $activeLoan->now_balance();
            }
        }

        return view('owner.bankbooks.index', compact('bankbooks', 'title', 'totalMonthly', 'totalBalance', 'totalLoanMonthly', 'totalLoanBalance'));
    }

    // inactive
    public function ia_index()
    {
        $bankbooks = Bankbook::where('status', 'inactive')->orderByDesc('closed_date')->get();
        $title = 'غیرفعال';

        $totalMonthly = $bankbooks->sum('monthly');
        $totalBalance = 0;
        $totalLoanMonthly = 0;
        $totalLoanBalance = 0;

        foreach ($bankbooks as $bankbook) {
            $totalBalance += $bankbook->now_balance();
            $activeLoan = $bankbook->activeLoan();

            if ($activeLoan) {
                $totalLoanMonthly += $activeLoan->monthly;
                $totalLoanBalance += $activeLoan->now_balance();
            }
        }

        return view('owner.bankbooks.index', compact('bankbooks', 'title', 'totalMonthly', 'totalBalance', 'totalLoanMonthly', 'totalLoanBalance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer)
    {
        // Check if customer is disable show message and redirect back
        if (!$this->isActive($customer))
            return back()->with('error', trans('global.errors.customerIsInactive'));

        $date = convertNumbers(jdate()->format('Y/m/d'));
        return view('owner.bankbooks.create', compact('customer', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Customer $customer)
    {
        $code = Bankbook::where('customer_id', $customer->id)->max('code') + 1;
        $request->request->add(['code' => $code]);
        if (!$request->title) {
            $request->request->add(['title' => $customer->fname . ' ' . $customer->lname]);
        }

        $request->validate([
            'monthly' => 'required',
        ]);

        $customer->createBankbook($request);
        return redirect('/customers/'.$customer->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bankbook  $bankbook
     * @return \Illuminate\Http\Response
     */
    public function show(Bankbook $bankbook)
    {

        $bankbookReceipts = $bankbook->bankbookReceipts()->latest('date')->get();
        return view('owner.bankbooks.show', compact('bankbook', 'bankbookReceipts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bankbook  $bankbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Bankbook $bankbook)
    {
        return view('owner.bankbooks.edit', compact('bankbook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bankbook  $bankbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bankbook $bankbook)
    {
        $request->validate([
            'status' => new DisableBankbook($bankbook),
            'closed_date' => 'required_if:status,inactive',
//            'first_balance' => 'required|persian_num',
            'monthly' => 'required',
        ]);

        $bankbook->update($request->all());
        return redirect('/bankbooks/'.$bankbook->id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bankbook  $bankbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bankbook $bankbook)
    {
        //
    }
}
