@extends('layouts.app')

@section('content')
<style>
    .card {
    margin: 100px 0;
}
    .sub-but{
        margin: 23px 0 0 0;
    padding: 20px 0;
    line-height: 0px;
    text-decoration: none;
    height: auto;
    font-size: 16px;
    width: 100%;
    }
    
</style>
<div class="container custom">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please click here to verify your email with a verification link.') }}
                    {{ __('You can receive the email by clicking here') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link sub-but">{{ __('Click here to request an email.') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

