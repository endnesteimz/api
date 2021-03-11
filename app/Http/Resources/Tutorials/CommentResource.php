<?php

namespace App\Http\Resources\Tutorials;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'media_id'=>$this->media_id,
            'body'=>$this->body,
            'parent_id'=>$this->parent_id,
            'parent'=>$this->parent
        ];
    }
}
