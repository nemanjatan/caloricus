<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            if ( !$article->user_id ) {
                $article->user_id = Auth::id();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPublished()
    {
        return $this->is_published;
    }
}
