<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy{
    /**
     * Any logged-in user can like a category.
     */
    public function like(User $user, Category $category)
    {
        return $user !== null;
    }

    /**
     * Any logged-in user can dislike a category.
     */
    public function dislike(User $user, Category $category)
    {
        return $user !== null;
    }

    /**
     * Any logged-in user can comment on a category.
     */
    public function comment(User $user, Category $category)
    {
        return $user !== null;
    }

    /**
     * Only Admins can create categories.
     */
    public function create(User $user)
    {
        return $user->role === 'Admin';
    }

    /**
     * Only Admins can update categories.
     */
    public function update(User $user, Category $category)
    {
        return $user->role === 'Admin';
    }

    /**
     * Only Admins can delete categories.
     */
    public function delete(User $user, Category $category)
    {
        return $user->role === 'Admin';
    }


}

