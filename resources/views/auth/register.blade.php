@extends('layouts.app')

@section('content')

    <div class="col-sm-3 col-lg-4"></div>
    <div class="col-sm-6 col-lg-4 payment-plans-header get-started-header">
        <h1>Get Started<span></span></h1>
        <p>Custom design. Amazing features.</p>

        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <input id="role" type="hidden" name="role" value="admin">
            <input id="app_id" type="hidden" name="app_id" value="0">

            <div class="form-row {{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="form-group">
                    <input placeholder="Full Name" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-row {{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="form-group">
                    <input placeholder="Email Address" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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

            <div class="form-group">
                <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group register-button">
                <button type="submit" class="btn btn-primary">
                    <span class="not-on-mobile">Create my UppFeed account now!</span>
                    <span class="mobile-only">Create My Account</span>
                </button>
            </div>
        </form>
    </div>
    <div class="col-sm-3 col-lg-4"></div>

@endsection
