@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>
            <i class="fa fa-calendar" aria-hidden="true"></i> Upcoming Events
            <span class="pull-right">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn orange-button not-on-mobile" data-toggle="modal" data-target="#addEvent">
                    Add New Event
                </button>
            </span>
        </h1>

        <button type="button" class="btn orange-button mobile-dashboard-button mobile-only" data-toggle="modal" data-target="#addEvent">
            Add New Event
        </button>
    </div>

    <div class="row menus-row">
        @foreach($events as $event)
            <div class="row dashboard-entry">
                <div class="col-xs-12 col-sm-6 col-lg-8 day">
                    {{ $event->event_title }}
                    <span class="pull-right">
                        <small>{{ $event->event_date }}</small>
                    </span>
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <a href="{{ route('show.event', $event->event_slug) }}" class="btn orange-button">
                        Edit
                    </a>
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <!-- Trigger the modal with a button -->
                    <a class="btn orange-button" data-toggle="modal" data-target="#event-{{ $event->id }}">
                        Delete
                    </a>
                </div>
            </div>

            <!-- Modal -->
            <div id="event-{{ $event->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure?</h4>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the event '{{ $event->event_title }}'?
                        </div>
                        <div class="modal-footer">
                            <form class="delete-form" action="{{ route('delete.event', $event->event_slug) }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn orange-button">Delete</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection

<!-- Modal -->
<div id="addEvent" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Event</h4>
            </div>
            <div class="modal-body">
              <form class="" method="POST" action="{{ route('store.event') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="event_image" class="control-label">Event Image:</label>
                        <div class="">
                            <input type="file" class="form-control" id="event_image" name="event_image">
                        </div>
                    </div>

                  <div class="form-group">
                      <label for="event_title" class="control-label">Event Title:</label>
                      <div class="">
                          <input type="text" class="form-control" id="event_title" name="event_title"  value="{{ old('event_title')}}" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="event_description" class="control-label">Event Description:</label>
                      <div class="">
                          <textarea name="event_description" rows="4" class="form-control" id="event_description">{{ old('event_description')}}</textarea>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="event_date" class="control-label">Event Date:</label>
                      <div class="">
                          <input type="text" class="form-control" id="event_date" name="event_date"  value="{{ old('event_date')}}" required>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="start_time" class="control-label">Start Time:</label>
                      <div class="">
                          <input type="text" class="form-control" id="start_time" name="start_time"  value="{{ old('start_time')}}">
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="end_time" class="control-label">End Time:</label>
                      <div class="">
                          <input type="text" class="form-control" id="end_time" name="end_time"  value="{{ old('end_time')}}">
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="event_price" class="control-label">Price:</label>
                      <div class="input-group">
                          <span class="input-group-addon" id="pound">£</span>
                          <input type="text" class="form-control" id="event_price" name="event_price"  value="{{ old('event_price')}}">
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="event_price_details" class="control-label">Price Details:</label>
                      <div class="">
                          <input type="text" class="form-control" id="event_price_details" name="event_price_details"  value="{{ old('event_price_details')}}">
                      </div>
                  </div>

            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Event</button>
                </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
