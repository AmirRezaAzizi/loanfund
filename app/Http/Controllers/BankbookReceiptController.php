<?php

namespace App\Http\Controllers;

use App\Bankbook;
use App\BankbookReceipt;
use App\Http\Requests\ReceiptRequest;
use Illuminate\Http\Request;
use Morilog\Jalali\CalendarUtils;

class BankbookReceiptController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Bankbook $bankbook
     * @return \Illuminate\Http\Response
     */
    public function create(Bankbook $bankbook)
    {
        $balance = 0;

        $date = convertNumbers(jdate()->format('Y/m/') . '30');

        $balance += $bankbook->now_balance();

        return view('owner.bankbookReceipts.create', compact('bankbook', 'date', 'balance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReceiptRequest|Request $request
     * @param Bankbook $bankbook
     * @return \Illuminate\Http\Response
     */
    public function store(ReceiptRequest $request, Bankbook $bankbook)
    {
        $receipt = $bankbook->createReceipt($request);

        return redirect('/bankbooks/'.$receipt->bankbook->id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankbookReceipt  $bankbookReceipt
     * @return \Illuminate\Http\Response
     */
    public function edit(BankbookReceipt $bankbookReceipt)
    {
        if ($bankbookReceipt->confirmed)
            return back()->with('error', trans('global.global.isConfirmedMessage'));
        $balance = $bankbookReceipt->bankbook->now_balance();
        return view('owner.bankbookReceipts.edit', compact('bankbookReceipt', 'balance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BankbookReceipt  $bankbookReceipt
     * @return \Illuminate\Http\Response
     */
    public function update(ReceiptRequest $request, BankbookReceipt $bankbookReceipt)
    {
        if ($bankbookReceipt->confirmed)
            return back()->with('error', trans('global.global.isConfirmedMessage'));
        $bankbookReceipt->update($request->all());
        return redirect('/bankbooks/'.$bankbookReceipt->bankbook->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\BankbookReceipt $bankbookReceipt
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(BankbookReceipt $bankbookReceipt)
    {
        if ($bankbookReceipt->confirmed)
            return back()->with('error', trans('global.global.isConfirmedMessage'));

        $bankbookReceipt->delete();

        return redirect('/bankbooks/'.$bankbookReceipt->bankbook->id);
    }
}
