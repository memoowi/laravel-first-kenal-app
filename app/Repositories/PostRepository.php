<?php
namespace App\Repositories;

use App\Helpers\FormatResponse;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostRepository
{
    public function getAll()
    {
        $message = 'Welcome to Post API';
        $posts = Post::with('comments')->get()
        -> map(function ($posts) {
            return [
                'id' => $posts->id,
                'title' => $posts->title,
                'content' => $posts->content,
                'posted_on' => date("l, d F Y", strtotime($posts->created_at)),
                'updated_at' => $posts->updated_at,
            ];
        });

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

    public function update($id, array $data, $image)
    {
        $post = Post::find($id);
        if($post)
        {
            $post->update([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
            ]);
            if($image)
            {
                if(!empty($post->image)){
                    Storage::delete($post->image);
                }
                $imagePath = $image->store('images-post');
                $post->update(['image' => $imagePath]);
            }
            return FormatResponse::success('Post Updated', $post);
        }
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        // $post->comments()->delete();
        // if(!empty($post->image)){
        //     Storage::delete($post->image);
        // }
        $post->delete();
        return response()->json([
            'status' => true,
            'message' => 'Post Deleted',
        ]);
    }
}
