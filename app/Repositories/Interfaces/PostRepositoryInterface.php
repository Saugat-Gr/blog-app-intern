<?php

namespace App\Repositories\Interfaces;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\User;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function getPostByUser(User $user);
    public function createPost(array $data);
    public function updatePost(Post $post, array $data);
    public function deletePost(Post $post);
    public function getPostsByStatus(PostStatus $status);
    public function getGuestPosts(int $limit=5);

}
