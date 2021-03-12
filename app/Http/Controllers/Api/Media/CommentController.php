<?php

namespace App\Http\Controllers\Api\Media;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tutorials\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    public function showComment($id)
    {
        if (Comment::showByPost($id)) {
            return ResponseFormatter::success(
                Comment::showByPost($id),
                ''
            );
        }else {
            return ResponseFormatter::error(
                null,
                'Not data',
                '200'
            );
        }

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

            return ResponseFormatter::success(
                $category,
                '',
            );

        } catch(\Exception $exception) {
            return response([
                'status' => 'error',
                'message' => "Error: Comment not created!, please try again. - {$exception->getMessage()}"
            ], 500);
        }
    }
}
