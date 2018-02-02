@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>
            <i class="fa fa-users" aria-hidden="true"></i> Reservation Enquiries
            <span class="pull-right">
                <!-- Trigger the modal with a button -->
                <a href="{{ route('archived.reservations') }}" class="btn orange-button btn-archived not-on-mobile">
                    View Archived
                </a>
            </span>
        </h1>

        <a href="{{ route('archived.reservations') }}" class="btn orange-button btn-archived mobile-dashboard-button mobile-only">
            View Archived
        </a>
    </div>

    @foreach($reservations as $reservation)
        <div class="row menus-row reviews-row">
            <div class="row dashboard-entry review">
                <div class="col-xs-12 col-sm-6 col-lg-8">
                    <span style="">
                        {{ $reservation->name }}
                        would like to reserve a table
                        @if($reservation->people)
                            for {{ $reservation->people }}
                        @endif
                        @if($reservation->date)
                            on {{ $reservation->date }}
                        @endif
                        @if($reservation->time)
                            at {{ $reservation->time }}
                        @endif
                    </span>
                    <br>
                    @if($reservation->phone)
                        <div class="mobile-only left-separator"></div>
                        <i class="fa fa-phone" aria-hidden="true"></i> <span style="margin-right:10px;">{{ $reservation->phone }}</span>
                    @endif
                    @if($reservation->email)
                        <div class="mobile-only left-separator"></div>
                        <i class="fa fa-envelope" aria-hidden="true"></i> {{ $reservation->email }}
                    @endif
                    @if($reservation->details)
                        <div class="left-separator"></div>
                        {{ $reservation->details }}
                    @endif
                </div>

                <hr class="tablet-hr">

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <form class="" method="POST" action="{{ route('archive.reservation', $reservation->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <button type="submit" class="btn orange-button approve">Archive</button>
                    </form>
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <!-- Trigger the modal with a button -->
                    <a class="btn orange-button" data-toggle="modal" data-target="#reservation-{{ $reservation->id }}">
                        Delete
                    </a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="reservation-{{ $reservation->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Are you sure?</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this reservation enquiry?
                    </div>
                    <div class="modal-footer">
                        <form class="delete-form" action="{{ route('delete.reservation', $reservation->id) }}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn orange-button">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endforeach

@endsection
