<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\CategoryRequest;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
{
    return [
        'id' => $this->id,
        'name' => $this->name,
        'sub_categories' => SubCategoryResource::collection($this->whenLoaded('subCategories')),
        'created_at' => $this->created_at,
    ];
}

}
