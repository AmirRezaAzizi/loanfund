@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفترچه پس انداز
        <a href="/bankbooks/{{ $bankbook->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.edit') }}</a>
    </h1>
@endsection

@section('content')
    <table class="table table-striped">
        <tbody>

        <tr>
            <th>{{ trans('global.bankbook.full_code') }}</th>
            <td>{{ $bankbook->full_code }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.bankbook.status') }}</th>
            <td class="{{ $bankbook->status == 'inactive' ? 'inactive-bg' : '' }}">
                {{ $bankbook->status == 'active' ? 'فعال' :  'غیرفعال شده در ' . $bankbook->closed_date }}
            </td>

        </tr>
        <tr>
            <th>{{ trans('global.customer.customerFullName') }}</th>
            <td><a href="/customers/{{ $bankbook->customer->id }}">{{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }}</a></td>
        </tr>
        <tr>
            <th>{{ trans('global.bankbook.title') }}</th>
            <td>@if($bankbook->title){{ $bankbook->title }} @else {{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }} @endif</td>
        </tr>
        <tr>
            <th>{{ trans('global.customer.mobile') }}</th>
            <td>{{ $bankbook->customer->mobile }}</td>
        </tr>
        {{--<tr>--}}
            {{--<th>{{ trans('global.receipt.amount') }} افتتاح حساب</th>--}}
            {{--<td>{{ number_format($bankbook->first_balance) }}</td>--}}
        {{--</tr>--}}
        <tr>
            <th>{{ trans('global.bankbook.monthly') }}</th>
            <td>{{ number_format($bankbook->monthly) }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.bankbook.nowBalance') }}</th>
            <td>{{ number_format($bankbook->now_balance()) }}</td>
        </tr>
        <tr>
            <th>مانده وام</th>
            <td>
                @if($bankbook->activeLoan())
                    {{ number_format($bankbook->activeLoan()->now_balance())  }}
                @endif
            </td>
        </tr>
        <tr>
            <th>مبلغ قسط</th>
            <td>@if($bankbook->activeLoan())
                    {{ number_format($bankbook->activeLoan()->monthly)  }}
                @endif
            </td>
        </tr>
        <tr>
            <th>{{ trans('global.global.description') }}</th>
            <td>{{ $bankbook->description }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.global.createDate') }}</th>
            <td>{{ $bankbook->created_date }}</td>
        </tr>
        <tr>
            <th>{{ trans('global.global.updateDate') }}</th>
            <td>{{ $bankbook->updated_at }}</td>
        </tr>
        </tbody>
    </table>
    <h2>
        <a data-toggle="collapse" href="#collapseDepositsTable" role="button" aria-expanded="false" aria-controls="collapseDepositsTable" style="color: #000">{{ trans('global.global.deposit') }} و {{ trans('global.global.withdraw') }} ها</a>
        <a href="/bankbooks/{{ $bankbook->id }}/receipts/create">
            <button type="button" class="btn btn-outline-primary btn-sm">ایجاد قبض جدید</button>
        </a>
    </h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm collapse show" id="collapseDepositsTable">
            <thead>
            <tr>
                <th>{{ trans('global.global.row') }}</th>
                <th>{{ trans('global.receipt.id') }}</th>
                <th>{{ trans('global.receipt.date') }}</th>
                <th>{{ trans('global.global.deposit') }}</th>
                <th>{{ trans('global.global.withdraw') }}</th>
                <th>{{ trans('global.global.description') }}</th>
                <th>{{ trans('global.global.action') }}</th>
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
                    <td>{{ $receipt->description }}</td>
                    <td>
                        @if($receipt->confirmed)
                            <button class="btn btn-outline-danger btn-sm">‌{{ trans('global.global.confirmed') }}</button>
                        @else
                            <form method="POST" action="/bankbookReceipts/{{ $receipt->id }}/">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <div class="form-group">
                                    <a href="/bankbookReceipts/{{ $receipt->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.edit') }}</a>
                                    <input type="submit" class="btn btn-danger btn-sm" value="حذف">
                                </div>
                            </form>
                        @endif
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
                <th colspan="3" class="text-center">تعداد اقساط</th>
                <th colspan="1" style="border: 0"></th>
            </tr>
            <tr>
                <th>{{ trans('global.global.row') }}</th>
                <th>{{ trans('global.loan.id') }}</th>
                <th>{{ trans('global.bankbook.full_code') }}</th>
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
                @foreach($bankbook->loans()->active()->get() as $index => $loan)
                    <tr  class="{{ $loan-> status == 'inactive' ? 'inactive-bg' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-left">{{ $loan->id }}</td>
                        <td class="text-left">{{ $loan->bankbook->full_code }}</td>
                        <td class="text-left">{{ number_format($loan->total) }}</td>
                        <td class="text-left">{{ number_format($loan->now_balance()) }}</td>
                        <td class="text-left">{{ number_format($loan->monthly) }}</td>
                        <td class="text-left">{{ number_format($loan->total_number) }}</td>
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
    @include('owner/layouts/footer')
@endsection
