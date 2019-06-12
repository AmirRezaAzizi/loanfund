@extends('owner/master')

@section('page-title')
    <h1 class="h2">دفاتر {{ $title }}</h1>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th colspan="4" style="border: 0"></th>
                <th colspan="2" class="text-center">مانده</th>
                <th colspan="2" style="border: 0"></th>
            </tr>
            <tr>
                <th>ردیف</th>
                <th>شماره دفتر</th>
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
                    <td class="text-left">{{ $bankbook->full_code }}</td>
                    <td>@if($bankbook->title){{ $bankbook->title }} @else {{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }} @endif</td>
                    <td class="text-left">{{ number_format($bankbook->monthly) }}</td>
                    <td class="text-left">{{ number_format($bankbook->first_balance) }}</td>
                    <td class="text-left">-</td>
                    <td class="text-left">-</td>
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
