@extends('owner/master')

@section('page-title')
    <h1 class="h2">اطلاعات {{ trans('global.customer.customerFullName') }}
        <a href="/customers/{{ $customer->id }}/edit">
            <button type="button" class="btn btn-outline-primary btn-sm">{{ trans('global.global.edit') }}</button>
        </a>
    </h1>
@endsection

@section('content')
    <div class="show-info text-center">
        <a class="btn btn-link btn-show" data-toggle="collapse" href="#collapseTable" role="button" aria-expanded="false" aria-controls="collapseTable">
نمایش کامل اطلاعات
        </a>
    </div>
    <table class="table table-striped" style="table-layout: fixed;">
        <tbody>
            <tr>
                <th>{{ trans('global.customer.id') }}</th>
                <td>{{ $customer->id }}</td>
            </tr>
            <tr>
                <th>{{ trans('global.customer.fname') }} و {{ trans('global.customer.lname') }}</th>
                <td>{{ $customer->fname }} {{ $customer->lname }}</td>
            </tr>
            @if($customer->description)
                <tr>
                    <th>{{ trans('global.global.description') }}</th>
                    <td>{{ $customer->description }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    <table class="table table-striped collapse" id="collapseTable" style="margin-top: -1rem; table-layout: fixed;">
        <tbody>
            <tr>
                <th>{{ trans('global.customer.status') }}</th>
                <td class="{{ $customer->status == 'inactive' ? 'inactive-bg' : '' }}">{{ $customer->status == 'active' ? 'فعال' : 'غیرفعال از ' . $customer->closed_date }}</td>
            </tr>
            <tr>
                <th>نام پدر</th>
                <td>{{ $customer->father }}</td>
            </tr>
            <tr>
                <th>شماره ملی</th>
                <td>{{ $customer->national }}</td>
            </tr>
            <tr>
                <th>رمز</th>
                <td>{{ $customer->password }}</td>
            </tr>
            <tr>
                <th>تلفن ثابت</th>
                <td>{{ $customer->phone }}</td>
            </tr>
            <tr>
                <th>{{ trans('global.customer.mobile') }}</th>
                <td>{{ $customer->mobile }}</td>
            </tr>
            <tr>
                <th>تاریخ تولد</th>
                <td>{{ $customer->birth }}</td>
            </tr>
            <tr>
                <th>نشانی</th>
                <td>{{ $customer->address }}</td>
            </tr>
            <tr>
                <th>کد پستی</th>
                <td>{{ $customer->post }}</td>
            </tr>
            <tr>
                <th>معرف</th>
                <td>{{ $customer->reference }}</td>
            </tr>
            <tr>
                <th>{{ trans('global.loan.sponsor') }}</th>
                <td>{{ $customer->sponsor }}</td>
            </tr>
            <tr>
                <th>{{ trans('global.global.createDate') }}</th>
                <td>{{ $customer->created_at }}</td>
            </tr>
            <tr>
                <th>{{ trans('global.global.updateDate') }}</th>
                <td>{{ $customer->updated_at }}</td>
            </tr>
        </tbody>
    </table>
    <h2>دفاتر
        <a href="/customers/{{ $customer->id }}/bankbooks/create">
            <button type="button" class="btn btn-outline-primary btn-sm">ایجاد دفتر جدید</button>
        </a>
    </h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th colspan="4" style="border: 0"></th>
                <th colspan="2" class="text-center">مانده</th>
                <th colspan="2" class="text-center">اقساط</th>
                <th colspan="1" style="border: 0"></th>
            </tr>
            <tr>
                <th>{{ trans('global.global.row') }}</th>
                <th>{{ trans('global.bankbook.full_code') }}</th>
                <th>{{ trans('global.customer.fname') }}</th>
                <th>{{ trans('global.bankbook.monthly') }}</th>
                <th>پس انداز</th>
                <th>وام</th>
                <th>{{ trans('global.loan.monthly') }}</th>
                <th>تعداد</th>
                <th>{{ trans('global.global.action') }}</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $bankbooks = $customer->bankbooks()->active();
                $totalBalance = 0;
                $totalLoanBalance = 0;
                $totalLoanMonthly = 0;
            ?>
            @foreach($bankbooks->get() as $index => $bankbook)
                <tr class="{{ $bankbook-> status == 'inactive' ? 'inactive-bg' : '' }}">
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $bankbook->full_code }}</td>
                    <td>@if($bankbook->title){{ $bankbook->title }} @else {{ $bankbook->customer->fname }} {{ $bankbook->customer->lname }} @endif</td>
                    <td class="text-left">{{ number_format($bankbook->monthly) }}</td>
                    <?php
                    $nowBalance = $bankbook->now_balance();
                    $totalBalance += $nowBalance;
                    ?>
                    <td class="text-left">{{ number_format($nowBalance) }}</td>
                    <td class="text-left">
                        <?php
                            $activeLoan = $bankbook->activeLoan();
                        ?>
                        @if($activeLoan)
                            <?php
                            $loanNowBalance = $activeLoan->now_balance();
                            $totalLoanBalance += $loanNowBalance;
                            ?>
                            {{ number_format($loanNowBalance)  }}
                        @endif
                    </td>
                    <td class="text-left">
                        @if($activeLoan)
                            {{ number_format($activeLoan->monthly)  }}
                            <?php
                            $totalLoanMonthly += $activeLoan->monthly;
                            ?>
                        @endif
                    </td>
                    <td class="text-left">
                        @if($activeLoan)
                            {{ $activeLoan->total_not_paid  }}
                        @endif
                    </td>
                    <td>
                        <a href="/bankbooks/{{ $bankbook->id }}" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.show') }}</a>
                        <a href="/bankbooks/{{ $bankbook->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.edit') }}</a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td>جمع کل</td>
                <td></td>
                <td></td>
                <td class="text-left">{{ number_format($bankbooks->sum('monthly')) }}</td>
                <td class="text-left">{{ number_format($totalBalance) }}</td>
                <td class="text-left">{{ number_format($totalLoanBalance) }}</td>
                <td class="text-left">{{ number_format($totalLoanMonthly) }}</td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

    <h2>وام ها</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th colspan="6" style="border: 0"></th>
                <th colspan="3" class="text-center">تعداد اقساط</th>
                <th colspan="1" style="border: 0"></th>
            </tr>
            <tr>
                <th>{{ trans('global.global.row') }}</th>
                <th>{{ trans('global.loan.id') }}</th>
                <th>{{ trans('global.bankbook.full_code') }}</th>
                <th>{{ trans('global.loan.total') }}</th>
                <th>{{ trans('global.loan.nowBalance') }}</th>
                <th>{{ trans('global.loan.monthly') }}</th>
                <th>کل</th>
                <th>پرداختی</th>
                <th>مانده</th>
                <th>{{ trans('global.global.action') }}</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $index = 1;
            ?>
            @foreach($customer->bankbooks as $bankbook)
                @foreach($bankbook->loans()->active()->get() as $loan)
                    <tr  class="{{ $loan-> status == 'inactive' ? 'inactive-bg' : '' }}">
                        <td>{{ $index++ }}</td>
                        <td class="text-left">{{ $loan->id }}</td>
                        <td class="text-left">{{ $loan->bankbook->full_code }}</td>
                        <td class="text-left">{{ number_format($loan->total) }}</td>
                        <td class="text-left">{{ number_format($loan->now_balance()) }}</td>
                        <td class="text-left">{{ number_format($loan->monthly) }}</td>
                        <td class="text-left">{{ number_format($loan->total_number) }}</td>
                        <td class="text-left">{{ count($loan->loanReceipts) }}</td>
                        <td class="text-left">{{ $loan->total_number - count($loan->loanReceipts)}}</td>
                        <td>
                            <a href="/loans/{{ $loan->id }}" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.show') }}</a>
                            <a href="/loans/{{ $loan->id }}/edit" class="btn btn-outline-primary btn-sm" role="button">{{ trans('global.global.edit') }}</a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    @include('owner/layouts/footer')
@endsection
