<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function send(Session $session, Request $request)
    {
        $message = $session->messages()->create(['content' => $request->body]);
        $message->createForSend($session->id);
        $message->createForReceive($session->id, $request->toUser);
        return response($message, 201);
    }
}
