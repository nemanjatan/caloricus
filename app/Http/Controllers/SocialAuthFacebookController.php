<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;
class SocialAuthFacebookController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @param SocialFacebookAccountService $service
     * @return callback URL from facebook
     */
    public function callback(SocialFacebookAccountService $service)
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        // only allow people with @company.com to login
        if(explode("@", $user->email)[1] !== 'company.com'){
            return redirect()->to('/');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
        }
//        return redirect()->to('/home');
//
//        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());
//        auth()->login($user);
//        return redirect()->to('/home');
    }
}