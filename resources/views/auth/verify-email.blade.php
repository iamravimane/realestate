@extends('template')

@section('content')
    <div class="container">
        <div class="card login-card">
            <div class="row no-gutters">

                <div class="col-md-7">


                    <div class="card-body">
                        <div class="brand-wrapper">
                            <img src="/img/logo.svg" alt="logo" class="logo">
                        </div>
                        <p class="login-card-description">we must verify email address, Please check your email for verification link </p>

                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Resend Email">
                        </form>

                    </div>
                </div>
                <div class="col-md-5">
                    <img src="/img/login2.jpg" alt="login" class="login-card-img">
                </div>
            </div>
        </div>
@endsection
