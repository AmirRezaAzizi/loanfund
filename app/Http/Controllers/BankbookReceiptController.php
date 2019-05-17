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
     * @return \Illuminate\Http\Response
     */
    public function create(Bankbook $bankbook)
    {
        $balance = 0;

        $date = convertNumbers(jdate()->format('Y/m/') . '29');

        $balance += $bankbook->now_balance();

        return view('owner.bankbookReceipts.create', compact('bankbook', 'date', 'balance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceiptRequest $request, Bankbook $bankbook)
    {
        $receipt = $bankbook->createReceipt($request);

        return redirect('/bankbooks/'.$receipt->bankbook->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BankbookReceipt  $bankbookReceipt
     * @return \Illuminate\Http\Response
     */
    public function show(BankbookReceipt $bankbookReceipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BankbookReceipt  $bankbookReceipt
     * @return \Illuminate\Http\Response
     */
    public function edit(BankbookReceipt $bankbookReceipt)
    {
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
        $bankbookReceipt->update($request->all());
        return redirect('/bankbooks/'.$bankbookReceipt->bankbook->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BankbookReceipt  $bankbookReceipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankbookReceipt $bankbookReceipt)
    {
        //
    }
}
