<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    protected $guarded = [];

    /**
     * Each chat belongs to one message.
     *
     * @return BelongsTo
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
