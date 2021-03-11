<?php

namespace App\Http\Controllers\Api\Media;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tutorials\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    public function showComment($id)
    {
        return  CommentResource::collection(Comment::showByPost($id));
    }

    public function store($id)
    {
        try {

            $parentID = $request->parent_id ?? 0;
            $category = Comment::create([
                'media_id' => $request->media_id,
                'body' => $request->body,
                'parent_id'=>$parentID,
            ]);

            return new CommentResource($category);

        } catch(\Exception $exception) {
            return response([
                'status' => 'error',
                'message' => "Error: Comment not created!, please try again. - {$exception->getMessage()}"
            ], 500);
        }
    }
}
