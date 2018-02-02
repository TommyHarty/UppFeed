@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Subscribers
            <span class="pull-right">

            </span>
        </h1>
    </div>

    <div class="row menus-row">
        @foreach ($customers as $customer)
            <div class="col-xs-12 dashboard-form customer">
                <div class="col-xs-6 customer-field">
                    {{ $customer->customer_name }}
                </div>
                <div class="col-xs-6 customer-field">
                    {{ $customer->customer_email }}
                </div>
            </div>
        @endforeach
    </div>
@endsection
