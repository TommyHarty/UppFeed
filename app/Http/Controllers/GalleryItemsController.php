<?php

namespace App\Http\Controllers;

use Auth;
use App\ImageGallerie;
use App\GalleryItem;
use Illuminate\Http\Request;

class GalleryItemsController extends Controller
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
    public function store(Request $request, ImageGallerie $imagegallerie)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            if ($request->hasFile('gallery_item_image')) {
                $file = $request->file('gallery_item_image');
                $path = $request->file('gallery_item_image')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = null;
            }

            GalleryItem::create([
                'gallery_item_image' => $the_file,
                'gallery_item_title' => request('gallery_item_title'),
                'image_gallerie_id' => $imagegallerie->id,
                'user_id' => Auth::user()->id
            ]);

            return redirect("/image-galleries/$imagegallerie->gallery_slug");
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
    public function update(Request $request, ImageGallerie $imagegallerie, $id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $galleryitem = GalleryItem::where(['id' => $id])->first();

            $galleryitem->gallery_item_title = request('gallery_item_title');

            $galleryitem->save();

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
    public function destroy(ImageGallerie $imagegallerie, $id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $galleryitem = GalleryItem::where(['id' => $id])->first();
            $galleryitem->delete();

            return redirect("/image-galleries/$imagegallerie->gallery_slug");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }
}
