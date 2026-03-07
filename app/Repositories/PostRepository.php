<?php

namespace App\Repositories;

use App\Enums\PostStatus;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Models\User;


class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::with('author')->latest()->get();
    }

    public function getPostByUser(User $user)
    {
        return Post::with('author')->where('author_id', $user->id)->get();
    }

    public function createPost(array $data)
    {
        return Post::create($data);
    }

    public function updatePost(Post $post, array $data)
    {
        return $post->update($data);
    }

    public function deletePost(Post $post): bool
    {
        return $post->delete();
    }

    public function getPostsByStatus(PostStatus $status)
    {
        return Post::where('status', $status)->with('author')->latest()->get();
    }

    public function getGuestPosts(int $limit = 5)
    {
        return Post::with('author')->
        latest()->paginate($limit);
    }
}