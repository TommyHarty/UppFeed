@extends('layouts.dashboard')

@section('content')
      <div class="dashboard-header">
          <h1>
              <i class="fa fa-info-circle" aria-hidden="true"></i> Business Information
          </h1>
      </div>

      <div class="row menus-row">
          <div class="col-xs-12 dashboard-form">
              <form class="" method="POST" action="{{ route('update.businessinfo', $businessinfo->id) }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                  <div class="col-md-6 col-lg-4 info-image">
                      {{-- <div class="form-group">
                          <label for="business_logo" class="control-label">Logo:</label>
                          <div class="">
                              <input type="file" class="form-control" id="business_logo" name="business_logo">
                          </div>
                          @if($businessinfo->business_logo)
                              <img src="/uploads/{{ $businessinfo->business_logo }}" alt="">
                          @endif
                      </div> --}}

                      <div class="form-group">
                          <label for="business_photo" class="control-label">Background Image:</label>
                          <div class="">
                              <input type="file" class="form-control" id="business_photo" name="business_photo">
                          </div>
                          @if($businessinfo->business_photo)
                              <img src="/uploads/{{ $businessinfo->business_photo }}" alt="">
                          @endif
                      </div>
                  </div>

                  <div class="col-md-6 col-lg-8">
                      <div class="form-group">
                          <label for="business_name" class="control-label">Business Name:</label>
                          <div class="">
                              <input type="text" class="form-control" id="business_name" name="business_name"  value="{{ old('business_name', $businessinfo->business_name) }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="business_tagline" class="control-label">Business Tagline:</label>
                          <div class="">
                              <input type="text" class="form-control" id="business_tagline" name="business_tagline"  value="{{ old('business_tagline', $businessinfo->business_tagline) }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="business_description" class="control-label">Business Description:</label>
                          <div class="">
                              <textarea name="business_description" rows="4" class="form-control" id="business_description">{{ old('business_description', $businessinfo->business_description) }}</textarea>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="business_email" class="control-label">Business Email:</label>
                          <div class="">
                              <input type="text" class="form-control" id="business_email" name="business_email"  value="{{ old('business_email', $businessinfo->business_email) }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="phone" class="control-label">Business Phone:</label>
                          <div class="">
                              <input type="text" class="form-control" id="phone" name="phone"  value="{{ old('phone', $businessinfo->phone) }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="street_1" class="control-label">Street 1:</label>
                          <div class="">
                              <input type="text" class="form-control" id="street_1" name="street_1"  value="{{ old('street_1', $businessinfo->street_1) }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="street_2" class="control-label">Street 2:</label>
                          <div class="">
                              <input type="text" class="form-control" id="street_2" name="street_2"  value="{{ old('street_2', $businessinfo->street_2) }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="city" class="control-label">City:</label>
                          <div class="">
                              <input type="text" class="form-control" id="city" name="city"  value="{{ old('city', $businessinfo->city) }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="county" class="control-label">County:</label>
                          <div class="">
                              <input type="text" class="form-control" id="county" name="county"  value="{{ old('county', $businessinfo->county) }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="country" class="control-label">Country:</label>
                          <div class="">
                              <input type="text" class="form-control" id="country" name="country"  value="{{ old('country', $businessinfo->country) }}">
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="postcode" class="control-label">Postcode:</label>
                          <div class="">
                              <input type="text" class="form-control" id="postcode" name="postcode"  value="{{ old('postcode', $businessinfo->postcode) }}">
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
