<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
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
        'parent_category_id' => $this->parent_category_id,
        'name' => $this->name,
        'category' => new CategoryResource($this->whenLoaded('category')),
    ];
}

}
