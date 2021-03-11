<?php

namespace App\Http\Resources\Tutorials;

use Illuminate\Http\Resources\Json\JsonResource;

class TutorialResource extends JsonResource
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
            'id'=>$this->id,
            'category_id'=>$this->category_id,
            'title'=>$this->title,
            'children'=>$this->children,
            'medialist'=>$this->mediaList,
        ];
    }
}
