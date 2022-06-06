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
                        <p class="login-card-description">Reset Password</p>
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="error-message mt-2 mb-2 " >
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <span >{{ $error }}</span>
                                @endforeach
                            @endif
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>

                        <form method="POST" action="{{ route('password.request') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email address">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Reset">
                        </form>
                        <p class="login-card-footer-text">Don't have an account? <a href="{{ route('register') }}" class="text-reset">Register here</a></p>
                        <nav class="login-card-footer-nav">
                            <a href="#!">Terms of use.</a>
                            <a href="#!">Privacy policy</a>
                        </nav>
                    </div>
                </div>
                <div class="col-md-5">
                    <img src="/img/login2.jpg" alt="login" class="login-card-img">
                </div>
            </div>
        </div>
@endsection
