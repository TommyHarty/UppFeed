@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>
            <i class="fa fa-camera" aria-hidden="true"></i> Image Galleries
            <span class="pull-right">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn orange-button not-on-mobile" data-toggle="modal" data-target="#addGallery">
                    Add New Gallery
                </button>
            </span>
        </h1>

        <button type="button" class="btn orange-button mobile-dashboard-button mobile-only" data-toggle="modal" data-target="#addGallery">
            Add New Gallery
        </button>
    </div>

    <div class="row menus-row">
        @foreach($galleries as $gallery)
            <div class="row dashboard-entry">
                <div class="col-xs-12 col-sm-6 col-lg-8 day">
                    {{ $gallery->gallery_title }}
                    <span class="pull-right">
                        <small>{{ $gallery->galleryItems->count() }}</small>
                        @if($gallery->galleryItems->count() == 1)
                           <small>image</small>
                        @else
                           <small>images</small>
                        @endif
                    </span>
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <a href="{{ route('show.gallery', $gallery->gallery_slug) }}" class="btn orange-button">
                        Edit
                    </a>
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <!-- Trigger the modal with a button -->
                    <a class="btn orange-button" data-toggle="modal" data-target="#gallery-{{ $gallery->id }}">
                        Delete
                    </a>
                </div>
            </div>

            <!-- Modal -->
            <div id="gallery-{{ $gallery->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure?</h4>
                        </div>
                        <div class="modal-body">
                            @if($gallery->galleryItems->count() > 0)
                                Are you sure you want to delete {{ $gallery->gallery_title }} gallery and all {{ $gallery->galleryItems->count() }} of its images?
                            @else
                                Are you sure you want to delete {{ $gallery->gallery_title }} gallery?
                            @endif
                        </div>
                        <div class="modal-footer">
                            <form class="delete-form" action="{{ route('delete.gallery', $gallery->gallery_slug) }}" method="post">
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
<div id="addGallery" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Gallery</h4>
            </div>
            <div class="modal-body">
                <form class="" method="POST" action="{{ route('store.gallery') }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                      <div class="form-group">
                          <label for="gallery_main_image" class="control-label">Gallery Cover Image:</label>
                          <div class="">
                              <input type="file" class="form-control" id="gallery_main_image" name="gallery_main_image">
                          </div>
                      </div>

                    <div class="form-group">
                        <label for="gallery_title" class="control-label">Gallery Title:</label>
                        <div class="">
                            <input type="text" class="form-control" id="gallery_title" name="gallery_title"  value="{{ old('gallery_title')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gallery_description" class="control-label">Gallery Description:</label>
                        <div class="">
                            <textarea name="gallery_description" rows="4" class="form-control" id="gallery_description">{{ old('menu_description')}}</textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
