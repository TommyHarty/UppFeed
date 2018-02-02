@extends('layouts.dashboard')

@section('content')
        <div class="dashboard-header">
            <h1>
                <i class="fa fa-camera" aria-hidden="true"></i> <a href="{{ route('index.gallery') }}">Image Galleries</a> / {{ $imagegallerie->gallery_title }}
            </h1>
        </div>

        <div class="row menus-row">
            <div class="col-xs-12 dashboard-form">
                <form class="" method="POST" action="{{ route('update.gallery', $imagegallerie->gallery_slug) }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                    <div class="col-md-6 col-lg-4 menu-image">
                        <div class="form-group">
                            <label for="gallery_main_image" class="control-label">Gallery Cover Image:</label>
                            <div class="">
                                <input type="file" class="form-control" id="gallery_main_image" name="gallery_main_image">
                            </div>
                            @if($imagegallerie->gallery_main_image)
                                <img src="/uploads/{{ $imagegallerie->gallery_main_image }}" alt="">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-8">
                        <div class="form-group">
                            <label for="gallery_title" class="control-label">Gallery Title:</label>
                            <div class="">
                                <input type="text" class="form-control" id="gallery_title" name="gallery_title"  value="{{ old('gallery_title', $imagegallerie->gallery_title) }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gallery_description" class="control-label">Gallery Description:</label>
                            <div class="">
                                <textarea name="gallery_description" rows="4" class="form-control" id="gallery_description">{{ old('gallery_description', $imagegallerie->gallery_description) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="dashboard-header bt">
            <h1>
                {{ $imagegallerie->galleryItems->count() }}
                @if($imagegallerie->galleryItems->count() == 1)
                    Image
                @else
                    Images
                @endif
                <span class="pull-right">
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn orange-button not-on-mobile" data-toggle="modal" data-target="#addImage">
                        Add Image
                    </button>
                </span>
            </h1>

            <button type="button" class="btn orange-button mobile-dashboard-button mobile-only" data-toggle="modal" data-target="#addImage">
                Add Image
            </button>
        </div>

        <div class="row menus-row">
            @foreach($imagegallerie->galleryItems as $item)
                <div class="gallery-item col-md-6">
                  <form class="form-horizontal" method="POST" action="{{ route('update.galleryitem', array($imagegallerie->gallery_slug, $item->id)) }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      {{ method_field('PUT') }}

                      <div class="input-group">
                          <input type="text" class="form-control" id="gallery_item_title" name="gallery_item_title"  value="{{ old('gallery_item_title', $item->gallery_item_title) }}">
                          <div class="input-group-btn">
                              <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                      </div>

                  </form>
                    <img src="/uploads/{{ $item->gallery_item_image }}" alt="">

                    <!-- Trigger the modal with a button -->
                    <a class="btn orange-button delete-image" data-toggle="modal" data-target="#galleryitem-{{ $item->id }}">
                        Delete
                    </a>
                </div>

                <!-- Modal -->
                <div id="galleryitem-{{ $item->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Are you sure?</h4>
                            </div>
                            <div class="modal-body">
                                @if(!$item->gallery_item_title == NULL)
                                    Are you sure you want to delete the image '{{ $item->gallery_item_title }}'?
                                @else
                                    Are you sure you want to delete this image?
                                @endif
                            </div>
                            <div class="modal-footer">
                                <form class="delete-form" action="{{ route('delete.galleryitem', array($imagegallerie->gallery_slug, $item->id)) }}" method="post">
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
<div id="addImage" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Image</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('store.galleryitem', $imagegallerie->gallery_slug) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="gallery_item_image" class="control-label">Image:</label>
                        <div class="">
                            <input type="file" class="form-control" id="gallery_item_image" name="gallery_item_image" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gallery_item_title" class="control-label">Image Title:</label>
                        <div class="">
                            <input type="text" class="form-control" id="gallery_item_title" name="gallery_item_title"  value="{{ old('gallery_item_title')}}">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
