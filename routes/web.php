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

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

// Adds row to job_listings table
Route::post('/jobs', function () {
    //validation

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);
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
