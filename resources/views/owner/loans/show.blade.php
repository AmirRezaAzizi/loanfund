@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفترچه وام
        <a href="/loans/{{ $loan->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
    </h1>
@endsection

@section('content')
    <table class="table table-striped">
        <tbody>
        <tr>
            <th>شماره وام</th>
            <td>{{ $loan->id }}</td>
        </tr>
        <tr>
            <th>شماره دفترچه پس انداز</th>
            <td>{{ sprintf("%04d", $loan->bankbook->customer->code) }}{{ sprintf("%03d", $loan->bankbook->code) }}</td>
        </tr>
        <tr>
            <th>وضعیت</th>
            <td class="{{ $loan->status == 'inactive' ? 'inactive-bg' : '' }}">{{ $loan->status == 'active' ? 'فعال' : 'غیرفعال' }}</td>
        </tr>
        <tr>
            <th>نام مشتری</th>
            <td>{{ $loan->bankbook->customer->fname }} {{ $loan->bankbook->customer->lname }}</td>
        </tr>
        <tr>
            <th>شماره موبایل</th>
            <td>{{ $loan->bankbook->customer->mobile }}</td>
        </tr>
        <tr>
            <th>مبلغ وام</th>
            <td>{{ $loan->total }}</td>
        </tr>
        <tr>
            <th>مانده بدهی</th>
            <td>-</td>
        </tr>
        <tr>
            <th>مبلغ هر قسط</th>
            <td>{{ $loan->monthly }}</td>
        </tr>
        <tr>
            <th>اقساط باقی مانده</th>
            <td>-/{{ $loan->total_number }}</td>
        </tr>
        <tr>
            <th>تاریخ اعطای وام</th>
            <td>{{ $loan->created_date }}</td>
        </tr>
        {{--<tr>--}}
            {{--<th>تاریخ سررسید آخرین قسط</th>--}}
            {{--<td>{{ $loan->last_date }}</td>--}}
        {{--</tr>--}}
        @if($loan->status == 'inactive')
            <tr>
                <th>تاریخ غیرفعالسازی</th>
                <td>{{ $loan->closed_date }}</td>
            </tr>
        @endif

        </tbody>
    </table>
    <h2>قبض ها
        <a href="/bankbooks/show" class="btn btn-outline-primary btn-sm" role="button">ثبت قبض جدید</a>
    </h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>کد قبض</th>
                <th>تاریخ</th>
                <th>مبلغ پرداختی</th>
                <th>باقی مانده</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>

            @for($i = 1; $i <=9 ; $i++)
                <tr>
                    <th>{{ $i }}</th>
                    <th>2800100{{ $i }}</th>
                    <th>۹۷/۰۱/۲۸</th>
                    <th>۳۹۰</th>
                    <th>{{ 10000 - $i * 390 }}</th>
                    <td>
                        <a href="/bankbooks/show" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@endsection
