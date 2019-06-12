@extends('owner/master')

@section('page-title')
    <h1 class="h2">ویرایش اطلاعات عضو</h1>
@endsection

@section('content')
    <div class="row my-3">
        <div class="col-10">
            @include('owner/layouts/error')
        </div>
    </div>
    <form method="POST" action="/customers/{{ $customer->id }}" class="needs-validation" novalidate>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="code">شماره عضویت</label>
                <input type="text" class="form-control text-left" id="code" readonly value="{{ convertNumbers($customer->id) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="fname">نام</label>
                <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname', $customer->fname) }}" required>
                <div class="invalid-feedback">
                    نام الزامی می باشد
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="lname">نام خانوادگی</label>
                <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname', $customer->lname) }}" required>
                <div class="invalid-feedback">
                    نام خانوادگی الزامی می باشد
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="national">شماره ملی</label>
                <input type="text" pattern="{10}" class="form-control text-left @if ($errors->has('national')) is-invalid @endif" id="national" name="national" value="{{ old('national', $customer->national) }}">
                <div class="invalid-feedback">
                    شماره ملی الزامی بوده و باید ۱۰ رقم و به زبان فارسی باشد
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="father">نام پدر</label>
                <input type="text" class="form-control" id="father" name="father" value="{{ old('father', $customer->father) }}">
            </div>
            <div class="form-group col-md-5">
                <label for="birth">تاریخ تولد</label>
                <input type="text" class="form-control text-left" id="birth" placeholder="xxxx/xx/xx" name="birth" value="{{ old('birth', $customer->birth) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="mobile">شماره موبایل</label>
                <input type="text" class="form-control text-left @if ($errors->has('mobile')) is-invalid @endif" id="mobile" placeholder="۰۹xxxxxxxxx" name="mobile" pattern="{11}" value="{{ old('mobile', $customer->mobile) }}" required>
                <div class="invalid-feedback">
                    شماره موبایل الزامی بوده و باید ۱۱ رقم و به زبان فارسی باشد
                </div>
            </div>
            <div class="form-group col-md-5">
                <label for="phone">تلفن ثابت</label>
                <input type="text" class="form-control text-left @if ($errors->has('phone')) is-invalid @endif" id="phone" placeholder="۰۲۱xxxxxxxx" name="phone" pattern="{11}" value="{{ old('phone', $customer->phone) }}">
                <div class="invalid-feedback">
                    شماره ثابت الزامی بوده و باید ۱۱ رقم و به زبان فارسی باشد
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
                <input type="text" class="form-control text-left @if ($errors->has('post')) is-invalid @endif" id="post" name="post" pattern="{10}" value="{{ old('post', $customer->post) }}">
            </div>
            <div class="form-group col-md-5">
                <label for="status">وضعیت</label>
                <select name="status" id="status" class="form-control">
                    <option value="active"
                            {{ (old("status") == 'active' ? "selected":"") }}
                            {{ $customer->status == 'active' ? 'selected' : '' }}
                    >فعال
                    </option>

                    <option value="inactive"
                            {{ (old("status") == 'inactive' ? "selected":"") }}
                            {{ $customer->status == 'inactive' ? 'selected' : '' }}
                    >غیر فعال
                    </option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="closed_date">تاریخ غیرفعالسازی</label>
                <div class="input-group mb-2">
                    ‍‍  <input type="text" class="form-control text-left @if ($errors->has('closed_date')) is-invalid @endif" id="closed_date" name="closed_date" value="{{ old('closed_date', $customer->closed_date) }}" pattern="{4}/{2}/{2}">
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
            <div class="form-group col-md-5">
                <label for="reference">معرف</label>
                <input type="text" class="form-control" id="reference" name="reference" value="{{ old('reference', $customer->reference) }}">
            </div>
            <div class="form-group col-md-5">
                <label for="sponsor">ضامن</label>
                <input type="text" class="form-control" id="sponsor" name="sponsor" value="{{ old('sponsor', $customer->sponsor) }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="description">توضیحات</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $customer->description) }}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-10">
                <button type="submit" class="btn float-left btn-primary btn-lg">ثبت</button>
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
