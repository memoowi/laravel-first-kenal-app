<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content'
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
