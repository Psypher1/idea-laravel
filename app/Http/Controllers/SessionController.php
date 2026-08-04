<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.signin');
    }

    public function store(Request $request)
    {

        $attributes = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:6', 'max:255'],
        ]);

        if (! Auth::attempt($attributes)) {
            // return redirect()->back();
            return back()
                ->withErrors(['password' => 'We were unable to authenticate the provided credentials'])
                ->withInput();
        }

        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'We are glad to have you!');

    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
