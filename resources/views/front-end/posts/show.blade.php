@extends('layouts.app')

@section('content')

<div class="container  bg-white border-0 shadow-lg rounded   p-5">

    {{-- Post Header --}}
    <div class="mb-5 bg-danger-subtle text-secondary-subtle p-4 rounded">

        <h1 class="fw-bold display-5">
            {{ $post->title }}
        </h1>

        <div class="d-flex align-items-center mt-3">

            <img src="https://i.pravatar.cc/50?u={{ $post->author->id }}"
                 class="rounded-circle me-3">

            <div>

                <strong>{{ $post->author->name }}</strong>

                <div class="text-muted small">
                    {{ $post->created_at->format('M d, Y') }}
                    • {{ $post->created_at->diffForHumans() }}
                </div>

            </div>

        </div>

    </div>


    {{-- Featured Image --}}
    @if($post->featured_image)

    <div class="mb-5 text-center">

        <img src="{{ asset('storage/'.$post->featured_image) }}"
             class="img-fluid rounded shadow-lg">

    </div>

    @endif


    {{-- Post Content --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-5">

            <div class="post-content">

                {!! $post->content !!}

            </div>

        </div>

    </div>


    {{-- Gallery Images --}}
    @if($post->images)

    <div class="mt-5">

        <h4 class="fw-bold mb-4">Gallery</h4>

        <div class="row g-4">

            @foreach($post->images as $image)

            <div class="col-md-4">

                <img src="{{ asset('storage/'.$image->path) }}"
                     class="img-fluid rounded shadow">

            </div>

            @endforeach

        </div>

    </div>

    @endif


    {{-- Back Button --}}
    <div class="mt-5">

        <a href="{{ route('user.posts', auth()->user()) }}"
           class="btn btn-outline-dark">

            ← Back to Feed

        </a>

    </div>

</div>


<style>

.post-content{
    font-size: 1.1rem;
    line-height: 1.8;
}

.post-content p{
    margin-bottom: 1.2rem;
}

.post-content img{
    max-width:100%;
    border-radius:10px;
    margin:20px 0;
}

</style>

@endsection