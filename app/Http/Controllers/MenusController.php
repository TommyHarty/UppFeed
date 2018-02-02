<?php

namespace App\Http\Controllers;

use Auth;
use App\Menu;
use App\Project;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                $menus = Menu::where(['user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->get();
                return view('menu.index', compact('menus'));
            } else {
                return redirect('/your-app-design');
            }
        } elseif(Auth::user()->role == 'designer') {
            return redirect('/project-management');
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            if ($request->hasFile('menu_image')) {
                $file = $request->file('menu_image');
                $path = $request->file('menu_image')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = null;
            }

            Menu::create([
                'menu_image' => $the_file,
                'menu_title' => request('menu_title'),
                'menu_description' => request('menu_description'),
                'menu_slug' => strtolower(str_replace(' ', '-', request('menu_title'))) .  '-' . auth()->id(),
                'user_id' => auth()->id()
            ]);

            session()->flash('notification', $request->menu_title . ' now added to your app');

            return redirect("/menus/" . strtolower(str_replace(' ', '-', request('menu_title'))) .  '-' . auth()->id());
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
    public function show(Menu $menu)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            return view('menu.show', compact('menu'));
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            return view('menu.edit', compact('menu'));
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
    public function update(Request $request, Menu $menu)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            if ($request->hasFile('menu_image')) {
                $file = $request->file('menu_image');
                $path = $request->file('menu_image')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = $menu->menu_image;
            }

            $menu->menu_image = $the_file;
            $menu->menu_title = request('menu_title');
            $menu->menu_description = request('menu_description');
            $menu->menu_slug = strtolower(str_replace(' ', '-', request('menu_title'))) .  '-' . auth()->id();

            $menu->save();

            session()->flash('notification', 'Changes to ' . $menu->menu_title . ' now visible in your app');

            return redirect("/menus/$menu->menu_slug");
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
    public function destroy(Menu $menu)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $menu->delete();
            session()->flash('notification', $menu->menu_title . ' now deleted from your app');
            return redirect("/menus");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    public function api($id)
    {
        return Menu::where(['user_id' => $id])->orderBy('created_at', 'desc')->with('menuItems')->get()->toJson();
    }
}
