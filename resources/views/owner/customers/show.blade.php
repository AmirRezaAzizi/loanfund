@extends('owner/master')

@section('page-title')
    <h1 class="h2">اطلاعات عضو اصلی
        <a href="/customers/{{ $customer->id }}/edit">
            <button type="button" class="btn btn-outline-primary btn-sm">ویرایش</button>
        </a>
    </h1>
@endsection

@section('content')
    <div class="show-info text-center">
        <a class="btn btn-link btn-show" data-toggle="collapse" href="#collapseTable" role="button" aria-expanded="false" aria-controls="collapseTable">
نمایش کامل اطلاعات
        </a>
    </div>
    <table class="table table-striped" style="table-layout: fixed;">
        <tbody>
            <tr>
                <th>شماره عضویت</th>
                <td>{{ $customer->id }}</td>
            </tr>
            <tr>
                <th>نام</th>
                <td>{{ $customer->fname }} {{ $customer->lname }}</td>
            </tr>
            @if($customer->description)
                <tr>
                    <th>توضیحات</th>
                    <td>{{ $customer->description }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    <table class="table table-striped collapse" id="collapseTable" style="margin-top: -1rem; table-layout: fixed;">
        <tbody>
            <tr>
                <th>وضعیت</th>
                <td class="{{ $customer->status == 'inactive' ? 'inactive-bg' : '' }}">{{ $customer->status == 'active' ? 'فعال' : 'غیرفعال در ' . $customer->closed_date }}</td>
            </tr>
            <tr>
                <th>نام پدر</th>
                <td>{{ $customer->father }}</td>
            </tr>
            <tr>
                <th>شماره ملی</th>
                <td>{{ $customer->national }}</td>
            </tr>
            <tr>
                <th>تلفن ثابت</th>
                <td>{{ $customer->phone }}</td>
            </tr>
            <tr>
                <th>شماره موبایل</th>
                <td>{{ $customer->mobile }}</td>
            </tr>
            <tr>
                <th>تاریخ تولد</th>
                <td>{{ $customer->birth }}</td>
            </tr>
            <tr>
                <th>نشانی</th>
                <td>{{ $customer->address }}</td>
            </tr>
            <tr>
                <th>کد پستی</th>
                <td>{{ $customer->post }}</td>
            </tr>
            <tr>
                <th>معرف</th>
                <td>{{ $customer->reference }}</td>
            </tr>
            <tr>
                <th>ضامن</th>
                <td>{{ $customer->sponsor }}</td>
            </tr>
            <tr>
                <th>تاریخ ثبت</th>
                <td>{{ $customer->created_at }}</td>
            </tr>
            <tr>
                <th>آخرین ویرایش</th>
                <td>{{ $customer->updated_at }}</td>
            </tr>
        </tbody>
    </table>
    <h2>دفاتر
        <a href="/customers/{{ $customer->id }}/bankbooks/create">
            <button type="button" class="btn btn-outline-primary btn-sm">ایجاد دفتر جدید</button>
        </a>
    </h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th colspan="4" style="border: 0"></th>
                <th colspan="2" class="text-center">مانده</th>
                <th colspan="2" style="border: 0"></th>
            </tr>
            <tr>
                <th>ردیف</th>
                <th>کد دفتر</th>
                <th>عنوان</th>
                <th>ماهیانه</th>
                <th>پس انداز</th>
                <th>وام</th>
                <th>قسط</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customer->bankbooks as $index => $bankbook)
                <tr class="{{ $bankbook-> status == 'inactive' ? 'inactive-bg' : '' }}">
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $bankbook->full_code }}</td>
                    <td>@if($bankbook->title){{ $bankbook->title }} @else {{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }} @endif</td>
                    <td class="text-left">{{ number_format($bankbook->monthly) }}</td>
                    <td class="text-left">{{ number_format($bankbook->first_balance) }}</td>
                    <td class="text-left">-</td>
                    <td class="text-left">-</td>
                    <td>
                        <a href="/bankbooks/{{ $bankbook->id }}" class="btn btn-outline-primary btn-sm" role="button">مشاهده</a>
                        <a href="/bankbooks/{{ $bankbook->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <h2>وام ها</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th colspan="6" style="border: 0"></th>
                <th colspan="3" class="text-center">اقساط</th>
                <th colspan="1" style="border: 0"></th>
            </tr>
            <tr>
                <th>ردیف</th>
                <th>شماره وام</th>
                <th>شماره دفترچه</th>
                <th>مبلغ وام</th>
                <th>مانده بدهی</th>
                <th>مبلغ</th>
                <th>کل</th>
                <th>پرداختی</th>
                <th>مانده</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customer->bankbooks as $bankbook)
                @foreach($bankbook->loans as $index => $loan)
                    <tr  class="{{ $loan-> status == 'inactive' ? 'inactive-bg' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-left">{{ $loan->id }}</td>
                        <td class="text-left">{{ sprintf("%04d", $loan->bankbook->customer->code) }}{{ sprintf("%03d", $loan->bankbook->code) }}</td>
                        <td class="text-left">{{ number_format($loan->total) }}</td>
                        <td class="text-left">{{ number_format($loan->now_balance()) }}</td>
                        <td class="text-left">{{ number_format($loan->monthly) }}</td>
                        <td class="text-left">{{ number_format($loan->total_number) }}</td>
                        <td class="text-left">-</td>
                        <td class="text-left">-</td>
                        <td>
                            <a href="/loans/{{ $loan->id }}" class="btn btn-outline-primary btn-sm" role="button">مشاهده</a>
                            <a href="/loans/{{ $loan->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
