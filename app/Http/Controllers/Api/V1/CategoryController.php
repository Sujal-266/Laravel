<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Traits\ApiResponse;
use App\Traits\ErrorManager;
use App\Traits\FileManager;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CommentRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class CategoryController extends Controller

{
    use ApiResponse, FileManager, AuthorizesRequests;
    public function index(Request $request)
    {
        $query = Category::with(['SubCategories', 'user']);

        // Filter by user_id
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        // Searching
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhereHas('SubCategories', function ($subQ) use ($search) {
                      $subQ->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('user', function ($userQ) use ($search) {
                      $userQ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                  });
            });
        }

        // Sorting
        $sortField = $request->input('sort_field', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $validSortFields = ['id', 'name', 'user_id'];
        if (in_array($sortField, $validSortFields)) {
            $query->orderBy($sortField, $sortOrder);
        } else {
            $query->orderBy('id', 'desc');
        }

        $categories = $query->paginate(5);
        return $this->successResponse($categories, __('messages.categories_fetched_successfully'));
    }



    public function store(CategoryRequest $request)
    {
    $this->authorize('create', Category::class);
        $data = $request->validated();
        if ($request->hasFile('category_image')) {
            $filePath = $this->saveFile($request->file('category_image'), 'categories');
            $data['category_image'] = Storage::url($filePath);
        }
        $data['user_id'] = $request->user()->id;
        $category = Category::create($data);
        return $this->successResponse($category, __('messages.category_created'), 201);
    }

    public function show($id)
    {
        $category = Category::with(['SubCategories', 'likers'])->findOrFail($id);
        $user = auth()->user();
        $is_liked = false;
        $is_disliked = false;
        if ($user) {
            $pivot = $category->likers->where('id', $user->id)->first();
            if ($pivot && $pivot->pivot->type === 'like') {
                $is_liked = true;
            } elseif ($pivot && $pivot->pivot->type === 'dislike') {
                $is_disliked = true;
            }
        }
        return $this->successResponse([
            'category' => $category,
            'likes_count' => $category->likers->where('pivot.type', 'like')->count(),
            'dislikes_count' => $category->likers->where('pivot.type', 'dislike')->count(),
            'is_liked' => $is_liked,
            'is_disliked' => $is_disliked,
        ], __('messages.category_fetched_successfully'), 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $this->authorize('update', $category);
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'category_image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updated = false;

        if ($request->filled('name') && $request->name !== $category->name) {
            $category->name = $request->name;
            $updated = true;
        }

        if ($request->hasFile('category_image')) {
            // Remove /storage/ prefix to get the relative path for deletion
            $oldPath = $category->category_image ? str_replace('/storage/', '', $category->category_image) : null;
            $filePath = $this->replaceFile($oldPath, $request->file('category_image'), 'categories');
            $category->category_image = Storage::url($filePath);
            $updated = true;
        }

        if (!$updated) {
            return $this->errorResponse(__('messages.nothing_to_update'), 400);
        }

        $category->save();

        return $this->successResponse($category, __('messages.category_updated'), 200);
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        $this->authorize('delete', $category);
        $category->delete();
        return $this->successResponse(null, __('messages.category_deleted'));
    }

    // Like a category (polymorphic)
    public function like($id)
    {
        $user = Auth::user();
        if (!$user) {
            return $this->errorResponse('Unauthorized', 401);
        }
        $category = Category::findOrFail($id);
        $this->authorize('like', $category);

        $category->likes()->where('user_id', $user->id)->where('type', 'dislike')->delete();

        $like = $category->likes()->where('user_id', $user->id)->where('type', 'like')->first();
        if (!$like) {
            $category->likes()->create([
                'user_id' => $user->id,
                'type' => 'like',
            ]);
        }

        $likesCount = $category->likes()->where('type', 'like')->count();
        $dislikesCount = $category->likes()->where('type', 'dislike')->count();
        $isLiked = $category->likes()->where('user_id', $user->id)->where('type', 'like')->exists();
        $isDisliked = $category->likes()->where('user_id', $user->id)->where('type', 'dislike')->exists();

        return $this->successResponse([
            'id' => $category->id,
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'is_liked' => $isLiked,
            'is_disliked' => $isDisliked,
        ], __('messages.category_liked_successfully'), 200);
    }

    // Dislike a category (polymorphic)
    public function dislike($id)
    {
        $user = Auth::user();
        if (!$user) {
            return $this->errorResponse('Unauthorized', 401);
        }
        $category = Category::findOrFail($id);
        $this->authorize('dislike', $category);

        $category->likes()->where('user_id', $user->id)->where('type', 'like')->delete();

        $dislike = $category->likes()->where('user_id', $user->id)->where('type', 'dislike')->first();
        if (!$dislike) {
            $category->likes()->create([
                'user_id' => $user->id,
                'type' => 'dislike',
            ]);
        }

        $likesCount = $category->likes()->where('type', 'like')->count();
        $dislikesCount = $category->likes()->where('type', 'dislike')->count();
        $isLiked = $category->likes()->where('user_id', $user->id)->where('type', 'like')->exists();
        $isDisliked = $category->likes()->where('user_id', $user->id)->where('type', 'dislike')->exists();

        return $this->successResponse([
            'id' => $category->id,
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
            'is_liked' => $isLiked,
            'is_disliked' => $isDisliked,
        ], __('messages.category_disliked_successfully'), 200);
    }

    public function comment($id, CommentRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return $this->errorResponse('Unauthorized', 401);
        }
        $category = Category::findOrFail($id);
        $this->authorize('comment', $category);

        $validated = $request->validated();
        $comment = Comment::create([
            'user_id' => $user->id,
            'commentable_id' => $category->id,
            'commentable_type' => Category::class,
            'content' => $validated['content'],
        ]);

        return $this->successResponse($comment, __('messages.comment_added_successfully'), 201);

    }

    // Test error logging
    public function testErrorLog(){
        ErrorManager::registerError(
            'Test error message',
            __FILE__,
            __LINE__,
            __FILE__
        );
        return $this->successResponse(null, 'Test error logged successfully');
    }
}
