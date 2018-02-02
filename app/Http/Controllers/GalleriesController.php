<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\ImageGallerie;
use Illuminate\Http\Request;

class GalleriesController extends Controller
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
                $galleries = ImageGallerie::where(['user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->get();
                return view('gallery.index', compact('galleries'));
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
            if ($request->hasFile('gallery_main_image')) {
                  $file = $request->file('gallery_main_image');
                  $path = $request->file('gallery_main_image')->store('uploads');
                  $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                  $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
              } else {
                  $the_file = null;
              }

              ImageGallerie::create([
                  'gallery_main_image' => $the_file,
                  'gallery_title' => request('gallery_title'),
                  'gallery_description' => request('gallery_description'),
                  'gallery_slug' => strtolower(str_replace(' ', '-', request('gallery_title'))) .  '-' . auth()->id(),
                  'user_id' => auth()->id()
              ]);

              session()->flash('notification', $request->gallery_title . ' now added to your app');

              return redirect("/image-galleries/" . strtolower(str_replace(' ', '-', request('gallery_title'))) .  '-' . auth()->id());
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
    public function show(ImageGallerie $imagegallerie)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            return view('gallery.show', compact('imagegallerie'));
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
    public function update(Request $request, ImageGallerie $imagegallerie)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            if ($request->hasFile('gallery_main_image')) {
                $file = $request->file('gallery_main_image');
                $path = $request->file('gallery_main_image')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = $imagegallerie->gallery_main_image;
            }

            $imagegallerie->gallery_main_image = $the_file;
            $imagegallerie->gallery_title = request('gallery_title');
            $imagegallerie->gallery_description = request('gallery_description');
            $imagegallerie->gallery_slug = strtolower(str_replace(' ', '-', request('gallery_title'))) .  '-' . auth()->id();

            $imagegallerie->save();

            session()->flash('notification', 'Changes to ' . $imagegallerie->gallery_title . ' now visible in your app');

            return redirect("/image-galleries/$imagegallerie->gallery_slug");
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
    public function destroy(ImageGallerie $imagegallerie)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $imagegallerie->delete();
            session()->flash('notification', $imagegallerie->gallery_title . ' now deleted from your app');
            return redirect("/image-galleries");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    public function api($id)
    {
        return ImageGallerie::where(['user_id' => $id])->orderBy('created_at', 'desc')->with('galleryItems')->get()->toJson();
    }
}
