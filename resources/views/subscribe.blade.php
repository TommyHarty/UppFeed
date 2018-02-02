@extends('layouts.subscribe')

@section('content')

    <div class="col-sm-3 col-md-4"></div>
    <div class="col-sm-6 col-md-4 payment-plans-header" id="subscription-form">
        <h1>£149<span>/month</span></h1>
        <p>No contract. Cancel any time.</p>

        <div class="payment-plans">

            <form class="monthly-form" action="{{ route('monthly.subscribe') }}" method="POST" id="payment-form">
                {{ csrf_field() }}

                <h3 class="text-center" style="margin-bottom:15px;font-size:18px;">
                    <span class="payment-errors label label-danger"></span>
                </h3>

                <div class="row">
                    <div class='form-row'>
                        <div class='col-xs-12 form-group card required'>
                            <label class='control-label'>Card Number</label>
                            <input autocomplete='off' class='form-control card-number' data-stripe="number" size='20' type='text' required>
                        </div>
                    </div>
                    <div class='form-row'>
                        <div class='col-sm-4 form-group cvc required'>
                            <label class='control-label'>CVC</label>
                            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' data-stripe="cvc" size='4' type='text' required>
                        </div>
                        <div class='col-sm-4 form-group expiration required'>
                            <label class='control-label'>Exp. Month</label>
                            <input class='form-control card-expiry-month' placeholder='MM' data-stripe="exp_month" size='2' type='text' required>
                        </div>
                        <div class='col-sm-4 form-group expiration required'>
                            <label class='control-label'>Exp. Year</label>
                            <input class='form-control card-expiry-year' placeholder='YY' data-stripe="exp_year" size='2' type='text' required>
                        </div>
                    </div>

                </div>
                <input type="hidden" name="plan" value="monthly">
                <span class="not-on-mobile">
                    <input type="submit" class="btn btn-primary" id="subscription-clicked" value="Let's get this app cooking!">
                </span>
                <span class="mobile-only">
                    <input type="submit" class="btn btn-primary" id="subscription-clicked" value="Get Started">
                </span>
            </form>

        </div>
        <div class="text-center">
            <img class="stripe-image" src="/images/powered-by-stripe.png" alt="">
        </div>
    </div>
    <div class="col-sm-6 col-md-4" id="subscription-loading">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
        <p>Checking your payment details<br>
            <small>Do not refresh your page</small>
        </p>
    </div>
    <div class="col-sm-3 col-md-4"></div>

@endsection
