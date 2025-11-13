<?php

namespace App\Models;

use App\Traits\LikeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Category extends Model
{
    use HasFactory, LikeScope;
    protected $fillable = ['name', 'category_image', 'user_id'];

    protected static function booted()
    {
        static::bootLikeScope();
    } 

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'parent_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likers(){
        return $this->belongsToMany(User::class, 'category_user_likes')->withPivot('type');
    }



}
