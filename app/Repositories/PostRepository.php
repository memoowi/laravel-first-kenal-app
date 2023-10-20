<?php
namespace App\Repositories;

use App\Helpers\FormatResponse;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        $post = Post::with('comments')->findOrFail($id);
        return FormatResponse::success('Post Found', $post);
    }

    public function store(array $dataPost, $image)
    {
        $messages = [
            'title.required' => 'Title field CANT be empty',
            'content.required' => 'Content field CANT be empty',
            // 'required' => 'CANT be empty',
        ];
        $validator = Validator::make($dataPost, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ], $messages);
        if ($validator->fails())
        {
            return FormatResponse::success('Validation Error', $validator->errors(), false);
        }
        $post = Post::create([
            'title' => $dataPost['title'],
            'content' => $dataPost['content'],
            'slug' => Str::slug($dataPost['title']),
        ]);
        if($image){
            $imagePath = $image->store('images-post');
            $post->update(['image' => $imagePath]);
        }
        return $post;
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
