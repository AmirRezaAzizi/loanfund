@extends('owner/master')

@section('page-title')
    <h1 class="h2">ایجاد عضو جدید</h1>
@endsection

@section('content')
    <form method="POST" action="/customers" class="needs-validation" novalidate>
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">{{ trans('global.customer.fname') }}</label>
                <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') }}" required>
                <div class="invalid-feedback">
{{ trans('global.customer.fname') }} الزامی می باشد
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="lname">{{ trans('global.customer.fname') }} خانوادگی</label>
                <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') }}" required>
                <div class="invalid-feedback">
                    {{ trans('global.customer.lname') }} الزامی می باشد
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="national">شماره ملی</label>
                <input type="text" pattern="{10}" title="Must contain at least one numbe" class="form-control text-left @if ($errors->has('national')) is-invalid @endif" id="national" name="national" value="{{ old('national') }}">
                <div class="invalid-feedback">
                    شماره ملی الزامی بوده و باید ۱۰ رقم و به زبان فارسی باشد
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="father">{{ trans('global.customer.fname') }} پدر</label>
                <input type="text" class="form-control" id="father" name="father" value="{{ old('father') }}">
            </div>
            <div class="form-group col-md-5">
                <label for="birth">تاریخ تولد</label>
                <input type="text" class="form-control text-left" id="birth" placeholder="xxxx/xx/xx" name="birth" value="{{ old('birth') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="mobile">{{ trans('global.customer.mobile') }}</label>
                <input type="text" class="form-control text-left @if ($errors->has('mobile')) is-invalid @endif" id="mobile" placeholder="۰۹xxxxxxxxx" name="mobile" pattern="{11}" value="{{ old('mobile') }}" required>
                <div class="invalid-feedback">
{{ trans('global.customer.mobile') }} الزامی بوده و باید ۱۱ رقم و به زبان فارسی باشد
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="phone">تلفن ثابت</label>
                <input type="text" class="form-control text-left @if ($errors->has('phone')) is-invalid @endif" id="phone" placeholder="۰۲۱xxxxxxxx" name="phone" pattern="{11}" value="{{ old('phone') }}">
                <div class="invalid-feedback">
                    شماره ثابت الزامی بوده و باید ۱۱ رقم و به زبان فارسی باشد
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-10">
                <label for="address">نشانی</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="post">کد پستی</label>
                <input type="text" class="form-control text-left @if ($errors->has('post')) is-invalid @endif" id="post" name="post" pattern="{10}" value="{{ old('post') }}">
                <div class="invalid-feedback">
                    کد پستی باید ۱۰ رقمی باشد
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="reference">معرف</label>
                <input type="text" class="form-control" id="reference" name="reference" value="{{ old('reference') }}">
            </div>
            <div class="form-group col-md-5">
                <label for="sponsor">{{ trans('global.loan.sponsor') }}</label>
                <input type="text" class="form-control" id="sponsor" name="sponsor" value="{{ old('sponsor') }}">
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
