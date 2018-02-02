<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->subscribed('monthly') || Auth::user()->role == 'demo') {
            $project = Project::where(['user_id' => auth()->id()])->first();
            return view('project.index', compact('project'));
        } elseif(Auth::user()->role == 'designer') {
            return redirect('/project-management');
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return redirect('/payment');
        }
    }

    public function management()
    {
        if (Auth::user()->role == 'designer') {
            $projects = Project::where(['project_status' => 'Open'])->orderBy('created_at', 'desc')->get();
            return view('project.management', compact('projects'));
        } else {
            if(Project::where(['user_id' => Auth::user()->id])->exists()) {
                return redirect('/account');
            }
            return view('project.index');
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
            if ($request->hasFile('branding_guidelines')) {
                $file = $request->file('branding_guidelines');
                $path = $request->file('branding_guidelines')->store('uploads');
                $file->move('uploads' , Auth::user()->id . '-' . $file->getClientOriginalName());
                $the_file = Auth::user()->id . '-' . $file->getClientOriginalName();
            } else {
                $the_file = null;
            }

            Project::create([
                'branding_guidelines' => $the_file,
                'user_id' => auth()->id(),
                'designer_id' => '1',
                'retain_branding' => request('retain_branding'),
                'existing_website' => request('existing_website'),
                'existing_branding_requirements' => request('existing_branding_requirements'),
                'new_branding_requirements' => request('new_branding_requirements'),
                'project_status' => 'Open',
            ]);

            $data = array(
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            );

            Mail::send('emails.superadmin.projectsubmitted', $data, function($message) use ($data){
                $message->from($data['email']);
                $message->to('tommyharty@live.com');
                $message->subject('New Project Submission');
            });

            return redirect('/');
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
        if (Auth::user()->role == 'designer') {
            $project = Project::where(['id' => $id])->first();
            return view('project.show', compact('project'));
        } else {
            return redirect('/your-app-design');
        }
    }

    public function complete($id)
    {
        $project = Project::where(['id' => $id])->first();
        $project->project_status = 'Closed';
        $project->save();

        return redirect('/project-management/closed');
    }

    public function closed()
    {
        if (Auth::user()->role == 'designer') {
            $projects = Project::where(['project_status' => 'Closed'])->orderBy('created_at', 'desc')->get();
            return view('project.closed', compact('projects'));
        } else {
            return view('project.index');
        }
    }

    public function open($id)
    {
        $project = Project::where(['id' => $id])->first();
        $project->project_status = 'Open';
        $project->save();

        return redirect('/project-management');
    }
}
