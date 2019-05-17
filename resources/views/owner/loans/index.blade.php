@extends('owner/master')

@section('page-title')
    <h1 class="h2">وام های {{ $title }}</h1>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
              <tr>
                  <th colspan="7" style="border: 0"></th>
                  <th colspan="4" class="text-center">اقساط</th>
                  <th colspan="1" style="border: 0"></th>
              </tr>
            <tr>
                <th>ردیف</th>
                <th>شماره وام</th>
                <th>شماره دفترچه</th>
                <th>نام خانوادگی</th>
                <th>نام</th>
                <th>مبلغ وام</th>
                <th>مانده بدهی</th>
                <th>مبلغ</th>
                <th>کل</th>
                <th>پرداختی</th>
                <th>مانده</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($loans as $index => $loan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $loan->id }}</td>
                    <td class="text-left">{{ sprintf('%04d', $loan->bankbook->customer->code) }}{{ sprintf('%03d', $loan->bankbook->code) }}</td>
                    <td>{{ $loan->bankbook->customer->lname }}</td>
                    <td>{{ $loan->bankbook->customer->fname }}</td>
                    <td class="text-left">{{ number_format($loan->total) }}</td>
                    <td class="text-left">{{ number_format($loan->debit) }}</td>
                    <td class="text-left">{{ number_format($loan->monthly) }}</td>
                    <td class="text-left">{{ $loan->total_number }}</td>
                    <td class="text-left">-</td>
                    <td class="text-left">-</td>
                    <td>
                        <a href="/loans/{{ $loan->id }}" class="btn btn-outline-primary btn-sm" role="button">مشاهده</a>
                        <a href="/loans/{{ $loan->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">ویرایش</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
