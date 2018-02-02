<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\BusinessInfo;
use Illuminate\Http\Request;

class BusinessInfoController extends Controller
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
        $user = Auth::user();
        if ($user->subscribed('monthly') || $user->role == 'demo') {
            if(Project::where(['user_id' => $user->id])->exists()) {
                $businessinfo = BusinessInfo::where(['user_id' => auth()->user()->id])->first();
                return view('businessinfo.index', compact('businessinfo'));
            } else {
                return redirect('/your-app-design');
            }
        } elseif($user->role == 'designer') {
            return redirect('/project-management');
        } else {
            if(Project::where(['user_id' => $user->id])->exists()) {
                return redirect('/account');
            }
            return view('subscribe');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $businessinfo = BusinessInfo::where(['id' => $id])->first();

            if ($request->hasFile('business_logo')) {
                $file = $request->file('business_logo');
                $path = $request->file('business_logo')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = $businessinfo->business_logo;
            }

            if ($request->hasFile('business_photo')) {
                $file = $request->file('business_photo');
                $path = $request->file('business_photo')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file2 = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file2 = $businessinfo->business_photo;
            }

            $businessinfo->business_logo = $the_file;
            $businessinfo->business_photo = $the_file2;
            $businessinfo->business_name = request('business_name');
            $businessinfo->business_email = request('business_email');
            $businessinfo->phone = request('phone');
            $businessinfo->street_1 = request('street_1');
            $businessinfo->street_2 = request('street_2');
            $businessinfo->city = request('city');
            $businessinfo->county = request('county');
            $businessinfo->country = request('country');
            $businessinfo->postcode = request('postcode');
            $businessinfo->business_tagline = request('business_tagline');
            $businessinfo->business_description = request('business_description');

            $businessinfo->save();

            session()->flash('notification', 'Updated business information now visible in your app');

            return redirect("/business-information");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    public function api($id)
    {
        return BusinessInfo::where(['id' => $id])->first()->toJson();
    }
}
