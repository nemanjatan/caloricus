<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    protected $guarded = [];

    /**
     * Each Message can belongs to 2 Chats.
     * One for the user who sent a message, and one for the user who will receive the message.
     *
     * @return HasMany
     */
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    /**
     * Method for creating the Chat for the user who sent a message.
     *
     * @param $sessionId
     */
    public function createForSend($sessionId)
    {
        $this->chats()->create([
            'session_id' => $sessionId,
            'type' => 0,
            'user_id' => auth()->id()
        ]);
    }

    /**
     * Method for creating the Chat for the user who will receive the message.
     *
     * @param $sessionId
     * @param $toUser
     */
    public function createForReceive($sessionId, $toUser)
    {
        $this->chats()->create([
            'session_id' => $sessionId,
            'type' => 1,
            'user_id' => $toUser
        ]);
    }
}
