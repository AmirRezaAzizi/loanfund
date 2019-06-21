@extends('owner/master')

@section('page-title')
    <h1 class="h2">وام های {{ $title }}</h1>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
              <tr>
                  <th colspan="7" style="border: 0"></th>
                  <th colspan="4" class="text-center">اقساط</th>
                  <th colspan="1" style="border: 0"></th>
              </tr>
            <tr>
                <th>{{ trans('global.global.row') }}</th>
                <th>{{ trans('global.loan.id') }}</th>
                <th>{{ trans('global.bankbook.full_code') }}</th>
                <th>{{ trans('global.global.row') }}</th>
                <th>{{ trans('global.customer.fname') }}</th>
                <th>{{ trans('global.loan.total') }}</th>
                <th>{{ trans('global.loan.nowBalance') }}</th>
                <th>{{ trans('global.loan.monthly') }}</th>
                <th>کل</th>
                <th>پرداختی</th>
                <th>مانده</th>
                <th>{{ trans('global.global.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($loans as $index => $loan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $loan->id }}</td>
                    <td class="text-left">{{ $loan->bankbook->full_code }}</td>
                    <td>{{ $loan->bankbook->customer->lname }}</td>
                    <td>{{ $loan->bankbook->customer->fname }}</td>
                    <td class="text-left">{{ number_format($loan->total) }}</td>
                    <td class="text-left">{{ number_format($loan->now_balance()) }}</td>
                    <td class="text-left">{{ number_format($loan->monthly) }}</td>
                    <td class="text-left">{{ $loan->total_number }}</td>
                    <td class="text-left">{{ count($loan->loanReceipts) }}</td>
                    <td class="text-left">{{ $loan->total_number - count($loan->loanReceipts)}}</td>
                    <td>
                        <a href="/loans/{{ $loan->id }}" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.show') }}</a>
                        <a href="/loans/{{ $loan->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.edit') }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
