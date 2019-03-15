<?php

namespace App\Http\Controllers;

use App\Bankbook;
use App\Customer;
use App\Http\Requests\BankbookRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        $date = \Morilog\Jalali\CalendarUtils::convertNumbers(jdate()->format('Y/m/d'));
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
        $first_balance = (int)\Morilog\Jalali\CalendarUtils::convertNumbers($request->first_balance, true);
        $monthly = (int)\Morilog\Jalali\CalendarUtils::convertNumbers($request->monthly, true);
        $created_date = \Morilog\Jalali\CalendarUtils::convertNumbers($request->created_date, true);
        $request->merge(array(
            'first_balance' => $first_balance,
            'monthly' => $monthly,
            'created_date' => $created_date
        ));
        $code = Bankbook::where('customer_id', $customer->id)->max('code') + 1;
        $request->request->add(['code' => $code]);
        if (!$request->title) {
            $request->request->add(['title' => $customer->fname . ' ' . $customer->lname]);
        }
        $request->validate([
            'first_balance' => 'required|numeric',
            'monthly' => 'required|numeric',
            'created_date' => 'required|date_format:Y/m/d',
            'closed_date' => 'nullable|date_format:Y/m/d'
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
        $updated_at = jdate($bankbook->updated_at)->format('H:i:s  Y/m/d');
        $created_date = date('Y/m/d', strtotime($bankbook->created_date));

        return view('owner.bankbooks.show', compact('bankbook', 'updated_at', 'created_date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bankbook  $bankbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Bankbook $bankbook)
    {
        $created_date = date('Y/m/d', strtotime($bankbook->created_date));
        return view('owner.bankbooks.edit', compact('bankbook', 'created_date'));
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
        $first_balance = (int)\Morilog\Jalali\CalendarUtils::convertNumbers($request->first_balance, true);
        $monthly = (int)\Morilog\Jalali\CalendarUtils::convertNumbers($request->monthly, true);
        $created_date = \Morilog\Jalali\CalendarUtils::convertNumbers($request->created_date, true);
        $request->merge(array(
            'first_balance' => $first_balance,
            'monthly' => $monthly,
            'created_date' => $created_date
        ));
        $request->validate([
            'code' => ['required', 'numeric', Rule::unique('bankbooks')->where(function ($query) use ($bankbook) {
                return $query->where('customer_id', $bankbook->id);
            })->ignore($bankbook->customer->id)],
            'first_balance' => 'required|numeric',
            'monthly' => 'required|numeric',
            'created_date' => 'required|date_format:Y/m/d',
            'closed_date' => 'nullable|date_format:Y/m/d'

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
