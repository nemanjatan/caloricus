<?php

namespace App\Http\Controllers;

use App\Events\PrivateChatEvent;
use App\Http\Resources\ChatResource;
use App\Http\Resources\UserResource;
use App\Session;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $activeChats = $this->get_all_chats();
        return view('chats.index', ['chats' => $activeChats]);
    }

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

    /**
     * Return all chats for currently logged in user.
     *
     * @return mixed
     */
    public function get_all_chats()
    {
        $usersFromSessions = Session::where('user1_id', '=', auth()->id())
            ->orWhere('user2_id', '=', auth()->id())->get()
            ->map(function ($session) {
                if ($session->user1_id == auth()->id()) {
                    return User::find($session->user2_id);
                } else {
                    return User::find($session->user1_id);
                }
            });

        return UserResource::collection($usersFromSessions);
    }
}
