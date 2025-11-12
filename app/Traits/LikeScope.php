<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait LikeScope
{
    // Scope for popular (more likes than dislikes)
    public function scopePopular($query)
    {
        return $query->where('likes', '>', 'dislikes');
    }

    // Scope for liked (at least one like)
    public function scopeLiked($query)
    {
        return $query->where('likes', '>', 0);
    }

    // Scope for disliked (at least one dislike)
    public function scopeDisliked($query)
    {
        return $query->where('dislikes', '>', 0);
    }

    // Global scope for is_liked by current user
    protected static function bootLikeScope()
    {
        static::addGlobalScope('is_liked', function ($query) {
            $user = Auth::user();
            if ($user) {
                $query->withExists(['likers as is_liked' => function ($q) use ($user) {
                    $q->where('users.id', $user->id);
                }]);
            }
        });
    }
}
