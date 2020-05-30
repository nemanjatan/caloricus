<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function createForSend($sessionId)
    {
        $this->chats()->create([
            'session_id' => $sessionId,
            'type' => 0,
            'user_id' => auth()->id()
        ]);
    }

    public function createForReceive($sessionId, $toUser)
    {
        $this->chats()->create([
            'session_id' => $sessionId,
            'type' => 1,
            'user_id' => $toUser
        ]);
    }
}
