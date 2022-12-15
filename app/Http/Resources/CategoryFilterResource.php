<?php

namespace App\Http\Resources;

use App\Models\Specification;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryFilterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'count' => $this->count,
        ];
    }
}