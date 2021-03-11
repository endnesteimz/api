<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id','title','parent_id'
    ];

    public function children()
    {
        return $this->hasMany(Tutorial::class, 'parent_id');
    }

    public function mediaList()
    {
        return $this->hasMany('App\Models\Media');
    }
}
