@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفترچه پس انداز
        <a href="/bankbooks/{{ $bankbook->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
    </h1>
@endsection

@section('content')
    <table class="table table-striped">
        <tbody>

        <tr>
            <th>شماره دفتر</th>
            <td>{{ $bankbook->full_code }}</td>
        </tr>
        <tr>
            <th>وضعیت</th>
            <td class="{{ $bankbook->status == 'inactive' ? 'inactive-bg' : '' }}">
                {{ $bankbook->status == 'active' ? 'فعال' :  'غیرفعال شده در ' . $bankbook->closed_date }}
            </td>

        </tr>
        <tr>
            <th>عضو اصلی</th>
            <td><a href="/customers/{{ $bankbook->customer->id }}">{{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }}</a></td>
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
            <td>{{ number_format($bankbook->first_balance) }}</td>
        </tr>
        <tr>
            <th>مبلغ پس انداز ماهیانه</th>
            <td>{{ number_format($bankbook->monthly) }}</td>
        </tr>
        <tr>
            <th>مانده پس انداز</th>
            <td>{{ number_format($bankbook->now_balance()) }}</td>
        </tr>
        <tr>
            <th>مانده وام</th>
            <td>{{ number_format(0) }}</td>
        </tr>
        <tr>
            <th>مبلغ قسط</th>
            <td>{{  number_format(0) }}</td>
        </tr>
        <tr>
            <th>تاریخ ثبت</th>
            <td>{{ $bankbook->created_date }}</td>
        </tr>
        <tr>
            <th>تاریخ آخرین ویرایش</th>
            <td>{{ $bankbook->updated_at }}</td>
        </tr>
        </tbody>
    </table>
    <h2>
        <a data-toggle="collapse" href="#collapseDepositsTable" role="button" aria-expanded="false" aria-controls="collapseDepositsTable" style="color: #000">واریز و برداشت ها</a>
        <a href="/bankbooks/{{ $bankbook->id }}/receipts/create">
            <button type="button" class="btn btn-outline-primary btn-sm">ایجاد قبض جدید</button>
        </a>
    </h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm collapse show" id="collapseDepositsTable">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>شماره قبض</th>
                <th>تاریخ</th>
                <th>واریز</th>
                <th>برداشت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>

            @foreach($bankbookReceipts as $key => $receipt)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td class="text-left">{{ $receipt->id }}</td>
                    <td class="text-left">{{ $receipt->date }}</td>
                    <td class="text-left">
                        @if($receipt->type == 'deposit')
                            {{ number_format($receipt->amount) }}
                        @endif
                    </td>
                    <td class="text-left">
                        @if($receipt->type == 'withdraw')
                            {{ number_format($receipt->amount) }}
                        @endif
                    </td>
                    <td>
                        <a href="/bankbookReceipts/{{ $receipt->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <h2>
        <a data-toggle="collapse" href="#collapseLoansTable" role="button" aria-expanded="false" aria-controls="collapseLoansTable" style="color: #000">وام ها</a>
        <a href="/bankbooks/{{ $bankbook->id }}/loans/create" class="btn btn-outline-primary btn-sm" role="button">ایجاد وام</a>
    </h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm collapse show" id="collapseLoansTable">
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
                @foreach($bankbook->loans as $index => $loan)
                    <tr  class="{{ $loan-> status == 'inactive' ? 'inactive-bg' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-left">{{ $loan->id }}</td>
                        <td class="text-left">{{ $loan->bankbook->full_code }}</td>
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
            </tbody>
        </table>
    </div>
    @include('owner/layouts/footer')
@endsection