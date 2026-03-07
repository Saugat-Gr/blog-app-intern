@extends('layouts.app')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                <div class="card border-0 shadow-lg overflow-hidden">

                    {{-- Header --}}
                    <div class="card-header bg-danger-subtle text-white p-4">

                        <h4 class="mb-0 fw-bold">Edit Post</h4>

                    </div>


                    <div class="card-body p-5">

                        {{-- Author Info --}}
                        <div class="d-flex align-items-center mb-4">

                            <img src="https://i.pravatar.cc/70?u={{ auth()->id() }}" class="rounded-circle me-3 shadow">

                            <div>
                                <h6 class="mb-0 fw-bold">
                                    {{ auth()->user()->name }}
                                </h6>

                                <small class="text-muted">
                                    Editing post
                                </small>
                            </div>

                        </div>


                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form action="{{ route('user.posts.update', [auth()->user(), $post]) }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')


                            {{-- Title --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Post Title
                                </label>

                                <input type="text" name="title" class="form-control form-control-lg"
                                    value="{{ old('title', $post->title) }}" required>

                            </div>


                            {{-- Description --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Short Description
                                </label>

                                <textarea name="description" class="form-control"
                                    rows="3">{{ old('description', $post->description) }}</textarea>

                            </div>


                            {{-- Content --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Post Content
                                </label>

                                <textarea name="content" class="form-control"
                                    rows="8">{{ old('content', $post->content) }}</textarea>

                            </div>


                            {{-- Featured Image --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Featured Image
                                </label>

                                <input type="file" name="featured_image" class="form-control" accept="image/*"
                                    onchange="previewImage(event)">

                                @if($post->featured_image)
                                    <img id="featured-preview" src="{{ asset('storage/' . $post->featured_image) }}"
                                        class="mt-3 rounded shadow" style="max-height:200px;">
                                @else
                                    <img id="featured-preview" class="mt-3 rounded shadow"
                                        style="max-height:200px; display:none;">
                                @endif

                            </div>


                            {{-- Existing Gallery Images --}}
                            @if($post->images && $post->images->count())

                                <div class="mb-4">

                                    <label class="form-label fw-semibold">
                                        Current Gallery Images
                                    </label>

                                    <div class="row g-3">

                                        @foreach($post->images as $image)

                                            <div class="col-md-3">

                                                <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded shadow">

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            @endif


                            {{-- Upload New Images --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Add More Images
                                </label>

                                <input type="file" name="images[]" multiple class="form-control" accept="image/*">

                            </div>


                            {{-- Buttons --}}
                            <div class="d-flex justify-content-between mt-5">

                                <a href="{{ route('dashboard') }}" class="btn btn-dark px-4">

                                    Cancel

                                </a>

                                <button type="submit" class="btn bg-danger-subtle px-5 shadow-sm">

                                    Update Post

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Image Preview Script --}}
    <script>

        function previewImage(event) {
            const preview = document.getElementById('featured-preview');

            preview.src = URL.createObjectURL(event.target.files[0]);

            preview.style.display = "block";
        }

    </script>

@endsection