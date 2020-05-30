<?php

namespace App\Http\Controllers;

use App\Events\PrivateChatEvent;
use App\Http\Resources\ChatResource;
use App\Session;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function send(Session $session, Request $request)
    {
        $message = $session->messages()->create(['content' => $request->body]);
        $message->createForSend($session->id);
        $message->createForReceive($session->id, $request->toUser);

        broadcast(new PrivateChatEvent($request->body, $session->id));

        return response($message, 201);
    }

    public function chats(Session $session)
    {
        return ChatResource::collection($session->chats->where('user_id', auth()->id()));
    }

    public function read(Session $session)
    {
        $chats = $session->chats
            ->where('read_at', null)
            ->where('type', 0)
            ->where('user_id', '!=', auth()->id());

        foreach ($chats as $chat) {
            $chat->update(['read_at' => Carbon::now()]);
        }
    }
}
