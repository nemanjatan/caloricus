<?php

namespace App\Http\Controllers;

use App\Events\SessionEvent;
use App\Http\Resources\SessionResource;
use App\Session;
use App\User;

class SessionController extends Controller
{
    public function create(User $user)
    {
        $sessionExist = Session::where('user1_id', '=', $user->id)
            ->where('user2_id', '=', auth()->id())->first();

        if (!$sessionExist) {
            $session = Session::firstOrCreate([
                'user1_id' => auth()->id(),
                'user2_id' => $user->id
            ]);

            $modifiedSession = new SessionResource($session);

            broadcast(new SessionEvent($modifiedSession, auth()->id()));

            return redirect(route('chats.index'));
        }

        return redirect(route('chats.index'));
    }
}
