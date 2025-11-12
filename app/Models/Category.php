<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_image', 'user_id', 'likes', 'dislikes'];

    protected static function booted()
    {
        static::addGlobalScope('is_liked', function ($query) {
            $user = auth()->user();
            if ($user) {
                $query->withExists(['likers as is_liked' => function ($q) use ($user) {
                    $q->where('users.id', $user->id);
                }]);
            }
        });
    } 

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'parent_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

        // Scopes
    public function scopePopular($query)
    {
        return $query->where('likes', '>', 'dislikes');
    }

    public function scopeLiked($query)
    {
        return $query->where('likes', '>', 0);
    }

    public function scopeDisliked($query)
    {
        return $query->where('dislikes', '>', 0);
    }

    // Accessors
    public function getIsLikedAttribute()
    {
        return $this->likes > $this->dislikes;
    }

    public function getIsDislikedAttribute()
    {
        return $this->dislikes > $this->likes;
    }

    public function likers(){
        return $this->belongsToMany(User::class, 'category_user_likes');
    }


}
