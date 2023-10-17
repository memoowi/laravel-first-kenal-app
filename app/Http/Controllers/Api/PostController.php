<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'message' => 'Welcome to Post API',
            'data' => Post::with('comments')->get(),
        ]);
    }
}
