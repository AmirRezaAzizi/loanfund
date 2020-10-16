<?php

namespace App\Http\Controllers;

use App\Bankbook;
use App\Http\Requests\LoanRequest;
use App\Loan;
use App\Traits\Statusable;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    use Statusable;
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
        $loans = Loan::where('status', 'inactive')->orderByDesc('closed_date')->get();
        $title = 'غیرفعال';

        return view('owner.loans.index', compact('loans', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Bankbook $bankbook
     * @return \Illuminate\Http\Response
     */
    public function create(Bankbook $bankbook)
    {
        // Check if bankbook is disable show message and redirect back.
        if (!$this->isActive($bankbook))
            return back()->with('error', trans('global.errors.bankbookIsInactive'));

        // Check if bankbook has active loan, don't let to create new loan and send error
        if ($bankbook->active_loans_count >= 1)
            return back()->with('error', trans('global.errors.hasActiveLoan'));

        $date = convertNumbers(jdate()->format('Y/m/d'));
        return view('owner.loans.create', compact('bankbook', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LoanRequest $request
     * @param Bankbook $bankbook
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request, Bankbook $bankbook)
    {
        // validation
        $total = $request->monthly * $request->total_number;

        if ($total != $request->total)
            return back()->withErrors(['مبلغ وام با تعداد اقساط همخوانی ندارد.']);

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
        $loanReceipts = $loan->loanReceipts()->latest('date')->get();
        return view('owner.loans.show', compact('loan', 'loanReceipts'));
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
     * @param LoanRequest $request
     * @param  \App\Loan $loan
     * @return \Illuminate\Http\Response
     */
    public function update(LoanRequest $request, Loan $loan)
    {
        if ($request->status == 'inactive') {
            $request->validate([
                'closed_date' => 'required'
            ]);
        }

        if ($loan->confirmed)
            if ($loan->total !== (int)convertNumbers($request->total, true) || $loan->created_date !== $request->created_date)
                return back()->with('error', trans('global.global.isConfirmedMessage'));

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
        // if is confirmed
    }
}
