<?php
namespace App\Repositories;

use App\Helpers\FormatResponse;
use App\Models\Post;
use Illuminate\Support\Str;

class PostRepository
{
    public function getAll()
    {
        $message = 'Welcome to Post API';
        $posts = Post::with('comments')->get();
        return FormatResponse::success($message, $posts);
    }

    // public function getById($id)
    // {
    //     return Post::find($id);
    // }

    public function store(array $dataPost)
    {
        return Post::create([
            'title' => $dataPost['title'],
            'content' => $dataPost['content'],
            'slug' => Str::slug($dataPost['title']),
            // 'image' => $dataPost['image'],
        ]);
    }

    // public function update($id, array $data)
    // {
    //     $post = Post::find($id);
    //     $post->update($data);
    //     return $post;
    // }

    // public function delete($id)
    // {
    //     $post = Post::find($id);
    //     $post->delete();
    // }
}
