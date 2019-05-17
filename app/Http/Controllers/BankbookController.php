<?php

namespace App\Http\Controllers;

use App\Bankbook;
use App\Customer;
use App\Http\Requests\BankbookRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class BankbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bankbooks = Bankbook::where('status', 'active')->get();
        $title = 'فعال';

        return view('owner.bankbooks.index', compact('bankbooks', 'title'));
    }
    public function ia_index()
    {
        $bankbooks = Bankbook::where('status', 'inactive')->get();
        $title = 'غیرفعال';

        return view('owner.bankbooks.index', compact('bankbooks', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Customer $customer)
    {
        $date = convertNumbers(jdate()->format('Y/m/d'));
        return view('owner.bankbooks.create', compact('customer', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
            'first_balance' => 'required',
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
        return view('owner.bankbooks.show', compact('bankbook'));
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
        if ($request->status == 'inactive') {
            $request->validate([
               'closed_date' => 'required'
            ]);
        }
        $request->validate([
            'first_balance' => 'required|numeric',
            'monthly' => 'required|numeric',
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
