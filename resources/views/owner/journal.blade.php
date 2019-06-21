@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفتر روزنامه</h1>
    <div class="pull-left">
        <a href="{{ route('confirmAll') }}" class="btn btn-danger" role="button"><i class="fa fa-check" aria-hidden="true"></i> ثبت نهایی</a>
        <a href="" class="btn btn-primary" role="button"><i class="fa fa-print" aria-hidden="true"></i> چاپ</a>
    </div>
@endsection

@section('content')
{{--<div>--}}
    {{--<h3>مهرماه ۱۳۹۷ (صفحه بندی با ۳۰ تا و هر صفحه آخرین سطر نقل به صفحه بعد و بعدا مانده از صفحه قبل)--}}
        {{--<a href="">--}}
            {{--<button type="button" class="btn btn-outline-primary btn-sm">تغییر تاریخ</button>--}}
        {{--</a>--}}
    {{--</h3>--}}
{{--</div>--}}
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
            <th>مانده</th>
        </tr>
        </thead>
        <tbody>
        @php
            $counter = 1;
        @endphp
        @foreach($journalRecords as $key => $record)
            <tr>
                <td class="text-left">{{ $counter++ }}</td>
                <td class="text-left">{{ $record['date'] }}</td>
                <td>{{ $record['title'] }}</td>
                <td>{{ $record['bankbook_title'] }} ({{ $record['bankbook_code'] }})</td>
                <td class="text-left">
                    @if($record['column'] == 'bed')
                        {{ number_format($record['amount']) }}
                    @endif
                </td>
                <td class="text-left">
                    @if($record['column'] == 'bes')
                        {{ number_format($record['amount']) }}
                    @endif
                </td>
                <td class="text-left">{{ number_format($record['left']) }}</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="4" class="text-right">جمع کل</td>
            <td class="text-left">{{ number_format($total_bed) }}</td>
            <td class="text-left">{{ number_format($total_bes) }}</td>
            <td class="text-left">{{ number_format($left) }}</td>
        </tr>

        </tbody>
    </table>
</div>
@endsection
