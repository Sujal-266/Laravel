<?php

namespace App\Models;

use App\Traits\LikeScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['parent_category_id', 'name', 'sub_category_image'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

}

