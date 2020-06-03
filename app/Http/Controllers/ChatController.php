<?php

namespace App\Http\Controllers;

use App\Events\PrivateChatEvent;
use App\Http\Resources\ChatResource;
use App\Session;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->get_all_chats();
        return view('chats.index', ['users' => $users]);
    }

    /**
     * Return chat for specific users (A and B).
     * If the chat does not exist, then return 404 page.
     *
     * @param User $user
     * @return Redirector|View
     */
    public function show(User $user)
    {
        $session = Session::where('user2_id', '=', $user->id)->where('user1_id', '=', auth()->id())->first();

        if (!$session) {
            $session = Session::where('user1_id', '=', $user->id)->where('user2_id', '=', auth()->id())->first();
        }

        if ($session) {
            $userName = User::where('id', '=', $user->id)->pluck('name')->first();
            return view('chats.show', ['session' => $session, 'userName' => $userName, 'userId' => $user->id]);
        }

        return redirect(404);
    }

    /**
     * Send new message.
     *
     * @param Session $session
     * @param Request $request
     * @return Response
     */
    public function send(Session $session, Request $request)
    {
        $message = $session->messages()->create(['content' => $request->body]);
        $message->createForSend($session->id);
        $message->createForReceive($session->id, $request->toUser);

        broadcast(new PrivateChatEvent($request->body, $session->id));

        return response($message, 201);
    }

    /**
     * Get all chats for specific Chat Session.
     *
     * @param Session $session
     * @return AnonymousResourceCollection
     */
    public function chats(Session $session)
    {
        return ChatResource::collection(
            $session->chats
                ->where('user_id', auth()->id())
                ->sortByDesc('id')
                ->take(50)
                ->sortBy('id')
        );
    }

    /**
     * Mark message as read.
     *
     * @param Session $session
     */
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
        return Session::where('user1_id', '=', auth()->id())
            ->orWhere('user2_id', '=', auth()->id())->get()
            ->reject(function ($session) {
                return count($session->messages) == 0;
            })
            ->map(function ($session) {
                if ($session->user1_id == auth()->id()) {
                    return User::find($session->user2_id);
                } else {
                    return User::find($session->user1_id);
                }
            });
    }
}
