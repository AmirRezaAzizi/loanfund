@extends('owner/master')

@section('page-title')
    <h1 class="h2">اطلاعات وام</h1>
@endsection

@section('content')
    <form method="POST" action="/bankbooks/{{ $bankbook->id }}/loans" class="needs-validation" novalidate>
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">{{ trans('global.customer.customerFullName') }}</label>
                <input type="text" class="form-control" id="fname" value="{{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">{{ trans('global.customer.id') }}</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($bankbook->customer->id) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="title">{{ trans('global.bankbook.title') }}</label>
                <input type="text" class="form-control" id="title" value="{{ $bankbook->title }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">{{ trans('global.bankbook.full_code') }}</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($bankbook->full_code) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="total">{{ trans('global.loan.total') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('total')) is-invalid @endif" id="total" name="total" required value="{{ old('total') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ trans('global.global.currencyName') }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="total_number">{{ trans('global.loan.total_number') }}</label>
                <div class="input-group mb-2">
                    ‍‍<input type="text" class="form-control text-left @if ($errors->has('total_number')) is-invalid @endif" id="total_number" name="total_number" required value="{{ old('total_number') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">قسط</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="monthly">{{ trans('global.loan.monthly') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('monthly')) is-invalid @endif" id="monthly" name="monthly" required value="{{ old('monthly') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ trans('global.global.currencyName') }}</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="created_date">{{ trans('global.global.createDate') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('created_date')) is-invalid @endif" id="created_date" name="created_date" required value="{{ old('created_date', $date) }}" pattern="{4}/{2}/{2}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">xxxx/xx/xx</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    تاریخ باید بصورت تاریخ شمسی باشد مانند: ۱۳۹۷/۰۸/۱۸
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="sponsor">{{ trans('global.loan.sponsor') }}</label>
                <input type="text" class="form-control" id="sponsor" name="sponsor" value="{{ old('sponsor') }}" required>
            </div>
            <div class="col-md-5 text-left">
                <button type="submit" class="btn btn-primary btn-lg" style="margin-top: 24px">{{ trans('global.global.submit') }}</button>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="description">{{ trans('global.global.description') }}</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
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
