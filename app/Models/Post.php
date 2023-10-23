<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'slug',
        'created_at',
        'updated_at',
    ];
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($post) {
            if(!empty($post->image)){
                Storage::delete($post->image);
            }
            $post->comments()->delete();
        });
    }
}
