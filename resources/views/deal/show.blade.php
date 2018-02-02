@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>
            <i class="fa fa-ticket" aria-hidden="true"></i> <a href="{{ route('index.deals') }}">Special Offers</a> / {{ $deal->deal_title }}
        </h1>
    </div>

    <div class="row menus-row">
        <div class="col-xs-12 dashboard-form">
            <form class="" method="POST" action="{{ route('update.deal', array($deal->id)) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="col-md-6 col-lg-4 menu-image">
                    <div class="form-group">
                        <label for="deal_image" class="control-label">Offer Image:</label>
                        <div class="">
                            <input type="file" class="form-control" id="deal_image" name="deal_image">
                        </div>
                        @if($deal->deal_image)
                            <img src="/uploads/{{ $deal->deal_image }}" alt="">
                        @endif
                    </div>
                </div>

                <div class="col-md-6 col-lg-8">
                    <div class="form-group">
                        <label for="deal_title" class="control-label">Offer Title:</label>
                        <div class="">
                            <input type="text" class="form-control" id="deal_title" name="deal_title"  value="{{ old('deal_title', $deal->deal_title)}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deal_description" class="control-label">Offer Description:</label>
                        <div class="">
                            <textarea name="deal_description" rows="4" class="form-control" id="deal_description">{{ old('deal_description', $deal->deal_description)}}</textarea>
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
