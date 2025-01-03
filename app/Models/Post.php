<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category_id', 'image'];
    public function comments()
{
    return $this->hasMany(Comment::class)->where('approved', true);
}
public function likes()
{
    return $this->hasMany(Like::class);
}
public function category()
{
    return $this->belongsTo(Category::class);
}

    //
}
