<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        return view('jobs.index', [
            'jobs' =>  $jobs
        ]);
    }
    public function create()
    {
        return view('jobs.create');
    }
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }
    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', '']
        ]);

        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);
        return redirect('/jobs');
    }
    public function edit(Job $job)
    {
        // if Auth::user()->can('edit-job', $job) {
        //     dd('failure');
        // }

        Gate::authorize('edit-job', $job);

        return view('jobs.edit', ['job' => $job]);
    }
    public function update(Job $job)
    {
        Gate::authorize('edit-job', $job);

        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required', '']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        // another same method
        // $job->title = request('title');
        // $job->salary = request('salary');
        // $job->save();

        // redirect to the job page
        return redirect('/jobs/' . $job->id);
    }
    public function destroy(Job $job)
    {
        Gate::authorize('edit-job', $job);

        //another same method
        $job->delete();

        // redirect
        return redirect('/jobs');
    }
}
