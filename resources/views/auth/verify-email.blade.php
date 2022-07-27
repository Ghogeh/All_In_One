@extends('layout.app')
@section('title') Verify your email @endsection
@section('contents')
@if(session()->has('msg'))
    <div class="alert alert-danger text-dark text-center m-3 p-3">{{ session('msg') }}</div>
@endif

<div class="container">
    <div class="border text-center h2 text-dark bg-info p-5 m-5">
        We have sent the verification link to your Email:  {{ Auth::user()->email }}

    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <input type="submit" value="Resend the link" class="m-2 p-2">
    </form>
    </div>
</div>

@endsection
