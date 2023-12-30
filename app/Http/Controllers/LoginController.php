<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $form_data = $request->validate([
            'email' => ['required'],
            'password' => 'required', 'min:6'
        ]);
        $auth = auth()->attempt($form_data);
        if ($auth) {
             $request->session()->regenerate();
            if(auth()->user()->role == 'user'){
                return redirect('/users')->with('message', 'successfully login');
            }
           
            return redirect('/admin')->with('message', 'successfully login');
        } else {
            return back()->with('message', 'unsuccessfully login');
        }
    }


}
