<?php

namespace App\Http\Controllers;

use Auth;
use App\Project;
use App\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                $customers = Customer::where(['app_id' => Auth::user()->id])->get();
                return view('customers.index', compact('customers'));
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
        Customer::create([
            'app_id' => request('app_id'),
            'customer_name' => request('customer_name'),
            'customer_email' => request('customer_email'),
        ]);

        $data = $request->json()->all(); //read json in request
        return response()->json($data); //send json response
    }
}
