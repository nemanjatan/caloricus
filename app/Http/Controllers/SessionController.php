<?php

namespace App\Http\Controllers;

use App\Events\SessionEvent;
use App\Http\Resources\SessionResource;
use App\Session;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class SessionController extends Controller
{
    /**
     * Create new Chat Session.
     *
     * @param User $user
     * @return Application|RedirectResponse|Redirector
     */
    public function create(User $user)
    {
        $session = Session::where('user1_id', '=', $user->id)
            ->where('user2_id', '=', auth()->id())->first();

        if (!$session) {
            $session = Session::where('user2_id', '=', $user->id)
                ->where('user1_id', '=', auth()->id())->first();
        }

        if (!$session) {
            $session = Session::firstOrCreate([
                'user1_id' => auth()->id(),
                'user2_id' => $user->id
            ]);
            
            $modifiedSession = new SessionResource($session);

            broadcast(new SessionEvent($modifiedSession, auth()->id()));

            return redirect(route('chat.show', ['user' => $user->id]));
        }

        return redirect(route('chat.show', ['user' => $user->id]));
    }
}
