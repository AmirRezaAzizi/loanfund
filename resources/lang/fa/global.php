<?php
/**
 * Created by PhpStorm.
 * User: amirreza
 * Date: 6/14/19
 * Time: 4:02 PM
 */

return [
    'global' => [
        'createdDate' => 'تاریخ ثبت',
        'createDate' => 'تاریخ ثبت',
        'updateDate' => 'تاریخ آخرین ویرایش',
        'row' => 'ردیف',
        'action' => 'عملیات',
        'currencyName' => 'تومان',
        'withdraw' => 'برداشت',
        'deposit' => 'واریز',
        'edit' => 'ویرایش',
        'show' => 'مشاهده',
        'submit' => 'ثبت',
        'description' => 'توضیحات',
        'isConfirmedMessage' => 'این سند تایید نهایی شده است و قابل ویرایش نمی باشد.',
        'confirmed' => 'نهایی شده',
        'successConfirmAll' => 'همه اسناد واریزی و برداشتی با موفقیت تایید نهایی شدند و دیگر قابل ویرایش نمی باشند.',
        '' => '',
        '' => '',
        '' => '',
        '' => '',
    ],

    'customer' => [
        'id' => 'شماره عضویت',
        'status' => 'وضعیت',
        'customerFullName' => 'عضو اصلی',
        'mobile' => 'تلفن همراه',
        'fname' => 'نام',
        'lname' => 'نام خانوادگی',
        '' => '',
    ],

    'bankbook' => [
        'full_code' => 'شماره دفتر',
        'status' => 'وضعیت',
        'title' => 'نام دفتر',
        'nowBalance' => 'موجودی',
        'monthly' => 'پس انداز ماهیانه',
        '' => '',
        '' => '',
        '' => '',
    ],

    'loan' => [
        'id' => 'شماره وام',
        'status' => 'وضعیت',
        'sponsor' => 'ضامن',
        'total' => 'مبلغ وام',
        'monthly' => 'مبلغ قسط',
        'nowBalance' => 'مانده بدهی',
        'total_not_paid' => 'اقساط باقی مانده',
        'created_date' => 'تاریخ اعطای وام',
        'total_number' => 'تعداد کل اقساط',
        '' => '',
        '' => '',
    ],

    'receipt' => [
        'id' => 'شماره قبض',
        'date' => 'تاریخ',
        'amount' => 'مبلغ',
        '' => '',
    ],

    'errors' => [
        'ErrorFired' => 'خطایی رخ داده است و عملیات ناموفق بود.',
        'customerIsInactive' => 'این عضو غیر فعال می باشد.',
        'bankbookIsInactive' => 'این دفتر غیر فعال می باشد.',
        'hasActiveLoan' => 'این دفتر دارای وام فعال می باشد.',
    ],

    'journal' => [
        'BankbookDeposit' => 'واریز به دفتر',
        'BankbookWithdraw' => 'برداشت از دفتر',
        'wrongType' => 'نوع اشتباه ثبت شده',
        'loanMonthlyPayed' => 'واریز قسط وام',
        'giveLoan' => 'پرداخت وام به دفتر',
    ]
];