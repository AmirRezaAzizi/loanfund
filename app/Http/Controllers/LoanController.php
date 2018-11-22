<?php

namespace App\Http\Controllers;

use App\Bankbook;
use App\Http\Requests\LoanRequest;
use App\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::where('status', 'active')->get();
        $title = 'فعال';

        return view('owner.loans.index', compact('loans', 'title'));
    }
    public function ia_index()
    {
        $loans = Loan::where('status', 'inactive')->get();
        $title = 'غیرفعال';

        return view('owner.loans.index', compact('loans', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Bankbook $bankbook)
    {
        $date = jdate()->format('Y-m-d');
        return view('owner.loans.create', compact('bankbook', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request, Bankbook $bankbook)
    {
        $loan = $bankbook->createLoan($request);

        return redirect('/loans/' . $loan->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        return view('owner.Loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        return view('owner.loans.edit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(LoanRequest $request, Loan $loan)
    {
        $loan->update($request->all());
        return redirect('/loans/'.$loan->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
