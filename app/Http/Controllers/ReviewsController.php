<?php

namespace App\Http\Controllers;

use Auth;
use App\Review;
use App\Project;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('api', 'store');
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
                $reviews = Review::where(['user_id' => auth()->user()->id])->orderBy('created_at', 'desc')->get();
                return view('reviews.index', compact('reviews'));
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
        Review::create([
            'user_id' => request('user_id'),
            'review' => request('review'),
            'stars' => request('stars'),
            'status' => 'Pending',
        ]);

        $user = User::where(['id' => request('user_id')])->find();

        $data = array(
            'email' => $user->email,
        );

        Mail::send('emails.admin.review', $data, function($message) use ($data){
            $message->from('tommy@uppfeed.co.uk');
            $message->to($data['email']);
        });

        $data = $request->json()->all(); //read json in request
        return response()->json($data); //send json response
    }

    public function approve($id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $review = Review::where(['id' => $id])->first();
            $review->status = 'Approved';
            $review->save();

            session()->flash('notification', 'Review approved');

            return redirect()->back();
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
            $review = Review::where(['id' => $id])->first();
            $review->delete();

            session()->flash('notification', 'Review deleted');

            return redirect("/reviews");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    public function api($id)
    {
        return Review::where(['user_id' => $id, 'status' => 'Approved'])->orderBy('created_at', 'desc')->get()->toJson();
    }
}
