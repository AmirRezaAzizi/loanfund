@extends('owner/master')

@section('page-title')
    <h1 class="h2">ویرایش اطلاعات مشتری</h1>
@endsection

@section('content')
    <form method="POST" action="/customers/{{ $customer->id }}" class="needs-validation" novalidate>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="code">شماره مشتری</label>
                <input type="number" class="form-control text-left @if ($errors->has('code')) is-invalid @endif" id="code" name="code" required value="{{ old('code', sprintf("%04d", $customer->code)) }}">
                <div class="invalid-feedback">
                    شماره مشتری الزامی و منحصر بفرد بوده و باید ۴ رقمی باشد.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">نام</label>
                <input type="text" class="form-control" id="fname" placeholder="نام" name="fname" value="{{ old('fname', $customer->fname) }}" required>
                <div class="invalid-feedback">
                    نام الزامی می باشد
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="lname">نام خانوادگی</label>
                <input type="text" class="form-control" id="lname" placeholder="نام خانوادگی" name="lname" value="{{ old('lname', $customer->lname) }}" required>
                <div class="invalid-feedback">
                    نام خانوادگی الزامی می باشد
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="national">شماره ملی</label>
                <input type="text" pattern="[0-9]{10}" class="form-control text-left @if ($errors->has('national')) is-invalid @endif" id="national" name="national" value="{{ old('national', $customer->national) }}">
                <div class="invalid-feedback">
                    شماره ملی الزامی بوده و باید ۱۰ رقم و به زبان انگلیسی باشد
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="father">نام پدر</label>
                <input type="text" class="form-control" id="father" placeholder="نام پدر" name="father" value="{{ old('father', $customer->father) }}">
            </div>
            <div class="form-group col-md-5">
                <label for="birth">تاریخ تولد</label>
                <input type="text" class="form-control text-left" id="birth" placeholder="1376/06/31" name="birth" value="{{ old('birth', $customer->birth) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="mobile">شماره موبایل</label>
                <input type="text" class="form-control text-left @if ($errors->has('mobile')) is-invalid @endif" id="mobile" placeholder="09121234567" name="mobile" pattern="[0-9]{11}" value="{{ old('mobile', $customer->mobile) }}" required>
                <div class="invalid-feedback">
                    شماره موبایل الزامی بوده و باید ۱۱ رقم و به زبان انگلیسی باشد
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="phone">تلفن ثابت</label>
                <input type="text" class="form-control text-left @if ($errors->has('phone')) is-invalid @endif" id="phone" placeholder="02112345678" name="phone" pattern="[0-9]{11}" value="{{ old('phone', $customer->phone) }}">
                <div class="invalid-feedback">
                    شماره ثابت الزامی بوده و باید ۱۱ رقم و به زبان انگلیسی باشد
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-10">
                <label for="address">نشانی</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $customer->address) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="post">کد پستی</label>
                <input type="text" class="form-control text-left @if ($errors->has('post')) is-invalid @endif" id="post" name="post" pattern="[0-9]{10}" value="{{ old('post', $customer->post) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="reference">معرف</label>
                <input type="text" class="form-control" id="reference" placeholder="معرف" name="reference" value="{{ old('reference', $customer->reference) }}">
            </div>
            <div class="form-group col-md-5">
                <label for="sponsor">ضامن</label>
                <input type="text" class="form-control" id="sponsor" placeholder="ضامن" name="sponsor" value="{{ old('sponsor', $customer->sponsor) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-10">
                <button type="submit" class="btn float-left btn-primary btn-lg">بروزرسانی و ثبت اطلاعات مشتری</button>
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
