<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Session extends Model
{
    protected $guarded = [];

    /**
     * Chats that belongs to current Chat Session.
     *
     * @return HasManyThrough
     */
    public function chats()
    {
        return $this->hasManyThrough(Chat::class, Message::class);
    }

    /**
     * Messages that belongs to current Chat Session.
     *
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
