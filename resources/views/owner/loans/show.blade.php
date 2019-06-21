@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفترچه وام
        <a href="/loans/{{ $loan->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.edit') }}</a>
    </h1>
@endsection

@section('content')
    <table class="table table-striped">
        <tbody>
        <tr>
            <th>{{ trans('global.loan.id') }}</th>
            <td>{{ $loan->id }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.bankbook.full_code') }}</th>
            <td>{{ $loan->bankbook->full_code }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.loan.status') }}</th>
            <td class="{{ $loan->status == 'inactive' ? 'inactive-bg' : '' }}">{{ $loan->status == 'active' ? 'فعال' : 'غیرفعال (تسویه شده) از ' . $loan->closed_date }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.customer.customerFullName') }}</th>
            <td><a href="/customers/{{ $loan->bankbook->customer->id }}">{{ $loan->bankbook->customer->fname }} {{ $loan->bankbook->customer->lname }}</a></td>
        </tr>
        <tr>
            <th>{{ trans('global.bankbook.title') }}</th>
            <td>{{ $loan->bankbook->title }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.customer.mobile') }}</th>
            <td>{{ $loan->bankbook->customer->mobile }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.loan.sponsor') }}</th>
            <td>{{ $loan->sponsor }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.global.description') }}</th>
            <td>{{ $loan->description }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.loan.total') }}</th>
            <td>{{ number_format($loan->total) }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.loan.nowBalance') }}</th>
            <td>{{ number_format($loan->now_balance()) }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.loan.monthly') }}</th>
            <td>{{ number_format($loan->monthly) }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.loan.total_not_paid') }}</th>
            <td>{{ $loan->total_not_paid }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.loan.created_date') }}</th>
            <td>{{ $loan->created_date }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.global.updateDate') }}</th>
            <td>{{ $loan->updated_at }}</td>
        </tr>

        </tbody>
    </table>
    <h2>دریافتی ها
        <a href="/loans/{{ $loan->id }}/receipts/create">
            <button type="button" class="btn btn-outline-primary btn-sm">ایجاد قبض جدید</button>
        </a>
    </h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th>{{ trans('global.global.row') }}</th>
                <th>{{ trans('global.receipt.id') }}</th>
                <th>{{ trans('global.receipt.date') }}</th>
                <th>{{ trans('global.receipt.amount') }}</th>
                <th>{{ trans('global.global.description') }}</th>
                <th>{{ trans('global.global.action') }}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($loanReceipts as $key => $receipt)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td class="text-left">{{ $receipt->id }}</td>
                    <td class="text-left">{{ $receipt->date }}</td>
                    <td class="text-left">{{ number_format($receipt->amount) }}</td>
                    <td>{{ $receipt->description }}</td>
                    <td>
                        @if($receipt->confirmed)
                            <button class="btn btn-outline-danger btn-sm">‌{{ trans('global.global.confirmed') }}</button>
                        @else
                            <a href="/loanReceipts/{{ $receipt->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.edit') }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('owner/layouts/footer')
@endsection
