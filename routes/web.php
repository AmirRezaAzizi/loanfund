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
    Route::get('/{bankbook}/loans/create', 'LoanController@create');
    Route::post('/{bankbook}/loans', 'LoanController@store');

});

// Bankbooks
Route::prefix('loans')->group(function () {
    Route::get('/', 'LoanController@index');
    Route::get('/inactive', 'LoanController@ia_index');
    Route::get('/{loan}', 'LoanController@show');
    Route::put('/{loan}', 'LoanController@update');
    Route::get('/{loan}/edit', 'LoanController@edit');

});

Route::get('/ledger', function () {
    return view('owner/ledger');
});

Route::get('/days', function () {
    return view('owner/days');
});
