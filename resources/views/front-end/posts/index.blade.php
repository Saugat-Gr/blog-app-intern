@extends('layouts.app')

@section('content')

<div class="container py-5">

    {{-- User Profile Header --}}
    <div class="card border-0 shadow-lg mb-5 overflow-hidden">

        <div class="card-body d-flex align-items-center p-4">

            <img src="https://i.pravatar.cc/100?u={{ $user->id }}"
                 class="rounded-circle shadow me-4"
                 style="border:4px solid white;">

            <div>

                <h3 class="fw-bold mb-1">
                    {{ $user->name }}
                </h3>

                <p class="text-muted mb-1">
                    {{ $user->email }}
                </p>

                <span class="badge bg-dark-subtle text-dark">
                    {{ $posts->count() }} Posts
                </span>

            </div>

        </div>

    </div>


    {{-- Section Title --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="fw-bold">Your Posts</h4>

        @if($posts->count() > 0)

        <a href="{{ route('user.posts.create') }}"
           class="btn bg-danger-subtle shadow-sm">
            Create Post
        </a>

        @endif

    </div>


    {{-- Posts Grid --}}
    <div class="row g-4">

        @forelse($posts as $post)

        <div class="col-lg-4 col-md-6">

            <div class="card post-card border-0 shadow-sm h-100">

                {{-- Featured Image --}}
                @if($post->featured_image)
                <img src="{{ asset('storage/'.$post->featured_image) }}"
                     class="card-img-top post-image">
                @endif


                <div class="card-body">

                    {{-- Status Badge --}}
                    <span class="badge
                        {{ $post->status == \App\Enums\PostStatus::PUBLISHED ? 'bg-success' : 'bg-warning text-dark' }}">
                        {{ ($post->status) }}
                    </span>


                    {{-- Title --}}
                    <h5 class="fw-bold mt-2">
                        {{ $post->title }}
                    </h5>


                    {{-- Description --}}
                    <p class="text-muted small">
                        {{ Str::limit($post->description, 120) }}
                    </p>


                    {{-- Date --}}
                    <small class="text-muted">
                        {{ $post->created_at->diffForHumans() }}
                    </small>

                </div>


                {{-- Actions --}}
                <div class="card-footer bg-white border-0 d-flex justify-content-between">

                    <a href="{{ route('posts.show', $post->slug) }}"
                       class="btn btn-sm btn-outline-dark">
                        View
                    </a>

                    <a href="{{ route('user.posts.edit', [$user, $post]) }}"
                       class="btn btn-sm btn-outline-primary">
                        Edit
                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">

            <div class="text-center py-5">

                <h5 class="text-muted">No posts created yet</h5>

                <a href="{{ route('user.posts.create') }}"
                   class="btn bg-danger-subtle mt-3">
                   Create your first post
                </a>

            </div>

        </div>

        @endforelse

    </div>

</div>


{{-- Premium Styling --}}
<style>

.post-card{
    transition: all .25s ease;
}

.post-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.15);
}

.post-image{
    height:200px;
    object-fit:cover;
}

</style>

@endsection