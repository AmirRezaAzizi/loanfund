@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفتر کل</h1>
@endsection

@section('content')
    <h3>از ابتدا تا تاریخ ۹۷/۰۱/۳۰
        <a href="">
            <button type="button" class="btn btn-outline-primary btn-sm">تغییر بازه</button>
        </a>
    </h3>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>عنوان</th>
                <th>بدهکار</th>
                <th>بستانکار</th>
                <th>باقیمانده</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>۱</td>
                <td>امیرعلی</td>
                <td>۸,۴۰۰</td>
                <td>۵,۴۵۰</td>
                <td>۲,۹۵۰</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
