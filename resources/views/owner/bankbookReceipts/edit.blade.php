@extends('owner/master')

@section('page-title')
    <h1 class="h2">ویرایش قبض دفترچه پس انداز</h1>
@endsection

@section('content')
    <form method="POST" action="/bankbookReceipts/{{ $bankbookReceipt->id }}" class="needs-validation" novalidate>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">نام و نام خانوادگی</label>
                <input type="text" class="form-control" id="fname" value="{{ $bankbookReceipt->bankbook->customer->fname }} {{ $bankbookReceipt->bankbook->customer->lname }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">شماره عضویت</label>
                <input type="number" class="form-control" id="code" value="{{ $bankbookReceipt->bankbook->customer->id }}" readonly>
            </div>

        </div>
        <div class="form-row">

            <div class="form-group col-md-5">
                <label for="title">عنوان دفترچه</label>
                <input type="text" class="form-control" id="title" value="@if($bankbookReceipt->bankbook->title){{ $bankbookReceipt->bankbook->title }} @else {{ $bankbookReceipt->bankbook->customer->fname }} {{ $bankbookReceipt->bankbook->customer->lname }} @endif" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">شماره دفترچه</label>
                <input type="text" class="form-control" id="code" value="{{ $bankbookReceipt->bankbook->full_code }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5" style="margin-top: 12px;">
                <label>موجودی</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="number" class="form-control text-left" value="{{ $balance }}" readonly>
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-5">
                <div class="radio-inline" style="padding: .375rem 1.40rem;">
                    <label for="deposit">
                        <input type="radio" id="deposit" name="type" value="deposit" checked> واریز
                    </label>
                    <label for="withdraw">
                        <input type="radio" id="withdraw" name="type" value="withdraw"> برداشت
                    </label>
                </div>
                <div class="input-group mb-2">
                    ‍‍  <input type="number" class="form-control text-left @if ($errors->has('amount')) is-invalid @endif" id="amount" name="amount" required value="{{ old('amount', $bankbookReceipt->amount) }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
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
            <div class="col-md-5">
                <label> </label>
                <div class="input-group">
                    <button type="submit" class="btn float-left btn-primary btn-lg">ثبت</button>
                </div>
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
