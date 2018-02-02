@extends('layouts.dashboard')

@section('content')

    <div class="dashboard-header">
        <h1>
            <i class="fa fa-id-card-o" aria-hidden="true"></i> Your Account
            <span class="pull-right">
                <!-- Trigger the modal with a button -->
                @if(Auth::user()->subscribed('monthly') && !Auth::user()->subscription('monthly')->onGracePeriod())
                    <button type="button" class="btn orange-button not-on-mobile" data-toggle="modal" data-target="#cancel">
                        Cancel Subscription
                    </button>
                @elseif(Auth::user()->subscription('monthly')->onGracePeriod())
                    <form class="delete-form" action="{{ route('resumeFromGrace.subscribe') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <button type="submit" class="btn orange-button not-on-mobile btn-fix">
                            Resume Subscription
                        </button>
                    </form>
                @else
                    <button type="button" class="btn orange-button not-on-mobile" data-toggle="modal" data-target="#resume">
                        Resume Subscription
                    </button>
                @endif
            </span>
        </h1>

        @if(Auth::user()->subscribed('monthly') && !Auth::user()->subscription('monthly')->onGracePeriod())
            <button type="button" class="btn orange-button mobile-only mobile-dashboard-button" data-toggle="modal" data-target="#cancel">
                Cancel Subscription
            </button>
        @elseif(Auth::user()->subscription('monthly')->onGracePeriod())
            <form class="delete-form" action="{{ route('resumeFromGrace.subscribe') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <button type="submit" class="btn orange-button mobile-only mobile-dashboard-button btn-fix">
                    Resume Subscription
                </button>
            </form>
        @else
            <button type="button" class="btn orange-button mobile-only mobile-dashboard-button" data-toggle="modal" data-target="#resume">
                Resume Subscription
            </button>
        @endif
    </div>

    <div class="row menus-row">
        @foreach ($invoices as $invoice)
            <div class="col-xs-12 dashboard-form customer">
                <div class="col-xs-6 customer-field">
                    {{ $invoice->total() }} paid on {{ $invoice->date()->toFormattedDateString() }}
                </div>
                <div class="col-xs-6 customer-field">
                    <a class="pull-right" href="/user/invoice/{{ $invoice->id }}">Download Invoice</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection

<!-- Cancel Modal -->
<div id="cancel" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure?</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel your subscription?<br>
                You will no longer be able to update your app or receive reservations and reviews once your current subscription ends.
            </div>
            <div class="modal-footer">
                <form class="delete-form" action="{{ route('cancel.subscribe') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Resume Modal -->
<div id="resume" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Welcome Back</h4>
            </div>
            <div class="modal-body">
              <form class="monthly-form" action="{{ route('monthly.subscribe') }}" method="POST" id="payment-form">
                  {{ csrf_field() }}

                  <h3 class="text-center">
                      <span class="payment-errors label label-danger"></span>
                  </h3>

                  <div class="row">
                      <div class='form-row'>
                          <div class='col-xs-12 form-group card required'>
                              <label class='control-label'>Card Number</label>
                              <input autocomplete='off' value="4242 4242 4242 4242" class='form-control card-number' data-stripe="number" size='20' type='text' required>
                          </div>
                      </div>
                      <div class='form-row'>
                          <div class='col-sm-4 form-group cvc required'>
                              <label class='control-label'>CVC</label>
                              <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' data-stripe="cvc" size='4' type='text' required>
                          </div>
                          <div class='col-sm-4 form-group expiration required'>
                              <label class='control-label'>Exp. Month</label>
                              <input class='form-control card-expiry-month' placeholder='MM' value="{{ date('m') }}" data-stripe="exp_month" size='2' type='text' required>
                          </div>
                          <div class='col-sm-4 form-group expiration required'>
                              <label class='control-label'>Exp. Year</label>
                              <input class='form-control card-expiry-year' placeholder='YY' data-stripe="exp_year" size='2'  value="{{ date( 'y', strtotime('+ 4 year')) }}" type='text' required>
                          </div>
                      </div>

                  </div>
                  <input type="hidden" name="plan" value="monthly">

            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Resume Subscription</button>
                </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </div>
</div>
