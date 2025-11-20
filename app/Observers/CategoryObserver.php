<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\User;
use App\Mail\CategoryCreatedMail;
use App\Traits\ErrorManager;
use Illuminate\Support\Facades\Mail;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        \Log::info('Observer debug', [
            'category_id' => $category->id,
            'category_exists' => Category::find($category->id) !== null
        ]);
        $users = User::all();
        foreach ($users as $user) {
            try {
                Mail::to($user->email)->queue((new CategoryCreatedMail($category->id))->afterCommit());
            } catch (\Throwable $th) {
                ErrorManager::registerError(
                    $th->getMessage(),
                    __FILE__,
                    $th->getLine(),
                    $th->getFile()
                );
            }
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
