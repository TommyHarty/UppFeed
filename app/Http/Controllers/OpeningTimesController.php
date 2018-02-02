<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\OpeningTime;
use Illuminate\Http\Request;

class OpeningTimesController extends Controller
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
                $times = OpeningTime::where(['user_id' => auth()->user()->id])->first();
                return view('times.index', compact('times'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $times = OpeningTime::where(['id' => $id])->first();

            $times->monday_opening = request('monday_opening');
            $times->monday_closing = request('monday_closing');
            $times->tuesday_opening = request('tuesday_opening');
            $times->tuesday_closing = request('tuesday_closing');
            $times->wednesday_opening = request('wednesday_opening');
            $times->wednesday_closing = request('wednesday_closing');
            $times->thursday_opening = request('thursday_opening');
            $times->thursday_closing = request('thursday_closing');
            $times->friday_opening = request('friday_opening');
            $times->friday_closing = request('friday_closing');
            $times->saturday_opening = request('saturday_opening');
            $times->saturday_closing = request('saturday_closing');
            $times->sunday_opening = request('sunday_opening');
            $times->sunday_closing = request('sunday_closing');

            $times->save();

            session()->flash('notification', 'Updated opening times now visible in your app');

            return redirect("/opening-times");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    public function api($id)
    {
        return OpeningTime::where(['id' => $id])->first()->toJson();
    }
}
