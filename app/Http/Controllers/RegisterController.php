<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_data = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users', 'email')],
            'password' => ' required|min:6'
        ]);
        $form_data['password'] = bcrypt($form_data['password']);
        $user = User::create($form_data);
        if ($user) {
            auth()->login($user);
          return  redirect('/users')->with('message', 'successfully registered');
        }
    }

}