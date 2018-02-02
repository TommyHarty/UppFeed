@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>
            <i class="fa fa-ticket" aria-hidden="true"></i> Special Offers
            <span class="pull-right">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn orange-button not-on-mobile" data-toggle="modal" data-target="#addDeal">
                    Add New Offer
                </button>
            </span>
        </h1>

        <button type="button" class="btn orange-button mobile-dashboard-button mobile-only" data-toggle="modal" data-target="#addDeal">
            Add New Offer
        </button>
    </div>

    <div class="row menus-row">
        @foreach($deals as $deal)
            <div class="row dashboard-entry">
                <div class="col-xs-12 col-sm-6 col-lg-8 day">
                    {{ $deal->deal_title }}
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <a href="{{ route('show.deal', $deal->id) }}" class="btn orange-button">
                        Edit
                    </a>
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <!-- Trigger the modal with a button -->
                    <a class="btn orange-button" data-toggle="modal" data-target="#deal-{{ $deal->id }}">
                        Delete
                    </a>
                </div>
            </div>

            <!-- Modal -->
            <div id="deal-{{ $deal->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure?</h4>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the offer '{{ $deal->deal_title }}'?
                        </div>
                        <div class="modal-footer">
                            <form class="delete-form" action="{{ route('delete.deal', $deal->id) }}" method="post">
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
<div id="addDeal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Offer</h4>
            </div>
            <div class="modal-body">
                <form class="" method="POST" action="{{ route('store.deal') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="deal_image" class="control-label">Offer Image:</label>
                        <div class="">
                            <input type="file" class="form-control" id="deal_image" name="deal_image">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deal_title" class="control-label">Offer Title:</label>
                        <div class="">
                            <input type="text" class="form-control" id="deal_title" name="deal_title"  value="{{ old('deal_title')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deal_description" class="control-label">Offer Description:</label>
                        <div class="">
                            <textarea name="deal_description" rows="4" class="form-control" id="deal_description">{{ old('deal_description')}}</textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Offer</button>
                </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
