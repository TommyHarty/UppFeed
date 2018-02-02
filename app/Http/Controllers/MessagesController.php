<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\Project;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'designer' || Auth::user()->role == 'demo') {
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $path = $request->file('attachment')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = null;
            }

            Message::create([
                'attachment' => $the_file,
                'user_id' => request('user_id'),
                'project_id' => request('project_id'),
                'message' => request('message'),
            ]);

            $project = Project::where(['id' => request('project_id')])->first();

            if(request('user_id') == 1) {
                $data = array(
                    'email' => $project->user->email,
                );

                Mail::send('emails.admin.message', $data, function($message) use ($data){
                    $message->from('tommy@uppfeed.co.uk');
                    $message->to($data['email']);
                    $message->subject('New Message');
                });
            } else {
                $data = array(
                    'name' => $project->user->name,
                    'email' => $project->user->email,
                    'id' => $project->id,
                );

                Mail::send('emails.superadmin.message', $data, function($message) use ($data){
                    $message->from($data['email']);
                    $message->to('tommyharty@live.com');
                    $message->subject('New Message');
                });
            }

            return redirect()->back();
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }
}
