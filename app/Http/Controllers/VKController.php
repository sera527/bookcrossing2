<?php

namespace Bookcrossing\Http\Controllers;

use Illuminate\Http\Request;

use Bookcrossing\Http\Requests;

class VKController extends Controller
{
    public function auth()
    {
        return view('auth');
    }

    public function logIn(Request $request)
    {
        session()->regenerate();
        $request->session()->put('VKusr', $request->input('VKname'));
        return redirect('/');
    }

    public function logOut()
    {
        session()->flush();
        session()->regenerate();
        return redirect('auth');
    }
}
