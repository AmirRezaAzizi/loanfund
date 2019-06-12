@extends('owner/master')

@section('page-title')
    <h1 class="h2">ویرایش وام شماره {{ $loan->id }}</h1>
@endsection

@section('content')
    <div class="row my-3">
        <div class="col-10">
            @include('owner/layouts/error')
        </div>
    </div>
    <form method="POST" action="/loans/{{ $loan->id }}" class="needs-validation" novalidate>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">عضو اصلی</label>
                <input type="text" class="form-control" id="fname" value="{{ $loan->bankbook->customer->fname }} {{ $loan->bankbook->customer->lname }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">شماره عضویت</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($loan->bankbook->customer->id) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="title">عنوان دفترچه</label>
                <input type="text" class="form-control" id="title" value="{{ $loan->bankbook->title }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">شماره دفتر</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($loan->bankbook->full_code) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="total">مبلغ وام</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('total')) is-invalid @endif" id="total" name="total" required value="{{ convertNumbers(old('total', $loan->total)) }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="total_number">تعداد کل اقساط</label>
                <div class="input-group mb-2">
                    ‍‍<input type="text" class="form-control text-left @if ($errors->has('total_number')) is-invalid @endif" id="total_number" name="total_number" required value="{{ convertNumbers(old('total_number', $loan->total_number)) }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">قسط</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="monthly">مبلغ ماهیانه</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('monthly')) is-invalid @endif" id="monthly" name="monthly" required value="{{ convertNumbers(old('monthly', $loan->monthly)) }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    مبلغ باید فقط شامل اعداد انگلیسی باشد.
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="created_date">تاریخ ثبت</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('created_date')) is-invalid @endif" id="created_date" name="created_date" required value="{{ old('created_date', $loan->created_date) }}" pattern="{4}/{2}/{2}">
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
                <label for="status">وضعیت</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{ old('status', $loan->status) == 'active' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ old('status', $loan->status) == 'inactive' ? 'selected' : '' }}>غیر فعال (تسویه شده)</option>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label for="closed_date">تاریخ غیرفعالسازی</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('closed_date')) is-invalid @endif" id="closed_date" name="closed_date" value="{{ old('closed_date', $loan->closed_date) }}" pattern="{4}/{2}/{2}">
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
                <label for="sponsor">ضامن</label>
                <input type="text" class="form-control" id="sponsor" name="sponsor" value="{{ old('sponsor', $loan->sponsor) }}">
            </div>
            <div class="col-md-5 text-left">
                <button type="submit" class="btn btn-primary btn-lg" style="margin-top: 24px">ثبت</button>
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
