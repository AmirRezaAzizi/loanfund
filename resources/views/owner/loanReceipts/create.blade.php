@extends('owner/master')

@section('page-title')
    <h1 class="h2">اطلاعات قسط دریافتی وام</h1>
@endsection

@section('content')
    <form method="POST" action="/loans/{{ $loan->id }}/receipts" class="needs-validation" novalidate>
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">{{ trans('global.customer.customerFullName') }}</label>
                <input type="text" class="form-control" id="fname" value="{{ $loan->bankbook->customer->fname }} {{ $loan->bankbook->customer->lname }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">{{ trans('global.customer.id') }}</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($loan->bankbook->customer->id) }}" readonly>
            </div>
        </div>
        <div class="form-row">

            <div class="form-group col-md-5">
                <label for="title">{{ trans('global.bankbook.title') }}</label>
                <input type="text" class="form-control" id="title" value="{{ $loan->bankbook->title }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">{{ trans('global.bankbook.full_code') }}</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($loan->bankbook->full_code) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>{{ trans('global.loan.nowBalance') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left" value="{{ convertNumbers(number_format($balance)) }}" readonly>
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ trans('global.global.currencyName') }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="id">{{ trans('global.loan.id') }}</label>
                <input type="text" class="form-control" id="id" value="{{ convertNumbers($loan->id) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="amount">{{ trans('global.receipt.amount') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control first_focus text-left @if ($errors->has('amount')) is-invalid @endif" id="amount" name="amount" required value="{{ convertNumbers(old('amount', $loan->monthly)) }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ trans('global.global.currencyName') }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="date">{{ trans('global.global.createDate') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('date')) is-invalid @endif" id="date" name="date" required value="{{ old('date', $date) }}" pattern="{4}/{2}/{2}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">xxxx/xx/xx</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    تاریخ باید اعداد انگلیسی و بصورت تاریخ شمسی باشد مانند: ۱۳۹۷/۰۸/۱۸
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="description">{{ trans('global.global.description') }}</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-10 text-left">
                <button type="submit" class="btn btn-primary btn-lg">{{ trans('global.global.submit') }}</button>
            </div>
        </div>
    </form>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
