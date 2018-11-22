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
            <td>{{ sprintf('%04d', $bankbook->customer->code) }}{{ sprintf('%03d', $bankbook->code) }}</td>
        </tr>
        <tr>
            <th>وضعیت</th>
            <td class="{{ $bankbook->status == 'inactive' ? 'inactive-bg' : '' }}">{{ $bankbook->status == 'active' ? 'فعال' : 'غیرفعال' }}</td>
        </tr>
        <tr>
            <th>نام مشتری</th>
            <td>{{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }}</td>
        </tr>
        <tr>
            <th>شماره موبایل</th>
            <td>{{ $bankbook->customer->mobile }}</td>
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
            <td>{{ $bankbook->created_date }}</td>
        </tr>
        </tbody>
    </table>
    <h2>قبض ها
        <a href="/bankbooks/show">
            <button type="button" class="btn btn-outline-primary btn-sm">ثبت قبض جدید</button>
        </a>
    </h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>کد قبض</th>
                <th>تاریخ</th>
                <th>مبلغ</th>
                <th>موجودی</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>

            @for($i = 1; $i <=9 ; $i++)
                <tr>
                    <th>{{ $i }}</th>
                    <th>2800100{{ $i }}</th>
                    <th>۹۷/۰۱/۲۸</th>
                    <th>۵۰</th>
                    <th>{{ 4000 + $i * 50 }}</th>
                    <td>
                        <a href="/bankbooks/show" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>
    </div>
@endsection