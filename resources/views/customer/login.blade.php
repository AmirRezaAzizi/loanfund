@extends('customer.customer-master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 pt-5">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>* اعداد به انگلیسی وارد شوند.</p>
                        <p>* در صورتی که 3 بار رمز اشتباه وارد شود به مدت 1 دقیقه مسدود می شوید.</p>
                        <form accept-charset="UTF-8" role="form" action="{{ url('/c/show') }}" method="post">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="شماره موبایل" name="mobile" type="text" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="رمز عبور" name="password" type="text" required>
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="نمایش اطلاعات">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
