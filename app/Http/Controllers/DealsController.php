<?php

namespace App\Http\Controllers;

use Auth;
use App\Deal;
use App\Project;
use Illuminate\Http\Request;

class DealsController extends Controller
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
                $deals = Deal::where(['user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->get();
                return view('deal.index', compact('deals'));
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
            if ($request->hasFile('deal_image')) {
                $file = $request->file('deal_image');
                $path = $request->file('deal_image')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = null;
            }

            Deal::create([
                'deal_image' => $the_file,
                'deal_title' => request('deal_title'),
                'deal_description' => request('deal_description'),
                'user_id' => auth()->id()
            ]);

            session()->flash('notification', $request->deal_title . ' now added to your app');

            return redirect("/offers");
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
    public function show($id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $deal = Deal::where(['id' => $id])->first();
            return view('deal.show', compact('deal'));
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
            $deal = Deal::where(['id' => $id])->first();

            if ($request->hasFile('deal_image')) {
                $file = $request->file('deal_image');
                $path = $request->file('deal_image')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = $deal->deal_image;
            }

            $deal->deal_image = $the_file;
            $deal->deal_title = request('deal_title');
            $deal->deal_description = request('deal_description');

            $deal->save();

            session()->flash('notification', 'Changes to ' . $deal->deal_title . ' now visible in your app');

            return redirect("/offers/$deal->id");
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
    public function destroy($id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $deal = Deal::where(['id' => $id])->first();
            $deal->delete();
            session()->flash('notification', $deal->deail_title . ' now deleted from your app');
            return redirect("/offers");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    public function api($id)
    {
        return Deal::where(['user_id' => $id])->orderBy('created_at', 'desc')->get()->toJson();
    }
}
