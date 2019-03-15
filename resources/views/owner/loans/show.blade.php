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
            <td>{{ $loan->bankbook->customer->id }}/{{ $loan->bankbook->code }}</td>
        </tr>
        <tr>
            <th>وضعیت</th>
            <td class="{{ $loan->status == 'inactive' ? 'inactive-bg' : '' }}">{{ $loan->status == 'active' ? 'فعال' : 'غیرفعال' }}</td>
        </tr>
        <tr>
            <th>نام عضو اصلی</th>
            <td>{{ $loan->bankbook->customer->fname }} {{ $loan->bankbook->customer->lname }}</td>
        </tr>
        <tr>
            <th>عنوان دفترچه</th>
            <td>{{ $loan->bankbook->title }}</td>
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
            <td>{{ $loan->now_balance() }}</td>
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
        <tr>
            <th>تاریخ آخرین ویرایش</th>
            <td>{{ $updated_at }}</td>
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
    <h2>دریافتی ها
        <a href="/loans/{{ $loan->id }}/receipts/create">
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
                <th>مبلغ پرداختی</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>

            @foreach($loan->loanReceipts as $key => $receipt)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $receipt->id }}</td>
                    <td>{{ $receipt->date }}</td>
                    <td>{{ $receipt->amount }}</td>
                    <td>
                        <a href="/loanReceipts/{{ $receipt->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
