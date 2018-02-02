@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>
            <i class="fa fa-calendar" aria-hidden="true"></i> <a href="{{ route('index.events') }}">Upcoming Events</a> / {{ $event->event_title }}
        </h1>
    </div>

    <div class="row menus-row">
        <div class="col-xs-12 dashboard-form">
            <form class="" method="POST" action="{{ route('update.event', array($event->event_slug)) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="col-md-6 col-lg-4 menu-image">
                    <div class="form-group">
                        <label for="event_image" class="control-label">Event Image:</label>
                        <div class="">
                            <input type="file" class="form-control" id="event_image" name="event_image">
                        </div>
                        @if($event->event_image)
                            <img src="/uploads/{{ $event->event_image }}" alt="">
                        @endif
                    </div>
                </div>

                <div class="col-md-6 col-lg-8">
                    <div class="form-group">
                        <label for="event_title" class="control-label">Event Title:</label>
                        <div class="">
                            <input type="text" class="form-control" id="event_title" name="event_title"  value="{{ old('event_title', $event->event_title)}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="event_description" class="control-label">Event Description:</label>
                        <div class="">
                            <textarea name="event_description" rows="4" class="form-control" id="event_description">{{ old('event_description', $event->event_description)}}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="event_date" class="control-label">Event Date:</label>
                        <div class="">
                            <input type="text" class="form-control" id="event_date" name="event_date"  value="{{ old('event_date', $event->event_date)}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="start_time" class="control-label">Start Time:</label>
                        <div class="">
                            <input type="text" class="form-control" id="start_time" name="start_time"  value="{{ old('start_time', $event->start_time)}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="end_time" class="control-label">End Time:</label>
                        <div class="">
                            <input type="text" class="form-control" id="end_time" name="end_time"  value="{{ old('end_time', $event->end_time)}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="event_price" class="control-label">Price:</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="pound">£</span>
                            <input type="text" class="form-control" id="event_price" name="event_price"  value="{{ old('event_price', $event->event_price)}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="event_price_details" class="control-label">Price Details:</label>
                        <div class="">
                            <input type="text" class="form-control" id="event_price_details" name="event_price_details"  value="{{ old('event_price_details', $event->event_price_details)}}">
                        </div>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
