<?php

namespace App\Http\Controllers;


use App\BankbookReceipt;
use App\Loan;
use App\LoanReceipt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Flysystem\Exception;

class ConfirmController extends Controller
{
    public function confirm()
    {
        DB::beginTransaction();
        try {
            Loan::where('confirmed', 0)->update(['confirmed' => 1]);
            LoanReceipt::where('confirmed', 0)->update(['confirmed' => 1]);
            BankbookReceipt::where('confirmed', 0)->update(['confirmed' => 1]);
            DB::commit();

            return back()->with('success', trans('global.global.successConfirmAll'));
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            return back()->with('error', trans('global.error.ErrorFired'));
        }

    }
}
