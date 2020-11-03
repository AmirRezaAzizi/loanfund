<?php
$thisMonthName = \Morilog\Jalali\Jalalian::forge('today')->format('%B ماه %Y');
?>
@extends('owner/master')

@section('page-title')
    <h1 class="h2">مجموع دریافتی ماهیانه</h1>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-sm table-hover">
            <thead>
            <tr>
                <th>{{ trans('global.global.row') }}</th>
                <th>{{ trans('global.customer.lname') }}</th>
                <th>{{ trans('global.customer.fname') }}</th>
                @foreach(getPersianMonths() as $index => $name)
                    <th class="text-center">{{ $name }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $index => $customer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $customer['lname'] }}</td>
                    <td>{{ $customer['fname'] }}</td>
                    @foreach(getPersianMonths() as $index => $name)
                        <th class="text-center">{{ number_format($customer['customerTotalMonthly'][$index]) }}</th>
                    @endforeach
                </tr>
            @endforeach

            <tr>
                <td></td>
                <td></td>
                <td class="font-weight-bold">دریافتی این ماه</td>
                @foreach(getPersianMonths() as $index => $name)
                    <td class="text-center font-weight-bold">{{ number_format($totalMonthlyIncome[$index]) }}</td>
                @endforeach
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td class="font-weight-bold">مانده از ماه قبل
                    <br>
                    (صندوق)
                </td>
                @foreach(getPersianMonths() as $index => $name)
                    <td class="text-center font-weight-bold">{{ number_format($balanceFromPreviousMonth[$index]) }}</td>

                @endforeach
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td class="font-weight-bold">جمع کل</td>
                @foreach(getPersianMonths() as $index => $name)
                        <td class="text-center font-weight-bold">{{ number_format($totalMonthlyBalance[$index]) }}</td>
                @endforeach
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td class="font-weight-bold">جمع وام های پرداختی</td>
                @foreach(getPersianMonths() as $index => $name)
                    <td class="text-center font-weight-bold">{{ number_format($loanMonthlyPaid[$index]) }} ({{ number_format($loanMonthlyCount[$index]) }})</td>
                @endforeach
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td class="font-weight-bold">مانده برای ماه بعد</td>
                @foreach(getPersianMonths() as $index => $name)
                    <td class="text-center font-weight-bold">{{ number_format($balanceForNextMonth[$index]) }}</td>

                @endforeach
            </tr>

            </tbody>
        </table>
    </div>
@endsection
