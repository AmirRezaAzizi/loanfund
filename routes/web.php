<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('owner/main');
});

// Customers
Route::prefix('customers')->group(/**
 *
 */
    function () {
    Route::get('/', 'CustomerController@index');
    Route::post('/', 'CustomerController@store');
    Route::get('/create', 'CustomerController@create');
    Route::get('/{customer}', 'CustomerController@show');
    Route::put('/{customer}', 'CustomerController@update');
    Route::get('/{customer}/edit', 'CustomerController@edit');
    Route::post('/{customer}/bankbooks', 'BankbookController@store');
    Route::get('/{customer}/bankbooks/create', 'BankbookController@create');

});

// Bankbooks
Route::prefix('bankbooks')->group(function () {
    Route::get('/', 'BankbookController@index');
    Route::get('/inactive', 'BankbookController@ia_index');
    Route::get('/{bankbook}', 'BankbookController@show');
    Route::put('/{bankbook}', 'BankbookController@update');
    Route::get('/{bankbook}/edit', 'BankbookController@edit');

    //loan
    Route::get('/{bankbook}/loans/create', 'LoanController@create');
    Route::post('/{bankbook}/loans', 'LoanController@store');

    //receipt
    Route::get('/{bankbook}/receipts/create', 'BankbookReceiptController@create');
    Route::post('/{bankbook}/receipts', 'BankbookReceiptController@store');

});

// Loans
Route::prefix('loans')->group(function () {
    Route::get('/', 'LoanController@index');
    Route::get('/inactive', 'LoanController@ia_index');
    Route::get('/{loan}', 'LoanController@show');
    Route::put('/{loan}', 'LoanController@update');
    Route::get('/{loan}/edit', 'LoanController@edit');

    //receipt
    Route::get('/{loan}/receipts/create', 'LoanReceiptController@create');
    Route::post('/{loan}/receipts', 'LoanReceiptController@store');

});

// Bankbook Receipts
Route::prefix('bankbookReceipts')->group(function () {
    Route::get('/{bankbookReceipt}/edit', 'BankbookReceiptController@edit');
    Route::put('/{bankbookReceipt}', 'BankbookReceiptController@update');
//    Route::delete('/{bankbookReceipt}', 'BankbookReceiptController@destroy');

});

// Bankbook Receipts
Route::prefix('loanReceipts')->group(function () {
    Route::get('/{loanReceipt}/edit', 'LoanReceiptController@edit');
    Route::put('/{loanReceipt}', 'LoanReceiptController@update');

});

Route::get('/ledger', function () {
    return view('owner/ledger');
});

Route::get('/days', function () {
    return view('owner/days');
});
