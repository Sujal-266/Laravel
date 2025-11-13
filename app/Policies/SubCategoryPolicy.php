<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubCategory;

class SubCategoryPolicy
{
    /**
     * Only Admins can create subcategories.
     */
    public function create(User $user)
    {
        return $user->role === 'Admin';
    }

    
    /**
     * Only Admins can update subcategories.
     */
    public function update(User $user, SubCategory $subCategory)
    {
        return $user->role === 'Admin';
    }

    /**
     * Only Admins can delete subcategories.
     */
    public function delete(User $user, SubCategory $subCategory)
    {
        return $user->role === 'Admin';
    }
}
