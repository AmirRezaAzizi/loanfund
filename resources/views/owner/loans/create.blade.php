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
                <input type="number" class="form-control" id="code" value="{{ $bankbook->customer->id }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="title">عنوان دفترچه</label>
                <input type="text" class="form-control" id="title" value="{{ $bankbook->title }}" readonly>
            </div>
            <div class="form-group col-md-5">
                <label for="code">شماره دفتر</label>
                <input type="text" class="form-control" id="code" value="{{ $bankbook->customer->id }}/{{ $bankbook->code }}" readonly>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="total">مبلغ وام</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="number" class="form-control text-left @if ($errors->has('total')) is-invalid @endif" id="total" name="total" required value="{{ old('total') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">تومان</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    مبلغ باید فقط شامل اعداد انگلیسی باشد.
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="total_number">تعداد کل اقساط</label>
                <div class="input-group mb-2">
                    ‍‍<input type="number" class="form-control text-left @if ($errors->has('total_number')) is-invalid @endif" id="total_number" name="total_number" required value="{{ old('total_number') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">قسط</div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    مبلغ باید فقط شامل اعداد انگلیسی باشد.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="monthly">مبلغ ماهیانه</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="number" class="form-control text-left @if ($errors->has('monthly')) is-invalid @endif" id="monthly" name="monthly" required value="{{ old('monthly') }}">
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
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('created_date')) is-invalid @endif" id="created_date" name="created_date" required value="{{ old('created_date', $date) }}" pattern="(?:13|14)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9]||3[0])|(?:(0[1-6])-31))">
                    <div class="input-group-prepend">
                        <div class="input-group-text">xxxx-xx-xx</div>
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
