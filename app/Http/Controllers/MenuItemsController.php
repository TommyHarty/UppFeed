<?php

namespace App\Http\Controllers;

use Auth;
use App\Menu;
use App\MenuItem;
use Illuminate\Http\Request;

class MenuItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('api');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Menu $menu)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            if ($request->hasFile('menu_item_image')) {
                $file = $request->file('menu_item_image');
                $path = $request->file('menu_item_image')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = null;
            }

            MenuItem::create([
                'menu_item_image' => $the_file,
                'menu_item_category' => request('menu_item_category'),
                'menu_item_title' => request('menu_item_title'),
                'menu_item_description' => request('menu_item_description'),
                'menu_item_price' => request('menu_item_price'),
                'menu_item_price_details' => request('menu_item_price_details'),
                'nutritional_info' => request('nutritional_info'),
                'allergen_info' => request('allergen_info'),
                'menu_id' => $menu->id,
                'user_id' => Auth::user()->id
            ]);

            session()->flash('notification', $request->menu_item_title . ' now added to your app');

            return redirect("/menus/$menu->menu_slug");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu, $id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $menuitem = MenuItem::where(['id' => $id])->first();
            return view('menuitem.show', compact('menu', 'menuitem'));
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu, $id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $menuitem = MenuItem::where(['id' => $id])->first();

            if ($request->hasFile('menu_item_image')) {
                $file = $request->file('menu_item_image');
                $path = $request->file('menu_item_image')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = $menuitem->menu_item_image;
            }

            $menuitem->menu_item_image = $the_file;
            $menuitem->menu_item_category = request('menu_item_category');
            $menuitem->menu_item_title = request('menu_item_title');
            $menuitem->menu_item_description = request('menu_item_description');
            $menuitem->menu_item_price = request('menu_item_price');
            $menuitem->menu_item_price_details = request('menu_item_price_details');
            $menuitem->nutritional_info = request('nutritional_info');
            $menuitem->allergen_info = request('allergen_info');

            $menuitem->save();

            session()->flash('notification', 'Changes to ' . $menuitem->menu_item_title . ' now visible in your app');

            return redirect("/menus/$menu->menu_slug/$menuitem->id");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu, $id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $menuitem = MenuItem::where(['id' => $id])->first();
            $menuitem->delete();
            session()->flash('notification', $menuitem->menu_item_title . ' now deleted from your app');
            return redirect("/menus/$menu->menu_slug");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }
}
