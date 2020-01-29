@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفاتر {{ $title }}</h1>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th colspan="4" style="border: 0"></th>
                <th colspan="2" class="text-center">مانده</th>
                <th colspan="2" class="text-center">اقساط</th>
                <th colspan="1" style="border: 0"></th>
            </tr>
            <tr>
                <th>{{ trans('global.global.row') }}</th>
                <th>{{ trans('global.bankbook.full_code') }}</th>
                <th>{{ trans('global.customer.fname') }}</th>
                <th>{{ trans('global.bankbook.monthly') }}</th>
                <th>پس انداز</th>
                <th>وام</th>
                <th>{{ trans('global.loan.monthly') }}</th>
                <th>تعداد</th>
                <th>{{ trans('global.global.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bankbooks as $index => $bankbook)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $bankbook->full_code }}</td>
                    <td>@if($bankbook->title){{ $bankbook->title }} @else {{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }} @endif</td>
                    <td class="text-left">{{ number_format($bankbook->monthly) }}</td>
                    <td class="text-left">{{ number_format($bankbook->now_balance()) }}</td>
                    <td class="text-left">
                        <?php
                            $activeLoan = $bankbook->activeLoan();
                        ?>
                        @if($activeLoan)
                            {{ number_format($activeLoan->now_balance())  }}
                        @endif
                    </td>
                    <td class="text-left">
                        @if($activeLoan)
                            {{ number_format($activeLoan->monthly)  }}
                        @endif
                    </td>
                    <td class="text-left">
                        @if($activeLoan)
                            {{ $activeLoan->total_not_paid  }}
                        @endif
                    </td>
                    <td>
                        <a href="/bankbooks/{{ $bankbook->id }}" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.show') }}</a>
                        <a href="/bankbooks/{{ $bankbook->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.edit') }}</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
