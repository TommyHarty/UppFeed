@extends('layouts.dashboard')

@section('content')

    <div class="col-md-12">
        <div class="row menus-row">
            <div class="col-xs-12 dashboard-form">
                <form class="" method="POST" action="{{ route('update.profile', $profile->profile_slug) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="col-md-6 col-lg-4 info-image">
                        <div class="form-group">
                            <label for="profile_photo" class="control-label">Profile Photo:</label>
                            <div class="">
                                <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                            </div>
                            @if($profile->profile_photo)
                                <img src="/uploads/{{ $profile->profile_photo }}" alt="">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-8">
                        <div class="form-group">
                            <label for="biography" class="control-label">Biography:</label>
                            <div class="">
                                <textarea name="biography" rows="8" class="form-control" id="biography">{{ old('biography', $profile->biography) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="website" class="control-label">Website:</label>
                            <div class="">
                                <input type="text" class="form-control" id="website" name="website"  value="{{ old('website', $profile->website) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="facebook" class="control-label">Facebook:</label>
                            <div class="">
                                <input type="text" class="form-control" id="facebook" name="facebook"  value="{{ old('facebook', $profile->facebook) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="instagram" class="control-label">Instagram:</label>
                            <div class="">
                                <input type="text" class="form-control" id="instagram" name="instagram"  value="{{ old('instagram', $profile->instagram) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="linkedin" class="control-label">LinkedIn:</label>
                            <div class="">
                                <input type="text" class="form-control" id="linkedin" name="linkedin"  value="{{ old('linkedin', $profile->linkedin) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="twitter" class="control-label">Twitter:</label>
                            <div class="">
                                <input type="text" class="form-control" id="twitter" name="twitter"  value="{{ old('twitter', $profile->twitter) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="youtube" class="control-label">YouTube:</label>
                            <div class="">
                                <input type="text" class="form-control" id="youtube" name="youtube"  value="{{ old('youtube', $profile->youtube) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
