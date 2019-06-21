@extends('owner/master')

@section('page-title')
    <h1 class="h2">داشبورد</h1>
@endsection

@section('content')
    <ul>
        <li>تاریخ</li>
        <li>لیست کارها</li>
        <li>مانده صندوق</li>
        <li>آخرین {{ trans('global.global.action') }} های انجام شده</li>
        <li>تعداد کل اعضا</li>
        <li>تعداد کل وام ها</li>
        <li>تعداد وام های فعال</li>
        <li>تعداد کل دفاتر</li>
        <li>لیست اولویت وام ها</li>


    </ul>

@endsection