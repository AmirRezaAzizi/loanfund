<?php
$thisMonthName = \Morilog\Jalali\Jalalian::forge('today')->format('%B ماه %Y');
?>
@extends('owner/master')

@section('page-title')
    <h1 class="h2">مجموع دریافتی ماهیانه</h1>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
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
                <td class="font-weight-bold">دریافتی ماه</td>
                @foreach(getPersianMonths() as $index => $name)
                    <td class="text-center font-weight-bold">{{ number_format($totalMonthlyIncome[$index]) }}</td>
                @endforeach
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td class="font-weight-bold">مانده از ماه قبل</td>
                <?php
                $balanceBeforeStartDateCopy = $balanceBeforeStartDate;
                ?>
                @foreach(getPersianMonths() as $index => $name)
                    @if($index == '01')
                        <td class="text-center font-weight-bold">{{ number_format($balanceBeforeStartDate) }}</td>
                    @else
                        <td class="text-center font-weight-bold">{{ number_format($balanceBeforeStartDate += $totalMonthlyIncome[sprintf('%02d', $index-1)]) }}</td>
                    @endif

                @endforeach
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td class="font-weight-bold">جمع وام های ماه</td>
                @foreach(getPersianMonths() as $index => $name)
                    <td class="text-center font-weight-bold">{{ number_format($loanMonthlyPaid[$index]) }}</td>
                @endforeach
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td class="font-weight-bold">جمع کل</td>
                @foreach(getPersianMonths() as $index => $name)
                    @if($index == '01')
                        <td class="text-center font-weight-bold">{{ number_format(($balanceBeforeStartDateCopy + $totalMonthlyIncome[$index]) - $loanMonthlyPaid[$index]) }}</td>
                    @else
                        <td class="text-center font-weight-bold">{{ number_format((($balanceBeforeStartDateCopy += $totalMonthlyIncome[sprintf('%02d', $index-1)]) + $totalMonthlyIncome[$index]) - $loanMonthlyPaid[$index]) }}</td>
                    @endif

                @endforeach
            </tr>


            <tr>
                <td></td>
                <td></td>
                <td class="font-weight-bold">تعداد وام های ماه</td>
                @foreach(getPersianMonths() as $index => $name)
                    <td class="text-center font-weight-bold">{{ number_format($loanMonthlyCount[$index]) }}</td>
                @endforeach
            </tr>

            </tbody>
        </table>
    </div>
@endsection
