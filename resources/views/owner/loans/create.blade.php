@extends('owner/master')

@section('page-title')
    <h1 class="h2">اطلاعات وام</h1>
@endsection

@section('content')
    <form method="POST" action="/bankbooks/{{ $bankbook->id }}/loans" class="needs-validation" novalidate>
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">عضو اصلی</label>
                <input type="text" class="form-control" id="fname" value="{{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">شماره عضویت</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($bankbook->customer->id) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="title">عنوان دفترچه</label>
                <input type="text" class="form-control" id="title" value="{{ $bankbook->title }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">شماره دفتر</label>
                <input type="text" class="form-control" id="code" value="{{ convertNumbers($bankbook->full_code) }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="total">مبلغ وام</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('total')) is-invalid @endif" id="total" name="total" required value="{{ old('total') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="total_number">تعداد کل اقساط</label>
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
                <label for="monthly">مبلغ ماهیانه</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('monthly')) is-invalid @endif" id="monthly" name="monthly" required value="{{ old('monthly') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="created_date">تاریخ ثبت</label>
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
                <label for="sponsor">ضامن</label>
                <input type="text" class="form-control" id="sponsor" name="sponsor" value="{{ old('sponsor') }}">
            </div>
            <div class="col-md-5 text-left">
                <button type="submit" class="btn btn-primary btn-lg" style="margin-top: 24px">ثبت</button>
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
