<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Post;
use App\Models\User;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Traits\ToastrTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ToastrTrait;

    protected $userRepo, $postRepo;

    public function __construct(UserRepositoryInterface $userRepo, PostRepositoryInterface $postRepository)
    {
        $this->userRepo = $userRepo;
        $this->postRepo = $postRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->userRepo->showAllUsers();

        return view('front-end.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('front-end.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
         $validated_data = $request->validated();

         $updatedUser = $this->userRepo->updateUser($user, $validated_data);
         
         if($updatedUser){
            $this->toastrSuccess('Your profile has been updated successfully!');
         } else {
            $this->toastrError('Failed to update your profile. Please try again.');
         }

         return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showUserPosts(User $user)
    {
        $posts = $this->postRepo->getPostByUser($user);

        return view('front-end.posts.index', compact('posts', 'user'));
    }

    public function createPost(){
        $statuses = PostStatus::cases();
        return view('front-end.posts.create', compact('statuses'));
    }

    public function storePost(PostRequest $request, User $user)
    {
        $validated_data = $request->validated();

        $validated_data['author_id'] = $user->id;

        $post = $this->postRepo->createPost($validated_data);

        if ($post) {
            $this->toastrSuccess('Post created successfully!');
        } else {
            $this->toastrError('Failed to create post. Please try again.');
        }

        return redirect()->route('user.posts', auth()->user());
    }

    public function editPost( User $user, Post $post){
              $statuses = PostStatus::cases();
              return view('front-end.posts.edit', compact('post', 'statuses'));
    }
}
