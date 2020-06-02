<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $profiles = Profile::where('user_id', '!=', auth()->id())->get();
        return view('profiles.index', ['profiles' => $profiles]);
    }

    /**
     * Display the specified resource.
     *
     * @param Profile $profile
     * @return Response
     */
    public function show(Profile $profile)
    {
        return view('profiles.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Profile $profile
     * @return Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Profile $profile
     * @return Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }
}
