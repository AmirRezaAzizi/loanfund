@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفاتر {{ $title }}</h1>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th colspan="5" style="border: 0"></th>
                <th colspan="2" class="text-center">مانده</th>
                <th colspan="2" style="border: 0"></th>
            </tr>
            <tr>
                <th>ردیف</th>
                <th>کد دفتر</th>
                <th>نام خانوادگی</th>
                <th>نام</th>
                <th>مبلغ پس انداز ماهیانه</th>
                <th>پس انداز</th>
                <th>وام</th>
                <th>مبلغ قسط</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bankbooks as $index => $bankbook)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ sprintf("%04d", $bankbook->customer->code) }}{{ sprintf("%03d", $bankbook->code) }}</td>
                    <td>{{ $bankbook->customer->lname }}</td>
                    <td>{{ $bankbook->customer->fname }}</td>
                    <td>{{ $bankbook->monthly }}</td>
                    <td>{{ $bankbook->first_balance }}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>
                        <a href="/bankbooks/{{ $bankbook->id }}" class="btn btn-outline-primary btn-sm" role="button">مشاهده</a>
                        <a href="/bankbooks/{{ $bankbook->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
