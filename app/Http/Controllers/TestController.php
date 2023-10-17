<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test($name) {
        $age = 99;
        return view('hello', [
            'name' => $name,
            // 'age' => 20,
            'age' => $age,
        ]);
    }
    public function queryBuilder(){
        $post = DB::table('posts')->get();
        // $post = DB::table('posts')->where('id',11);
        // echo $post->toSql();
        // ddd($post);
        // return $post->get();
        return $post;
    }

    public function eloquent(){
        $post = Post::all();
        // $post = DB::table('posts')->where('id',11);
        // echo $post->toSql();
        return $post;
    }
}
