@extends('owner/master')

@section('page-title')
    <h1 class="h2">اطلاعات قسط دریافتی</h1>
@endsection

@section('content')
    <form method="POST" action="/loans/{{ $loan->id }}/receipts" class="needs-validation" novalidate>
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">عضو اصلی</label>
                <input type="text" class="form-control" id="fname" value="{{ $loan->bankbook->customer->fname }} {{ $loan->bankbook->customer->lname }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">شماره عضویت</label>
                <input type="number" class="form-control" id="code" value="{{ $loan->bankbook->customer->id }}" readonly>
            </div>
        </div>
        <div class="form-row">

            <div class="form-group col-md-5">
                <label for="title">عنوان دفترچه</label>
                <input type="text" class="form-control" id="title" value="{{ $loan->bankbook->title }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">شماره دفترچه</label>
                <input type="text" class="form-control" id="code" value="{{ $loan->bankbook->full_code }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>مانده فعلی</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left" value="{{ number_format($balance) }}" readonly>
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="amount">مبلغ قبض</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="number" class="form-control first_focus text-left @if ($errors->has('amount')) is-invalid @endif" id="amount" name="amount" required value="{{ old('amount') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="date">تاریخ ثبت</label>
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
            <div class="col-md-10">
                <button type="submit" class="btn float-left btn-primary btn-lg">ثبت</button>
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
