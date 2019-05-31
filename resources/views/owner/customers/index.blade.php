@extends('owner/master')

@section('page-title')
    <h1 class="h2">لیست اعضا اصلی {{ $title }}
        <a href="customers/create">
            <button type="button" class="btn btn-outline-primary btn-sm">ایجاد عضو جدید</button>
        </a>
    </h1>
@endsection

@section('content')
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ردیف</th>
                <th>شماره عضویت</th>
                <th>نام خانوادگی</th>
                <th>نام</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
        @foreach($customers as $index => $customer)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->lname }}</td>
                <td>{{ $customer->fname }}</td>
                <td>
                    <a href="/customers/{{ $customer->id }}" class="btn btn-outline-primary btn-sm" role="button">مشاهده</a>
                    <a href="/customers/{{ $customer->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
@endsection
