@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفترچه پس انداز
        <a href="/bankbooks/{{ $bankbook->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
        <a href="/bankbooks/{{ $bankbook->id }}/loans/create" class="btn btn-outline-primary btn-sm" role="button">ایجاد وام</a>
    </h1>
@endsection

@section('content')
    <table class="table table-striped">
        <tbody>
        <tr>
            <th>شماره دفتر</th>
            <td>{{ $bankbook->customer->id }}/{{ $bankbook->code }}</td>
        </tr>
        <tr>
            <th>وضعیت</th>
            <td class="{{ $bankbook->status == 'inactive' ? 'inactive-bg' : '' }}">{{ $bankbook->status == 'active' ? 'فعال' : 'غیرفعال' }}</td>
        </tr>
        <tr>
            <th>عضو اصلی</th>
            <td>{{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }}</td>
        </tr>
        <tr>
            <th>عنوان دفترچه</th>
            <td>@if($bankbook->title){{ $bankbook->title }} @else {{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }} @endif</td>
        </tr>
        <tr>
            <th>شماره موبایل</th>
            <td>{{ $bankbook->customer->mobile }}</td>
        </tr>
        <tr>
            <th>مبلغ افتتاح حساب</th>
            <td>{{ $bankbook->first_balance }}</td>
        </tr>
        <tr>
            <th>مبلغ پس انداز ماهیانه</th>
            <td>{{ $bankbook->monthly }}</td>
        </tr>
        <tr>
            <th>مانده پس انداز</th>
            <td>{{ $bankbook->now_balance() }}</td>
        </tr>
        <tr>
            <th>مانده وام</th>
            <td>-</td>
        </tr>
        <tr>
            <th>مبلغ قسط</th>
            <td>-</td>
        </tr>
        <tr>
            <th>تاریخ ثبت</th>
            <td>{{ $created_date }}</td>
        </tr>
        <tr>
            <th>تاریخ آخرین ویرایش</th>
            <td>{{ $updated_at }}</td>
        </tr>
        </tbody>
    </table>
    <h2>دریافت و پرداخت ها
        <a href="/bankbooks/{{ $bankbook->id }}/receipts/create">
            <button type="button" class="btn btn-outline-primary btn-sm">ایجاد قبض جدید</button>
        </a>
    </h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>کد قبض</th>
                <th>تاریخ</th>
                <th>دریافت</th>
                <th>پرداخت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>

            @foreach($bankbook->bankbookReceipts as $key => $receipt)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $receipt->id }}</td>
                    <td>{{ $receipt->date }}</td>
                    <td>{{ $receipt->amount }}</td>
                    <td></td>
                    <td>
                        <a href="/bankbookReceipts/{{ $receipt->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection