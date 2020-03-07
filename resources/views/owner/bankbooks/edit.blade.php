@extends('owner/master')

@section('page-title')
    <h1 class="h2">{{ trans('global.global.edit') }} دفترچه پس انداز</h1>
@endsection

@section('content')
    <form method="POST" action="/bankbooks/{{ $bankbook->id }}" class="needs-validation" novalidate>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="code">{{ trans('global.customer.id') }}</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($bankbook->customer->id) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">{{ trans('global.customer.fname') }}</label>
                <input type="text" class="form-control" id="fname" value="{{ $bankbook->customer->fname }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="lname">{{ trans('global.customer.lname') }}</label>
                <input type="text" class="form-control" id="lname" value="{{ $bankbook->customer->lname }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="code">{{ trans('global.bankbook.full_code') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left" id="code" value="{{ convertNumbers($bankbook->full_code) }}" readonly>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="title">{{ trans('global.bankbook.title') }}</label>
                <div class="input-group mb-2">
                    ‍<input type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" id="title" name="title" value="{{ old('title', $bankbook->title) }}">
                </div>
                <p> در صورت خالی بودن این فیلد، {{ trans('global.customer.fname') }} و {{ trans('global.customer.lname') }} {{ trans('global.customer.customerFullName') }} نمایش داده می شود.</p>
            </div>
        </div>
        {{--<div class="form-row">--}}
            {{--<div class="form-group col-md-5">--}}
                {{--<label for="first_balance">{{ trans('global.receipt.amount') }} افتتاح حساب</label>--}}
                {{--<div class="input-group mb-2">--}}
                    {{--‍‍  <input type="text" class="form-control text-left @if ($errors->has('first_balance')) is-invalid @endif" id="first_balance" name="first_balance" required value="{{ convertNumbers(old('first_balance', $bankbook->first_balance)) }}">--}}
                    {{--<div class="input-group-prepend">--}}
                        {{--<div class="input-group-text">{{ trans('global.global.currencyName') }}</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="invalid-feedback">--}}
                    {{--{{ trans('global.receipt.amount') }} باید فقط شامل اعداد باشد.--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="monthly">{{ trans('global.bankbook.monthly') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('monthly')) is-invalid @endif" id="monthly" name="monthly" required value="{{ convertNumbers(old('monthly', $bankbook->monthly)) }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ trans('global.global.currencyName') }}</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    {{ trans('global.receipt.amount') }} باید فقط شامل اعداد باشد.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="created_date">{{ trans('global.global.createDate') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('created_date')) is-invalid @endif" id="created_date" name="created_date" required value="{{ old('created_date', $bankbook->created_date) }}" pattern="{4}/{2}/{2}">
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
                <label for="status">{{ trans('global.bankbook.status') }}</label>
                <select name="status" id="status" class="form-control">
                    <option value="active"
                            {{ old('status') == 'active' ? 'selected' : '' }}
                            {{ $bankbook->status == 'active' ? 'selected' : '' }}
                    >فعال
                    </option>

                    <option value="inactive"
                            {{ old('status') == 'inactive' ? 'selected' : '' }}
                            {{ $bankbook->status == 'inactive' ? 'selected' : '' }}
                    >غیر فعال
                    </option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="closed_date">تاریخ غیرفعالسازی</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('closed_date')) is-invalid @endif" id="closed_date" name="closed_date" value="{{ old('closed_date', $bankbook->closed_date) }}" pattern="{4}/{2}/{2}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">xxxx/xx/xx</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    تاریخ باید اعداد و بصورت تاریخ شمسی باشد مانند: ۱۳۹۷/۰۸/۱۸
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-10">
                <button type="submit" class="btn float-left btn-primary btn-lg">ذخیره</button>
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
