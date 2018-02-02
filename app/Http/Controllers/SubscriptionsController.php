<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\Project;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function account()
    {
        $user = Auth::user();
        if($user->role != 'designer') {
            $profile = $user;
            $invoices = $user->invoices();
            return view('profile.account', compact('profile', 'invoices'));
        } else {
            return redirect('/');
        }
    }

    public function subscribe()
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            return redirect('/your-app-design');
        } elseif(Auth::user()->role == 'designer') {
            return redirect('/project-management');
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return view('account.subscribe');
            } else {
                return view('subscribe');
            }
        }
    }

    public function subscribeMonthly(Request $request)
    {
        $user = Auth::user();

        $user->newSubscription('monthly', 'monthly')->create($request->get('stripeToken'), [
            'email' => $user->email,
            'description' => $user->name,
        ]);

        $data = array(
            'name' => $user->name,
            'email' => $user->email,
        );

        Mail::send('emails.superadmin.subscribed', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('tommyharty@live.com');
            $message->subject('New Paid Subscription');
        });

        return redirect('/');
    }

    public function invoice(Request $request, $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId, [
            'vendor'  => 'UppFeed',
            'product' => 'Subscription',
        ]);
    }

    public function cancelSubscription()
    {
        $user = Auth::user();

        $user->subscription('monthly')->cancel();

        $data = array(
            'name' => $user->name,
            'email' => $user->email,
        );

        Mail::send('emails.superadmin.cancelled', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('tommyharty@live.com');
            $message->subject('Subscription Cancelled');
        });

        return redirect()->back();
    }

    public function resumeFromGrace()
    {
        $user = Auth::user();

        $user->subscription('monthly')->resume();

        $data = array(
            'name' => $user->name,
            'email' => $user->email,
        );

        Mail::send('emails.superadmin.resumed', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('tommyharty@live.com');
            $message->subject('Subscription Resumed');
        });

        return redirect()->back();
    }
}
