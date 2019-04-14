<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;

class ProfileController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  $username Username profile
     * @return \Illuminate\Http\Response
     */
    public function show($username=null)
    {
        if ($username === null) {
            $user = \Auth::user();
        } else {
            $user = User::where('username', $username)->firstOrFail();
        }

        return view('profile.show')->with('user', $user);
    }

    /**
     * Display form profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_profile_form()
    {
        $user = \Auth::user();
        return view('profile.show_profile_form')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $job)
    {
        $profile = \Auth::user()->profile;
        $this->saveData($profile, $request);
        return redirect()->route('profile');
    }

    private function saveData($profile, Request $request)
    {
        $profile->location = $request->input('location');
        $profile->content = $request->input('content');
        $profile->website = $request->input('website');
        $profile->save();
    }
}
