<?php

namespace App\Models;

use App\Traits\LikeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory,LikeScope;
    protected $fillable = ['parent_category_id', 'name', 'sub_category_image'];

    protected static function booted()
    {
        static::bootLikeScope();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    public function likers()
    {
        return $this->belongsToMany(User::class, 'sub_category_user_likes');
    }
}

