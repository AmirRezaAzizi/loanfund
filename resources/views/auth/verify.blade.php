@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white">
                <div class="card-header text-right">تایید ایمیل</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            لینک تایید به ایمیل شما ارسال شد.
                        </div>
                    @endif

                    لطفا صندوق ایمیل خود را بررسی فرمایید.
                    اگر شما ایمیلی دریافت نکرده اید, <a href="{{ route('verification.resend') }}">اینجا کلیک کنید تا ایمیل دیگری برای شما ارسال کنیم</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
