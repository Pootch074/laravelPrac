<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Post;
use App\Models\User;

Route::get('/', function () {
    return view('home');
});

// Fetch rows in employers and job_listings table
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    return view('jobs.index', [
        'jobs' =>  $jobs
    ]);
});

// Create Job page
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Show clicked job page
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// Adds row to job_listings table
Route::post('/jobs', function () {
    //validation
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
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required', '']
    ]);

    // authorise (on hold....)

    // update the job and persist
    $job = Job::findOrFail($id);

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
});

// Destroy
Route::delete('/jobs/{id}', function ($id) {
    // authorise (on hold....)

    // delete the job
    // $job = Job::findOrFail($id);
    // $job->delete();

    //another same method
    Job::findOrFail($id)->delete();

    // redirect
    return redirect('/jobs');
});










Route::get('/Post', function () {
    return view('posts', [
        'posts' => Post::all()
    ]);
});

Route::get('/User', function () {
    return view('users', [
        'users' => User::all()
    ]);
});

Route::get('contact', function () {
    return view('contact');
});
