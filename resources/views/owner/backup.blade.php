@extends('owner/master')

@section('page-title')
    <h1 class="h2">پشتیبان گیری</h1>
@endsection

@section('content')
    <form class="form-inline" action="{{ route('backup.store')}}" method="post">
        @csrf
        <button type="submit" class="btn btn-warning btn-lg">انجام عملیات پشتیبان گیری</button>
    </form>
@endsection
