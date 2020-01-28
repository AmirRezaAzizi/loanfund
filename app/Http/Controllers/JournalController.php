<?php

namespace App\Http\Controllers;

use App\JournalRecord;
use Illuminate\Support\Facades\DB;


class JournalController extends Controller
{
    public function index()
    {
        //default year and month is now
        $thisYear = isset($_REQUEST['year']) ? $_REQUEST['year'] : jdate()->getYear();

        $thisMonth = isset($_REQUEST['month']) ? $_REQUEST['month'] : jdate()->getMonth();

        $records = JournalRecord::whereYear('date', '=', $thisYear)->whereMonth('date', '=', $thisMonth)->get();

        // if there is no record: error
        if (!$records->first()) {
            $error = trans('global.errors.no_record_in_date');
            return view('owner.journal', compact('thisYear', 'thisMonth','error'));
        }

        // get previous
        $minDateRecords = $records->sortBy('date')->first()->date;

        $previousBed = JournalRecord::where(DB::raw('DATE(date)'), '<', $minDateRecords)->sum('bed');
        $previousBes = JournalRecord::where(DB::raw('DATE(date)'), '<', $minDateRecords)->sum('bes');

        // next
        $nextBed = $records->sum('bed') + $previousBed;
        $nextBes = $records->sum('bes') + $previousBes;

        //total
        $total = $nextBed - $nextBes;

        return view('owner.journal', compact('records',
            'thisYear',
            'thisMonth',
            'previousBed',
            'previousBes',
            'nextBed',
            'nextBes',
            'total'
            ));
    }
}
