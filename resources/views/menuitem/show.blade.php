@extends('layouts.dashboard')

@section('content')

    <div class="dashboard-header">
        <h1>
            <i class="fa fa-cutlery" aria-hidden="true"></i> <a href="{{ route('index.menu') }}">Food & Drink Menus</a> / <a href="{{ route('show.menu', $menu->menu_slug) }}">{{ $menu->menu_title }}</a> / {{ $menuitem->menu_item_title }}
        </h1>
    </div>

    <div class="row menus-row">
        <div class="col-xs-12 dashboard-form">
            <form class="" method="POST" action="{{ route('update.menuitem', array($menu->menu_slug, $menuitem->id)) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="col-md-6 col-lg-4 menu-image">
                    <div class="form-group">
                        <label for="menu_item_image" class="control-label">Menu Item Image:</label>
                        <div class="">
                            <input type="file" class="form-control" id="menu_item_image" name="menu_item_image">
                        </div>
                        @if($menuitem->menu_item_image)
                            <img src="/uploads/{{ $menuitem->menu_item_image }}" alt="">
                        @endif
                    </div>
                </div>

                <div class="col-md-6 col-lg-8">
                    {{-- <div class="form-group">
                        <label for="menu_item_category" class="control-label">Menu Item Category:</label>
                        <div class="">
                            <select class="form-control" id="menu_item_category" name="menu_item_category">
                                <option value="NULL" {{ $menuitem->menu_item_category == 'NULL' ? 'selected' : '' }}>No Category</option>
                                <option value="Starter" {{ $menuitem->menu_item_category == 'Starter' ? 'selected' : '' }}>Starters</option>
                                <option value="Main Course" {{ $menuitem->menu_item_category == 'Main Course' ? 'selected' : '' }}>Main Courses</option>
                                <option value="Side" {{ $menuitem->menu_item_category == 'Side' ? 'selected' : '' }}>Sides</option>
                                <option value="Dessert" {{ $menuitem->menu_item_category == 'Dessert' ? 'selected' : '' }}>Desserts</option>
                                <option value="Drink" {{ $menuitem->menu_item_category == 'Drink' ? 'selected' : '' }}>Drinks</option>
                            </select>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label for="menu_item_title" class="control-label">Menu Item Title:</label>
                        <div class="">
                            <input type="text" class="form-control" id="menu_item_title" name="menu_item_title"  value="{{ old('menu_item_title', $menuitem->menu_item_title) }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu_item_description" class="control-label">Menu Item Description:</label>
                        <div class="">
                            <textarea name="menu_item_description" rows="4" class="form-control" id="menu_item_description">{{ old('menu_item_description', $menuitem->menu_item_description) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu_item_price" class="control-label">Menu Item Price:</label>
                        <div class="">
                            <div class="input-group">
                                <span class="input-group-addon" id="pound">£</span>
                                <input type="text" class="form-control" id="menu_item_price" name="menu_item_price"  value="{{ old('menu_item_price', $menuitem->menu_item_price) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu_item_price_details" class="control-label">Extras Available:</label>
                        <div class="">
                            <input type="text" class="form-control" id="menu_item_price_details" name="menu_item_price_details"  value="{{ old('menu_item_price_details', $menuitem->menu_item_price_details) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nutritional_info" class="control-label">Nutritional Information:</label>
                        <div class="">
                            <input name="nutritional_info" rows="4" class="form-control" id="nutritional_info" value="{{ old('nutritional_info', $menuitem->nutritional_info) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="allergen_info" class="control-label">Allergen Information:</label>
                        <div class="">
                            <input name="allergen_info" rows="4" class="form-control" id="allergen_info" value="{{ old('allergen_info', $menuitem->allergen_info) }}">
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
