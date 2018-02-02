<?php

namespace App\Http\Controllers;

use Auth;
use App\Event;
use App\Project;
use Illuminate\Http\Request;

class EventsController extends Controller
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
                $events = Event::where(['user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->get();
                return view('event.index', compact('events'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            return view('event.create');
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
            if ($request->hasFile('event_image')) {
                $file = $request->file('event_image');
                $path = $request->file('event_image')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = null;
            }

            Event::create([
                'event_image' => $the_file,
                'event_title' => request('event_title'),
                'event_date' => request('event_date'),
                'start_time' => request('start_time'),
                'end_time' => request('end_time'),
                'event_price' => request('event_price'),
                'event_price_details' => request('event_price_details'),
                'event_description' => request('event_description'),
                'event_slug' => strtolower(str_replace(' ', '-', request('event_title'))) .  '-' . auth()->id(),
                'user_id' => auth()->id()
            ]);

            session()->flash('notification', $request->event_title . ' now added to your app');

            return redirect("/events");
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
    public function show(Event $event)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            return view('event.show', compact('event'));
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
    public function update(Request $request, Event $event)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            if ($request->hasFile('event_image')) {
                $file = $request->file('event_image');
                $path = $request->file('event_image')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = $event->event_image;
            }

            $event->event_image = $the_file;
            $event->event_title = request('event_title');
            $event->event_date = request('event_date');
            $event->start_time = request('start_time');
            $event->end_time = request('end_time');
            $event->event_price = request('event_price');
            $event->event_price_details = request('event_price_details');
            $event->event_description = request('event_description');
            $event->event_slug = strtolower(str_replace(' ', '-', request('event_title'))) .  '-' . auth()->id();

            $event->save();

            session()->flash('notification', 'Changes to ' . $event->event_title . ' now visible in your app');

            return redirect("/events/$event->event_slug");
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
    public function destroy(Event $event)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $event->delete();
            session()->flash('notification', $event->event_title . ' now deleted from your app');
            return redirect("/events");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    public function api($id)
    {
        return Event::where(['user_id' => $id])->orderBy('created_at', 'desc')->get()->toJson();
    }
}
