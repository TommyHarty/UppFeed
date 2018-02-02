@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>
            <i class="fa fa-star-half-o" aria-hidden="true"></i> Customer Reviews
        </h1>
    </div>

    @foreach($reviews as $review)
        <div class="row menus-row reviews-row">
            <div class="row dashboard-entry review">
                <div class="col-xs-12 col-sm-6 col-lg-8">
                    @if($review->stars == 1)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @endif
                    @if($review->stars == 2)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @endif
                    @if($review->stars == 3)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @endif
                    @if($review->stars == 4)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @endif
                    @if($review->stars == 5)
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @endif
                    @if($review->review)
                        <br>
                    @endif
                    {{ $review->review }}
                </div>

                <hr class="tablet-hr">

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    @if ($review->status == 'Pending')
                        <form class="" method="POST" action="{{ route('approve.review', $review->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <button type="submit" class="btn orange-button approve">Approve</button>
                        </form>
                    @else
                        <a href="" class="btn orange-button approved">
                            Approved
                        </a>
                    @endif
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <!-- Trigger the modal with a button -->
                    <a class="btn orange-button" data-toggle="modal" data-target="#review-{{ $review->id }}">
                        Delete
                    </a>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="review-{{ $review->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Are you sure?</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this review?
                    </div>
                    <div class="modal-footer">
                        <form class="delete-form" action="{{ route('delete.review', $review->id) }}" method="post">
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
