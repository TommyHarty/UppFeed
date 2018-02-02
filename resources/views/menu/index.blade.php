@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>
            <i class="fa fa-cutlery" aria-hidden="true"></i> Food & Drink Menus
            <span class="pull-right">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn orange-button not-on-mobile" data-toggle="modal" data-target="#myModal">
                    Add New Menu
                </button>
            </span>
        </h1>

        <button type="button" class="btn orange-button mobile-only mobile-dashboard-button" data-toggle="modal" data-target="#myModal">
            Add New Menu
        </button>
    </div>

    <div class="row menus-row">
        @foreach($menus as $menu)
            <div class="row dashboard-entry">
                <div class="col-xs-12 col-sm-6 col-lg-8 day">
                    {{ $menu->menu_title }}
                    <span class="pull-right">
                        <small>{{ $menu->menuItems->count() }}</small>
                        @if($menu->menuItems->count() == 1)
                           <small>menu item</small>
                        @else
                           <small>menu items</small>
                        @endif
                    </span>
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <a href="{{ route('show.menu', $menu->menu_slug) }}" class="btn orange-button">
                        Edit
                    </a>
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <!-- Trigger the modal with a button -->
                    <a class="btn orange-button" data-toggle="modal" data-target="#menu-{{ $menu->id }}">
                        Delete
                    </a>
                </div>
            </div>

            <!-- Modal -->
            <div id="menu-{{ $menu->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure?</h4>
                        </div>
                        <div class="modal-body">
                            @if($menu->menuItems->count() > 0)
                                Are you sure you want to delete {{ $menu->menu_title }} and all {{ $menu->menuItems->count() }} of its items?
                            @else
                                Are you sure you want to delete {{ $menu->menu_title }}?
                            @endif
                        </div>
                        <div class="modal-footer">
                            <form class="delete-form" action="{{ route('delete.menu', $menu->menu_slug) }}" method="post">
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Menu</h4>
            </div>
            <div class="modal-body">
                <form class="" method="POST" action="{{ route('store.menu') }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                      <div class="form-group">
                          <label for="menu_image" class="control-label">Menu Image:</label>
                          <div class="">
                              <input type="file" class="form-control" id="menu_image" name="menu_image">
                          </div>
                      </div>

                    <div class="form-group">
                        <label for="menu_title" class="control-label">Menu Title:</label>
                        <div class="">
                            <input type="text" class="form-control" id="menu_title" name="menu_title"  value="{{ old('menu_title')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu_description" class="control-label">Menu Description:</label>
                        <div class="">
                            <textarea name="menu_description" rows="4" class="form-control" id="menu_description">{{ old('menu_description')}}</textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Menu</button>
                </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
