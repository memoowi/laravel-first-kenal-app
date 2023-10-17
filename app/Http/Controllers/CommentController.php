<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $post = Post::with('comments')->get();
        return $post;
    }
    public function store(Request $request){
        Comment::create([
            'post_id' => $request->post_id,
            'comment' => $request->comment

        ]);
        return redirect()->back()->with('ok','Comment Added !');
    } 
}
