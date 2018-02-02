@extends('layouts.dashboard')

@section('content')

    <div class="dashboard-header">
        <h1>
            <i class="fa fa-cogs" aria-hidden="true"></i> Closed Projects
            <span class="pull-right">
                <!-- Trigger the modal with a button -->
                <a class="btn orange-button btn-archived" href="{{ route('management.project') }}">
                    View Open
                </a>
            </span>
        </h1>
    </div>

    <div class="row menus-row">
        @foreach($projects as $project)
            <div class="col-xs-12 dashboard-form">
                <div class="col-xs-12 col-sm-6 col-lg-8">
                    <p>{{ $project->admin_name }}</p>
                    Completion target: {{ $project->created_at->addWeeks(1)->format('l F jS') }}
                </div>
                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <a href="{{ route('show.project', $project->id) }}" class="btn orange-button project-button">
                        Manage
                    </a>
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <!-- Trigger the modal with a button -->
                    <a class="btn orange-button project-button" data-toggle="modal" data-target="#project-{{ $project->id }}">
                        Open
                    </a>
                </div>
            </div>

            <!-- Modal -->
            <div id="project-{{ $project->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure?</h4>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to open this project?
                        </div>
                        <div class="modal-footer">
                            <form class="delete-form" action="{{ route('open.project', $project->id) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <button type="submit" class="btn orange-button">Open</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

@endsection
