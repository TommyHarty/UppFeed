@extends('layouts.dashboard')

@section('content')

    <div class="dashboard-header">
        <h1>
            <i class="fa fa-cogs" aria-hidden="true"></i> Your App Design
            @if($project)
                <span class="pull-right">
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn orange-button not-on-mobile" data-toggle="modal" data-target="#myModal">
                        Add Message
                    </button>
                </span>
            @endif
        </h1>

        @if($project)
            <button type="button" class="btn orange-button mobile-dashboard-button mobile-only" data-toggle="modal" data-target="#myModal">
                Add Message
            </button>
        @endif
    </div>

    <div class="row menus-row">
        @if(!$project)
            <div class="col-xs-12 dashboard-form">
            {{-- <p>Tell your designer how you want your mobile app to look</p> --}}
            <form class="" method="POST" action="{{ route('store.project') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="appForm">I want my app to:</label>
                        <select name="retain_branding" class="form-control" id="appForm">
                            <option value="true">match the style of my existing website</option>
                            <option value="false">look different to my existing website</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="existing_website" class="control-label">Link to your website:</label>
                        <div class="">
                            <input type="text" class="form-control" id="existing_website" name="existing_website"  value="{{ old('existing_website') }}" required>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 falseSelected">
                    <div class="form-group">
                        <label for="existing_branding_requirements" class="control-label">Additional information:</label>
                        <div class="">
                            <textarea name="existing_branding_requirements" rows="4" class="form-control" id="existing_branding_requirements">{{ old('existing_branding_requirements') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 trueSelected">
                    <div class="form-group">
                        <label for="new_branding_requirements" class="control-label">
                            What do you want your app to look like?<br>
                            <small>Please include links to any websites and describe the aspects you like and dislike</small>
                        </label>
                        <div class="">
                            <textarea name="new_branding_requirements" rows="4" class="form-control" id="new_branding_requirements">{{ old('new_branding_requirements') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="branding_guidelines" class="control-label">
                            Your logo:<br>
                            <small>Preferably in .png format, and on a transparent background</small>
                        </label>
                        <div class="file-responsive">
                            <input type="file" class="form-control" id="branding_guidelines" name="branding_guidelines">
                        </div>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
        </div>
        @else
            @if($project)
                @foreach($project->messages->reverse() as $message)
                    @if($message->user_id == '1')
                        <div class="row message-row">
                            <div class="col-xs-hidden col-sm-3 col-lg-2 avatar">
                                <a href="/designers/tommy-harty-1">
                                    <img src="/images/profile.png" alt=""><br>
                                    <div style="margin-top:6px;">
                                        <small>Tommy</small>
                                    </div>
                                </a>
                                <div style="clear:both; margin-top:-3px;">
                                    <small>{{ $project->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-9 col-lg-10 message-container-2">
                                {!! nl2br(e($message->message)) !!}
                                @if ($message->attachment)
                                    <br><br>
                                    Attachment: <a target="_blank" href="/uploads/{{ $message->attachment }}">{{ $message->attachment }}</a>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="row message-row">
                            <div class="col-xs-12 col-sm-9 col-lg-10 message-container-2">
                                {!! nl2br(e($message->message)) !!}
                                @if ($message->attachment)
                                    <br><br>
                                    Attachment: <a target="_blank" href="/uploads/{{ $message->attachment }}">{{ $message->attachment }}</a>
                                @endif
                            </div>
                            <div class="col-xs-hidden col-sm-3 col-lg-2 avatar">
                                <img src="/images/person.png" alt=""><br>
                                <div style="margin-top:6px;">
                                    <small>You</small>
                                </div>
                                <div style="clear:both; margin-top:-3px;">
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            <div class="row message-row">
                <div class="col-xs-hidden col-sm-3 col-lg-2 avatar">
                    <a href="/designers/tommy-harty-1">
                        <img src="/images/profile.png" alt=""><br>
                        <div style="margin-top:6px;">
                            <small>Tommy</small>
                        </div>
                    </a>
                    <div style="clear:both; margin-top:-3px;">
                        <small>{{ $project->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9 col-lg-10 message-container">
                    <p>Hi {{ $project->user->name }}, I'm Tommy your dedicated mobile app designer.</p>
                    @if($project->retain_branding == 'true')
                        <p>You've asked me to design your app based on the look of your existing website, {{ $project->existing_website }}</p>
                    @endif
                    @if($project->existing_branding_requirements)
                        <p>You've also given me the following information to help move things forward:</p>
                        <p><em>"{{ $project->existing_branding_requirements }}"</em></p>
                    @endif
                    @if($project->new_branding_requirements)
                        <p>You've given me the following information to help move things forward:</p>
                        <p><em>"{{ $project->new_branding_requirements }}"</em></p>
                    @endif
                    <p>I am going to start work on your app now and I will post all updates here every step of the way.</p>
                    <p>You can send me a message here any time, and also take a look at <a href="/designers/tommy-harty-1">my profile</a> to learn a bit more about me!</p>
                    @if($project->branding_guidelines)
                        <br>
                        Attachment: <a target="_blank" href="/uploads/{{ $project->branding_guidelines }}">{{ $project->branding_guidelines }}</a>
                    @endif
                </div>
            </div>
        @endif
    </div>

@endsection

@if($project)
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Message</h4>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="{{ route('store.message') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="project_id" value="{{ $project->id }}">

                        <div class="form-group">
                            <label for="message" class="control-label">Message:</label>
                            <div class="">
                                <textarea name="message" rows="4" class="form-control" id="message">{{ old('message')}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="attachment" class="control-label">Attachment:</label>
                            <div class="">
                                <input type="file" class="form-control" id="attachment" name="attachment">
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                </div>
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>
@endif
