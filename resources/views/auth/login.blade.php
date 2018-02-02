@extends('layouts.app')

@section('content')

    <div class="col-sm-3 col-lg-4"></div>
    <div class="col-sm-6 col-lg-4 payment-plans-header get-started-header">
        <h1>Log In<span></span></h1>
        <p></p>

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-row {{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="form-group">
                    <input placeholder="Email Address" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-row {{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="form-group">
                    <input placeholder="Password" id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>

            <div class="form-row register-button">
                <button type="submit" class="btn btn-primary">
                    Log In
                </button>
            </div>
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>

        </form>

    </div>
    <div class="col-sm-3 col-lg-4"></div>

@endsection
