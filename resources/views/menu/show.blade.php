@extends('layouts.dashboard')

@section('content')
    <div class="dashboard-header">
        <h1>
            <i class="fa fa-cutlery" aria-hidden="true"></i> <a href="{{ route('index.menu') }}">Food & Drink Menus</a> / {{ $menu->menu_title }}
        </h1>
    </div>

    <div class="row menus-row">
        <div class="col-xs-12 dashboard-form">
            <form class="" method="POST" action="{{ route('update.menu', $menu->menu_slug) }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('PUT') }}

                <div class="col-md-6 col-lg-4 menu-image">
                    <div class="form-group">
                        <label for="menu_image" class="control-label">Menu Image:</label>
                        <div class="">
                            <input type="file" class="form-control" id="menu_image" name="menu_image">
                        </div>
                        @if($menu->menu_image)
                            <img src="/uploads/{{ $menu->menu_image }}" alt="">
                        @endif
                    </div>
                </div>

                <div class="col-md-6 col-lg-8">
                    <div class="form-group">
                        <label for="menu_title" class="control-label">Menu Title:</label>
                        <div class="">
                            <input type="text" class="form-control" id="menu_title" name="menu_title"  value="{{ old('menu_title', $menu->menu_title) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu_description" class="control-label">Menu Description:</label>
                        <div class="">
                            <textarea name="menu_description" rows="4" class="form-control" id="menu_description">{{ old('menu_description', $menu->menu_description) }}</textarea>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="dashboard-header bt">
        <h1>
            {{ $menu->menuItems->count() }} {{ $menu->menu_title }}
            @if($menu->menuItems->count() == 1)
                Item
            @else
                Items
            @endif
            <span class="pull-right">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn orange-button not-on-mobile" data-toggle="modal" data-target="#addItem">
                    Add Menu Item
                </button>
            </span>
        </h1>

        <button type="button" class="btn orange-button mobile-only mobile-dashboard-button" data-toggle="modal" data-target="#addItem">
            Add Menu Item
        </button>
    </div>

    <div class="row menus-row">
        @foreach ($menu->menuItems as $item)
            <div class="row dashboard-entry">
                <div class="col-xs-12 col-sm-6 col-lg-8 day">
                    {{ $item->menu_item_title }}
                    @if($item->menu_item_price)
                        <span class="pull-right">
                            <small>£{{ $item->menu_item_price }}</small>
                        </span>
                    @endif
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <a href="{{ route('edit.menuitem', array($menu->menu_slug, $item->id)) }}" class="btn orange-button">
                        Edit
                    </a>
                </div>

                <div class="col-xs-6 col-sm-3 col-lg-2">
                    <!-- Trigger the modal with a button -->
                    <a class="btn orange-button" data-toggle="modal" data-target="#menuitem-{{ $item->id }}">
                        Delete
                    </a>
                </div>
            </div>

            <!-- Modal -->
            <div id="menuitem-{{ $item->id }}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure?</h4>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete {{ $item->menu_item_title }}?
                        </div>
                        <div class="modal-footer">
                            <form class="delete-form" action="{{ route('delete.menuitem', array($menu->menu_slug, $item->id)) }}" method="post">
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
<div id="editMenu" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit {{ $menu->menu_title }}</h4>
            </div>
            <div class="modal-body">
                <form class="" method="POST" action="{{ route('update.menu', $menu->menu_slug) }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                      <div class="form-group">
                          <label for="menu_image" class="control-label">Menu Image:</label>
                          <div class="">
                              <input type="file" class="form-control" id="menu_image" name="menu_image">
                          </div>
                      </div>

                    <div class="form-group">
                        <label for="menu_title" class="control-label">Menu Title:</label>
                        <div class="">
                            <input type="text" class="form-control" id="menu_title" name="menu_title"  value="{{ old('menu_title', $menu->menu_title) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu_description" class="control-label">Menu Description:</label>
                        <div class="">
                            <textarea name="menu_description" rows="4" class="form-control" id="menu_description">{{ old('menu_description', $menu->menu_description) }}</textarea>
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

<!-- Modal -->
<div id="addItem" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Menu Item</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="{{ route('store.menuitem', $menu->menu_slug) }}" enctype="multipart/form-data">
                  {{ csrf_field() }}

                    {{-- <div class="form-group">
                        <label for="menu_item_category" class="control-label">Menu Item Category:</label>
                        <div class="">
                            <select class="form-control" id="menu_item_category" name="menu_item_category">
                                <option value="NULL" selected>No Category</option>
                                <option value="Starter">Starters</option>
                                <option value="Main Course">Main Courses</option>
                                <option value="Side">Sides</option>
                                <option value="Desert">Deserts</option>
                                <option value="Drink">Drinks</option>
                            </select>
                        </div>
                    </div> --}}

                      <div class="form-group">
                          <label for="menu_item_image" class="control-label">Menu Item Image:</label>
                          <div class="">
                              <input type="file" class="form-control" id="menu_item_image" name="menu_item_image">
                          </div>
                      </div>

                    <div class="form-group">
                        <label for="menu_item_title" class="control-label">Menu Item Title:</label>
                        <div class="">
                            <input type="text" class="form-control" id="menu_item_title" name="menu_item_title"  value="{{ old('menu_item_title')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu_item_description" class="control-label">Menu Item Description:</label>
                        <div class="">
                            <textarea name="menu_item_description" rows="4" class="form-control" id="menu_item_description">{{ old('menu_item_description')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu_item_price" class="control-label">Menu Item Price:</label>
                        <div class="input-group">
                            <span class="input-group-addon" id="pound">£</span>
                            <input type="text" class="form-control" id="menu_item_price" name="menu_item_price"  value="{{ old('menu_item_price')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu_item_price_details" class="control-label">Extras Available:</label>
                        <div class="">
                            <input type="text" class="form-control" id="menu_item_price_details" name="menu_item_price_details"  value="{{ old('menu_item_price_details')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nutritional_info" class="control-label">Nutritional Information:</label>
                        <div class="">
                            <input name="nutritional_info" rows="4" class="form-control" id="nutritional_info" value="{{ old('nutritional_info')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="allergen_info" class="control-label">Allergen Information:</label>
                        <div class="">
                            <input name="allergen_info" rows="4" class="form-control" id="allergen_info" value="{{ old('allergen_info')}}">
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
