<?php

namespace App\Http\Controllers;

use Auth;
use App\Profile;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        if($profile->user->role == 'designer') {
            return view('profile.show', compact('profile'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        if($profile->user->role == 'designer') {
            return view('profile.edit', compact('profile'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $path = $request->file('profile_photo')->store('uploads');
            $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
            $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
        } else {
            $the_file = $profile->profile_photo;
        }

        if ($request->hasFile('background_image')) {
            $file = $request->file('background_image');
            $path = $request->file('background_image')->store('uploads');
            $file->move('uploads' , $file->getClientOriginalName());
            $the_file2 = $file->getClientOriginalName();
        } else {
            $the_file2 = $profile->background_image;
        }

        $profile->profile_photo = $the_file;
        $profile->background_image = $the_file2;
        $profile->biography = request('biography');
        $profile->website = request('website');
        $profile->facebook = request('facebook');
        $profile->instagram = request('instagram');
        $profile->linkedin = request('linkedin');
        $profile->twitter = request('twitter');
        $profile->youtube = request('youtube');

        $profile->save();

        return redirect("/designers/$profile->profile_slug");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
