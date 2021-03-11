<?php

namespace App\Http\Resources\Tutorials;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'tutorial_id'=>$this->tutorial_id,
            'title'=>$this->title,
            'image'=>$this->image,
            'description'=>$this->description,
            'path'=>$this->path,
            'type'=>$this->type,
        ];
    }
}
