<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\User;
use App\Mail\CategoryCreatedMail;
use Illuminate\Support\Facades\Mail;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new CategoryCreatedMail($category));
        }
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
