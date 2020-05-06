<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiptRequest;
use App\Loan;
use App\LoanReceipt;
use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;

class LoanReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function create(Loan $loan)
    {
        $balance = 0;

        $date = convertNumbers(jdate()->format('Y/m/') . '30');

        $balance += $loan->now_balance();

        return view('owner.loanReceipts.create', compact('loan', 'date', 'balance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReceiptRequest|Request $request
     * @param Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function store(ReceiptRequest $request, Loan $loan)
    {
        $receipt = $loan->createReceipt($request);

        return redirect('/loans/'.$receipt->loan->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoanReceipt  $loanReceipt
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanReceipt $loanReceipt)
    {
        if ($loanReceipt->confirmed)
            return back()->with('error', trans('global.global.isConfirmedMessage'));

        $balance = $loanReceipt->loan->now_balance();
        return view('owner.loanReceipts.edit', compact('loanReceipt', 'balance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoanReceipt  $loanReceipt
     * @return \Illuminate\Http\Response
     */
    public function update(ReceiptRequest $request, LoanReceipt $loanReceipt)
    {
        if ($loanReceipt->confirmed)
            return back()->with('error', trans('global.global.isConfirmedMessage'));

        $loanReceipt->update($request->all());
        return redirect('/loans/'.$loanReceipt->loan->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\LoanReceipt $loanReceipt
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(LoanReceipt $loanReceipt)
    {
        if ($loanReceipt->confirmed)
            return back()->with('error', trans('global.global.isConfirmedMessage'));

        $loanReceipt->delete();

        return redirect('/loans/'.$loanReceipt->loan->id);
    }
}
