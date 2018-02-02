@extends('layouts.dashboard')

@section('content')

    <div class="dashboard-header">
        <h1>
            Meet {{ $profile->user->name }}
            <span class="pull-right">

            </span>
        </h1>
    </div>

    <div class="row menus-row profile">

        {{-- <div class="col-md-12"> --}}
            <div class="row message-row">
                <div class="col-xs-12 col-md-3 avatar">
                    <img src="/uploads/{{ $profile->profile_photo }}" alt=""><br>
                    @if(!Auth::guest())
                        @if($profile->user->id == auth()->user()->id)
                            <a href="{{ route('edit.profile', $profile->profile_slug) }}">Edit Profile</a>
                        @endif
                    @endif
                </div>
                <div class="col-xs-12 col-md-9 message-container-2">
                    {!! nl2br(e($profile->biography)) !!}
                    <div class="profile-links">
                        @if($profile->website)
                            <a target="_blank" href="{{ $profile->website }}">
                                <i class="fa fa-link" aria-hidden="true"></i>
                            </a>
                        @endif
                        @if($profile->facebook)
                            <a target="_blank" href="{{ $profile->facebook }}">
                                <i class="fa fa-facebook-official" aria-hidden="true"></i>
                            </a>
                        @endif
                        @if($profile->instagram)
                            <a target="_blank" href="{{ $profile->instagram }}">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        @endif
                        @if($profile->linkedin)
                            <a target="_blank" href="{{ $profile->linkedin }}">
                                <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                            </a>
                        @endif
                        @if($profile->youtube)
                            <a target="_blank" href="{{ $profile->youtube }}">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        {{-- </div> --}}

    </div>

@endsection
