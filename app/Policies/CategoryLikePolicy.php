<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryLikePolicy
{
    /**
     * User must be logged in to like/dislike a category.
     */
    public function like(User $user, Category $category)
    {
        return $user !== null;
    }

    public function dislike(User $user, Category $category)
    {
        return $user !== null;
    }
}
