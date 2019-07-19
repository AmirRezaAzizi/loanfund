@extends('owner/master')

@section('page-title')
    @php
        $nowYear = jdate()->getYear();
    @endphp
    <h1 class="h2">دفتر روزنامه</h1>
    <form class="form-inline">
        <label for="year"> سال </label>
        &nbsp;
        <select name="year" id="year">
            @for($year = 1397; $year <= $nowYear; $year++)
                <option value="{{ $year }}" @if($year == $thisYear) selected @endif>{{ $year }}</option>
            @endfor
        </select>
        &nbsp;&nbsp;
        <label for="month"> ماه </label>
        &nbsp;
        <select name="month" id="month">
            @for($month = 1; $month <= 12; $month++)
                <option value="{{ sprintf('%02d', $month) }}" @if($month == $thisMonth) selected @endif>{{ monthNumberToMonthName($month) }}</option>
            @endfor
        </select>
        &nbsp;&nbsp;
        <button type="submit" class="btn btn-warning btn-sm">اعمال</button>
    </form>
    <div class="pull-left">
        <a href="{{ route('confirmAll') }}" class="btn btn-danger" role="button"><i class="fa fa-check" aria-hidden="true"></i> ثبت نهایی</a>
        <button class="btn btn-primary" onclick="print()"><i class="fa fa-print" aria-hidden="true"></i> چاپ</button>
    </div>
@endsection

@section('content')

<div class="table-responsive">
    <table class="table table-striped table-sm table-bordered">
        <thead>
        <tr>
            <th>{{ trans('global.global.row') }}</th>
            <th>تاریخ</th>
            <th>شرح</th>
            <th>دفتر</th>
            <th>بدهکار</th>
            <th>بستانکار</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($error))
            <tr>
                <td colspan="6">{{ $error }}</td>
            </tr>
        @else
            <tr>
                <td colspan="4" class="text-right font-weight-bold">نقل از قبل</td>
                <td class="text-left">{{ number_format($previousBed) }}</td>
                <td class="text-left">{{ number_format($previousBes) }}</td>
            </tr>
            @php
                $counter = 1;
            @endphp
            @foreach($records as $key => $record)
                <tr>
                    <td class="text-left">{{ $counter++ }}</td>
                    <td class="text-left">{{ str_replace('-', '/', $record['date']) }}</td>
                    <td>{{ $record['title'] }}</td>
                    <td>{{ $record['bankbook_title'] }} ({{ $record['bankbook_code'] }})</td>
                    <td class="text-left">
                        @if($record['bed'] != 0)
                            {{ number_format($record['bed']) }}
                        @endif
                    </td>
                    <td class="text-left">
                        @if($record['bes'] != 0)
                            {{ number_format($record['bes']) }}
                        @endif
                    </td>
                </tr>
            @endforeach

            <tr>
                <td colspan="4" class="text-right font-weight-bold">نقل به بعد</td>
                <td class="text-left">{{ number_format($nextBed) }}</td>
                <td class="text-left">{{ number_format($nextBes) }}</td>
            </tr>
            <tr>
                <td colspan="6" class="text-center font-weight-bold">جمع کل :
                @if($total < 0)
                    <span style="color: #ff0000">{{ number_format(abs($total)) }}-</span>
                @else
                    <span>{{ number_format($total) }}</span>
                @endif
                </td>
            </tr>
        @endif

        </tbody>
    </table>
</div>
@endsection
