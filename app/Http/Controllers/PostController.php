<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Traits\ToastrTrait;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use App\Http\Requests\PostRequest;
class PostController extends Controller
{

    use ToastrTrait;

    protected $postRepo;


    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index()
    {
        $posts = $this->postRepo->getAllPosts();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $statuses = PostStatus::cases();
        return view('posts.create', compact('statuses'));
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = auth()->id();

        $post = $this->postRepo->createPost($data);

        if ($post) {
            $this->toastrSuccess('Post created successfully!');
        } else {
            $this->toastrError('Failed to create post. Please try again.');
        }

        return redirect()->route('admin.post.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        $statuses = PostStatus::cases();
        return view('posts.edit', compact('post', 'statuses'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $post = $this->postRepo->updatePost($post, $request->validated());

        if ($post) {
            $this->toastrSuccess('Post updated successfully!');
        } else {
            $this->toastrError('Failed to update post. Please try again.');
        }

        return redirect()->route('admin.post.index');
    }

    public function destroy(Post $post)
    {
        $this->postRepo->deletePost($post);

        $this->toastrSuccess('Post Deleted Successfully');

        return redirect()->route('admin.post.index')->with('success', 'Post deleted successfully!');
    }

    public function filterPosts(PostStatus $status)
    {

        $posts = $this->postRepo->getPostsByStatus($status);

        return view('posts._post-cards', compact('posts'));

    }

    public function guestPosts(Request $request)
    {
        $posts = $this->postRepo->getGuestPosts();

        if ($request->expectsJson()) {
            return view('front-end.dashboard.dashboard', compact('posts'))->render();
        }

        return view('front-end.dashboard.dashboard', compact('posts'));
    }

    public function show(Post $post){
        return view('front-end.posts.show', compact('post'));
    }

}
