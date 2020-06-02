<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    /**
     * Automatically assign currently assigned user to author field for Article that is being created.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            if ( !$article->user_id ) {
                $article->user_id = Auth::id();
            }
        });
    }

    /**
     * Use slug instead of id when creating URL.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Each article belongs to one user.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Method for checking if the Article is published.
     *
     * @return mixed
     */
    public function isPublished()
    {
        return $this->is_published;
    }
}
