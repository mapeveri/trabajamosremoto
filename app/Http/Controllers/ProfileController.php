<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = \Auth::user();
        return view('profile.show')->with('user', $user);
    }
}
