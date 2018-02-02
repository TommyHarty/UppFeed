<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Project;
use App\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
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
                $reservations = Reservation::where(['user_id' => auth()->user()->id, 'Status' => 'Pending'])->orderBy('created_at', 'desc')->get();
                return view('reservations.index', compact('reservations'));
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

    public function archived()
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $reservations = Reservation::where(['user_id' => auth()->user()->id, 'Status' => 'Archived'])->orderBy('created_at', 'desc')->get();
            return view('reservations.archived', compact('reservations'));
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
        Reservation::create([
            'user_id' => request('user_id'),
            'people' => request('people'),
            'date' => request('date'),
            'time' => request('time'),
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'details' => request('details'),
            'status' => 'Pending',
        ]);

        $user = User::where(['id' => request('user_id')])->find();

        $data = array(
            'email' => $user->email,
        );

        Mail::send('emails.admin.reservation', $data, function($message) use ($data){
            $message->from('tommy@uppfeed.co.uk');
            $message->to($data['email']);
        });

        $data = $request->json()->all(); //read json in request
        return response()->json($data); //send json response
    }

    public function archive($id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $reservation = Reservation::where(['id' => $id])->first();
            $reservation->status = 'Archived';
            $reservation->save();

            session()->flash('notification', 'Reservation archived');

            return redirect("/reservations/archived");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    public function unarchive($id)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $reservation = Reservation::where(['id' => $id])->first();
            $reservation->status = 'Pending';
            $reservation->save();

            session()->flash('notification', 'Reservation unarchived');

            return redirect("/reservations");
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
            $reservation = Reservation::where(['id' => $id])->first();
            $reservation->delete();

            session()->flash('notification', 'Reservation deleted');

            return redirect("/reservations");
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }
}
