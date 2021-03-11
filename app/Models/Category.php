<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
         'name','icon','parent_id'
    ];

    public static function parent($id)
    {
        return self::where('parent_id',$id);
    }


    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function tutorial()
    {
        return $this->hasMany('App\Models\Tutorial');
    }
}
