<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Post;
use App\Models\User;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->simplePaginate(3);

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
