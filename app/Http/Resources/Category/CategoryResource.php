<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'parent_id'=> $this->parent_id,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'children'=>$this->children,
            'tutorial'=>$this->tutorial,

        ];
    }
}
