@extends('layouts.app')

@section('content')

    <div class="container py-5 shadow-lg rounded ">

        <h2 class="mb-4 text-center">Dashboard Feed</h2>

        <div id="posts-feed" >

            @foreach($posts as $post)
                <div class="card mb-4 shadow-lg rounded">
                    <div class="card-body">

                        {{-- Author & Published Date --}}
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://i.pravatar.cc/40?u={{ $post->author->id }}" class="rounded-circle me-2">
                            <div>
                                <strong>{{ $post->author->name }}</strong>
                                <div class="text-muted small">
                                    {{ $post->published_at?->diffForHumans() }}
                                </div>
                            </div>
                        </div>

                        {{-- Title --}}
                        <h5 class="fw-bold">{{ $post->title }}</h5>

                        {{-- Short Description --}}
                        <p>{{ Str::limit($post->description, 150) }}</p>

                        {{-- Featured Image --}}
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" class="img-fluid rounded mb-3">
                        @endif

                        {{-- Read More / Expand --}}
                        <button class="btn btn-sm btn-outline-primary read-post" data-id="{{ $post->id }}">
                            Read More
                        </button>

                        {{-- Hidden full post content --}}
                        <div class="full-post-content mt-3 d-none">
                            {{ $post->content }}
                            @if($post->images)
                                <div class="row mt-3">
                                    @foreach($post->images as $image)
                                        <div class="col-md-4 mb-2">
                                            <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        {{-- Pagination or Load More --}}
        <div class="text-center mt-4">
            <button id="load-more" class="btn bg-danger-subtle">Load More</button>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        console.log('Hello World');
        document.addEventListener('DOMContentLoaded', function () {

            let page = 2;

            document.addEventListener('click', function (e) {

                // READ MORE
                if (e.target.classList.contains('read-post')) {

                    const card = e.target.closest('.card');
                    const fullContent = card.querySelector('.full-post-content');

                    fullContent.classList.toggle('d-none');

                    e.target.textContent =
                        fullContent.classList.contains('d-none')
                            ? 'Read More'
                            : 'Collapse';
                }

                // LOAD MORE
                if (e.target.id === 'load-more') {

                    console.log("Load more clicked");

                    fetch(`/dashboard?page=${page}`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                        .then(res => res.text())
                        .then(html => {

                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = html;

                            const newPosts = tempDiv.querySelectorAll('.card');
                            const feed = document.getElementById('posts-feed');

                            newPosts.forEach(post => feed.appendChild(post));

                            page++;
                        });

                }

            });

        });
    </script>
@endpush