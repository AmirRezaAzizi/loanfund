<?php
$thisMonthName = \Morilog\Jalali\Jalalian::forge('today')->format('%B ماه %Y');
?>
@extends('owner/master')

@section('page-title')
    <h1 class="h2">ایجاد گروهی قبوض</h1>
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            <form action="/bulk-receipt" method="POST">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-12">
                                <p>× برای دفاتر و وام هایی که حداقل یک قبض برای تاریخ {{ '۳۰ ' . $thisMonthName }} دارند، قبض جدید صادر نمی شود. </p>
                            </div>
                        </div>
                        <div class="row">

                            @csrf
                            <div class="col-md-6">
                                <button name="action" value="bankbooks" class="btn btn-lg btn-primary">ایجاد قبوض پس انداز {{ $thisMonthName }}</button>
                            </div>
                            <div class="col-md-6">
                                <button name="action" value="loans" class="btn btn-lg btn-secondary">ایجاد قبوض وام {{ $thisMonthName }}</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

            @if(!empty($successMsg))
                <div class="alert alert-success mt-3"> {{ $successMsg }}</div>
            @endif
        </div>
    </div>
    @if(!empty($debtIsLessThanMonthly))
        <div class="row mb-4">
            <div class="col-md-8 offset-sm-2">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning mt-3"><h5 class="card-title">قبوض وام های زیر بدلیل مغایرت ایجاد نشد.</h5></div>
                        <table class="table table-striped">
                            @foreach($debtIsLessThanMonthly as $loan)
                                <tr>
                                    <td>
                                        <p class="card-text">{{ trans('global.loan.id') }} : {{ $loan->id }}</p>
                                        <p class="card-text">{{ trans('global.customer.customerFullName') }} : <a href="/customers/{{ $loan->bankbook->customer->id }}" target="_blank">{{ $loan->bankbook->customer->fname }} {{ $loan->bankbook->customer->lname }}</a></p>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(!empty($doneLoans))
        <div class="row mb-4">
            <div class="col-md-8 offset-sm-2">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-primary mt-3"><h5 class="card-title">وام های زیر غیرفعال (تسویه) شدند.</h5></div>
                        <table class="table table-striped">
                            @foreach($doneLoans as $loan)
                                <tr>
                                    <td>
                                        <p class="card-text">{{ trans('global.loan.id') }} : {{ $loan->id }}</p>
                                        <p class="card-text">{{ trans('global.customer.customerFullName') }} : <a href="/customers/{{ $loan->bankbook->customer->id }}" target="_blank">{{ $loan->bankbook->customer->fname }} {{ $loan->bankbook->customer->lname }}</a></p>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
