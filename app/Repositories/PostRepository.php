<?php
namespace App\Repositories;

use App\Helpers\FormatResponse;
use App\Models\Post;

class PostRepository
{
    public function getAll()
    {
        $message = 'Welcome to Post API';
        $posts = Post::with('comments')->get();
        return FormatResponse::success($message, $posts);
    }

    public function getById($id)
    {
        return Post::find($id);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update($id, array $data)
    {
        $post = Post::find($id);
        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
    }
}
