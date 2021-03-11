<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public static function showByPost($id)
    {
        return Comment::where('media_id',$id)->get();
    }

    public function parent()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
