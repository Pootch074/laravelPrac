<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Models\Post;
use App\Models\User;

Route::get('/', function () {
    return view('home');
});


Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' =>  Job::all()
    ]);
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






Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('job', ['job' => $job]);
});

Route::get('contact', function () {
    return view('contact');
});
