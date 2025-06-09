<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Password;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        // validate
        $attributes = request()->validate([
            'first_name'        => ['required'],
            'last_name'         => ['required'],
            'email'             => ['required', 'email'],
            'password'          => ['required', Password::min(6), 'confirmed']
        ]);

        // create the user
        $user = User::create($attributes);

        // login
        Auth::login($user);

        // redirect somewhere
        return redirect('/jobs');
    }
}
