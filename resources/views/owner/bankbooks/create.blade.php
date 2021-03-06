@extends('owner/master')

@section('page-title')
    <h1 class="h2">ایجاد دفتر پس انداز</h1>
@endsection

@section('content')
    <form method="POST" action="/customers/{{ $customer->id }}/bankbooks" class="needs-validation" novalidate>
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="code">{{ trans('global.customer.id') }}</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($customer->id) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">{{ trans('global.customer.customerFullName') }}</label>
                <input type="text" class="form-control" id="fname" value="{{ $customer->fname }} {{ $customer->lname }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="title">{{ trans('global.bankbook.title') }}</label>
                <div class="input-group mb-2">
                    ‍<input type="text" class="form-control text-left @if ($errors->has('title')) is-invalid @endif" id="title" name="title" value="{{ old('title') }}">
                </div>
                <p><i class="fas fa-exclamation-triangle" style="color: #ff6666"></i>&nbsp;در صورت خالی بودن این فیلد، {{ trans('global.customer.fname') }} و {{ trans('global.customer.lname') }} عضو نمایش داده می شود.</p>
            </div>
        </div>
        {{--<div class="form-row">--}}
            {{--<div class="form-group col-md-5">--}}
                {{--<label for="first_balance">{{ trans('global.receipt.amount') }} افتتاح حساب</label>--}}
                {{--<div class="input-group mb-2">--}}
                    {{--‍‍  <input type="text" class="form-control text-left @if ($errors->has('first_balance')) is-invalid @endif" id="first_balance" name="first_balance" required value="{{ old('first_balance') }}">--}}
                    {{--<div class="input-group-prepend">--}}
                        {{--<div class="input-group-text">{{ trans('global.global.currencyName') }}</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="invalid-feedback">--}}
                    {{--{{ trans('global.receipt.amount') }} باید فقط شامل اعداد انگلیسی باشد.--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="monthly">{{ trans('global.bankbook.monthly') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('monthly')) is-invalid @endif" id="monthly" name="monthly" required value="{{ old('monthly') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ trans('global.global.currencyName') }}</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    {{ trans('global.bankbook.amount') }} باید فقط شامل اعداد انگلیسی باشد.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="created_date">{{ trans('global.global.createDate') }}</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('created_date')) is-invalid @endif" id="created_date" name="created_date" required value="{{ old('created_date', $date) }}" pattern="{4}/{2}/{2}">
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
            <div class="col-md-10">
                <button type="submit" class="btn float-left btn-primary btn-lg">{{ trans('global.global.submit') }}</button>
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
