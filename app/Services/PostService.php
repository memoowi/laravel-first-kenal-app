<?php
namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPosts()
    {
        return $this->postRepository->getAll();
    }

    // public function getPostById($id)
    // {
    //     return $this->postRepository->getById($id);
    // }

    public function storePost(array $data)
    {
        return $this->postRepository->store($data);
    }

    // public function updatePost($id, array $data)
    // {
    //     return $this->postRepository->update($id, $data);
    // }

    // public function deletePost($id)
    // {
    //     $this->postRepository->delete($id);
    // }
}
