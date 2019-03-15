@extends('owner/master')

@section('page-title')
    <h1 class="h2">ویرایش دفترچه پس انداز</h1>
@endsection

@section('content')
    <form method="POST" action="/bankbooks/{{ $bankbook->id }}/" class="needs-validation" novalidate>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="code">شماره عضویت</label>
                <input type="text" class="form-control" id="code" value="{{ \Morilog\Jalali\CalendarUtils::convertNumbers($bankbook->customer->id) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">نام</label>
                <input type="text" class="form-control" id="fname" value="{{ $bankbook->customer->fname }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="lname">نام خانوادگی</label>
                <input type="text" class="form-control" id="lname" value="{{ $bankbook->customer->lname }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="code">شماره دفترچه</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('code')) is-invalid @endif" id="code" name="code" required value="{{ old('code', sprintf("%03d", $bankbook->code)) }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ \Morilog\Jalali\CalendarUtils::convertNumbers(sprintf("%04d", $bankbook->customer->code)) }}</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    شماره دفترچه الزامی٬ سه رقمی و غیرتکراری می باشد.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="title">عنوان دفترچه</label>
                <div class="input-group mb-2">
                    ‍<input type="text" class="form-control @if ($errors->has('title')) is-invalid @endif" id="title" name="title" value="{{ \Morilog\Jalali\CalendarUtils::convertNumbers(old('title', $bankbook->title)) }}">
                </div>
                <p>در صورت خالی بودن این فیلد، نام و نام خانوادگی عضو اصلی نمایش داده می شود.</p>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="first_balance">مبلغ افتتاح حساب</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('first_balance')) is-invalid @endif" id="first_balance" name="first_balance" required value="{{ \Morilog\Jalali\CalendarUtils::convertNumbers(old('first_balance', $bankbook->first_balance)) }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    مبلغ باید فقط شامل اعداد باشد.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="monthly">مبلغ ماهیانه</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('monthly')) is-invalid @endif" id="monthly" name="monthly" required value="{{ \Morilog\Jalali\CalendarUtils::convertNumbers(old('monthly', $bankbook->monthly)) }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    مبلغ باید فقط شامل اعداد باشد.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="created_date">تاریخ ثبت</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('created_date')) is-invalid @endif" id="created_date" name="created_date" required value="{{ \Morilog\Jalali\CalendarUtils::convertNumbers(old('created_date', $created_date)) }}" pattern="{4}/{2}/{2}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">xxxx-xx-xx</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    تاریخ باید بصورت تاریخ شمسی باشد مانند: ۱۳۹۷/۰۸/۱۸
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="status">وضعیت</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{ $bankbook->status == 'active' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ $bankbook->status == 'inactive' ? 'selected' : '' }}>غیر فعال</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="closed_date">تاریخ غیرفعالسازی</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('closed_date')) is-invalid @endif" id="closed_date" name="closed_date" value="{{ \Morilog\Jalali\CalendarUtils::convertNumbers(old('closed_date', $bankbook->closed_date)) }}" pattern="(?:13|14)[0-9]{2}/(?:(?:0[1-9]|1[0-2])/(?:0[1-9]|1[0-9]|2[0-9]||3[0])|(?:(0[1-6])-31))">
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
        <div class="row my-3">
            <div class="col-10">
                @include('owner/layouts/error')
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
