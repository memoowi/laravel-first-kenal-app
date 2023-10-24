<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    public function index() 
    {
        return $this->postService->getAllPosts();
    }
    public function show($id)
    {
        return $this->postService->getPostById($id);
    }
    public function store(Request $request)
    {
        return $this->postService->storePost($request->all(), $request->file('image'));
    }
    public function update($id, Request $request)
    {
        return $this->postService->updatePost($id, $request->all(), $request->file('image'));
    }
    public function destroy($id)
    {
        return $this->postService->deletePost($id);
    }
}
