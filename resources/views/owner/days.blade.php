@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفتر روزنامه</h1>
@endsection

@section('content')
<h3>مهرماه ۱۳۹۷ (صفحه بندی با ۳۰ تا و هر صفحه آخرین سطر نقل به صفحه بعد و بعدا مانده از صفحه قبل)
    <a href="">
        <button type="button" class="btn btn-outline-primary btn-sm">تغییر تاریخ</button>
    </a>
</h3>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>ردیف</th>
                <td>تاریخ</td>
                <th>شرح</th>
                <th>بدهکار</th>
                <th>بستانکار</th>
                <th>باقیمانده</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td>مانده از ماه قبل</td>
                <td></td>
                <td></td>
                <td>۲,۹۰۰</td>
            </tr>
            <tr>
                <td>۱</td>
                <td>۱۳۹۷/۰۱/۳۰</td>
                <td>دریافت از ۰۲۸۰۰۱</td>
                <td>۵۰</td>
                <td></td>
                <td>۲,۹۵۰</td>
            </tr>
            <tr>
                <td>۲</td>
                <td>۱۳۹۷/۰۱/۳۰</td>
                <td>پرداخت به ۰۲۸۰۰۱</td>
                <td></td>
                <td>۵۰۰</td>
                <td>۲,۴۵۰</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
