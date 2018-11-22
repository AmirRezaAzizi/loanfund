<?php

namespace App\Http\Controllers;

use App\Bankbook;
use App\Customer;
use App\Http\Requests\BankbookRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $max_code = Bankbook::where('customer_id', $customer->id)->max('code');
        $date = jdate()->format('Y-m-d');
        return view('owner.bankbooks.create', compact('customer', 'max_code', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankbookRequest $request, Customer $customer)
    {
        $request->validate([
            'code' => Rule::unique('bankbooks')->where(function ($query) use ($customer) {
                return $query->where('customer_id', $customer->id);
            })
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
    public function update(BankbookRequest $request, Bankbook $bankbook)
    {
        $request->validate([
            'code' => Rule::unique('bankbooks')->where(function ($query) use ($bankbook) {
                return $query->where('customer_id', $bankbook->id);
            })->ignore($bankbook->customer->id)
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
