@extends('owner/master')

@section('page-title')
    <h1 class="h2">{{ trans('global.global.edit') }} قبض دفترچه پس انداز</h1>
@endsection

@section('content')
    <form method="POST" action="/bankbookReceipts/{{ $bankbookReceipt->id }}" class="needs-validation" novalidate>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">{{ trans('global.customer.fname') }} و {{ trans('global.customer.lname') }}</label>
                <input type="text" class="form-control" id="fname" value="{{ $bankbookReceipt->bankbook->customer->fname }} {{ $bankbookReceipt->bankbook->customer->lname }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">{{ trans('global.customer.id') }}</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($bankbookReceipt->bankbook->customer->id) }}" readonly>
            </div>

        </div>
        <div class="form-row">

            <div class="form-group col-md-5">
                <label for="title">{{ trans('global.bankbook.title') }}</label>
                <input type="text" class="form-control" id="title" value="@if($bankbookReceipt->bankbook->title){{ $bankbookReceipt->bankbook->title }} @else {{ $bankbookReceipt->bankbook->customer->fname }} {{ $bankbookReceipt->bankbook->customer->lname }} @endif" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">{{ trans('global.bankbook.full_code') }}</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($bankbookReceipt->bankbook->full_code) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5" style="margin-top: 12px;">
                <label>موجودی</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left" value="{{ convertNumbers(number_format($balance)) }}" readonly>
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ trans('global.global.currencyName') }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <div class="radio-inline" style="padding: .375rem 1.40rem;">
                    <label for="deposit">
                        <input type="radio" id="deposit" name="type" value="deposit"
                                {{ old('type', $bankbookReceipt->type) == 'deposit' ? 'checked' : '' }}
                        > {{ trans('global.global.deposit') }}
                    </label>
                    <label for="withdraw">
                        <input type="radio" id="withdraw" name="type" value="withdraw"
                                {{ old('type', $bankbookReceipt->type) == 'withdraw' ? 'checked' : '' }}
                        > {{ trans('global.global.withdraw') }}
                    </label>
                </div>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('amount')) is-invalid @endif" id="amount" name="amount" required value="{{ convertNumbers(old('amount', $bankbookReceipt->amount)) }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ trans('global.global.currencyName') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="date">تاریخ</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('date')) is-invalid @endif" id="date" name="date" required value="{{ old('date', $bankbookReceipt->date) }}" pattern="{4}/{2}/{2}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">xxxx/xx/xx</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    تاریخ باید اعداد انگلیسی و بصورت تاریخ شمسی باشد مانند: ۱۳۹۷/۰۸/۱۸
                </div>
            </div>
            <div class="col-md-5 text-left" style="margin-top: 24px">
                <button type="submit" class="btn btn-primary btn-lg">{{ trans('global.global.submit') }}</button>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="description">{{ trans('global.global.description') }}</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $bankbookReceipt->description) }}</textarea>
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
