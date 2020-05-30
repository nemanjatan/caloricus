<?php

namespace App\Http\Controllers;

use App\Events\SessionEvent;
use App\Http\Resources\SessionResource;
use App\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create(Request $request)
    {
        $session = Session::create([
            'user1_id' => auth()->id(),
            'user2_id' => $request->chat_id
        ]);

        $modifiedSession = new SessionResource($session);

        broadcast(new SessionEvent($modifiedSession, auth()->id()));

        return $modifiedSession;
    }
}
