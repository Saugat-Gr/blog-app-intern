@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="bg-danger-subtle border-bottom border-danger-subtle p-4">
                    <h5 class="text-uppercase text-muted small mb-1">
                        Post Management
                    </h5>
                    <h2 class="fw-bold mb-0">
                        Edit Post
                    </h2>
                </div>

                {{-- Body --}}
                <div class="card-body p-5">

                    <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" 
                                value="{{ old('title', $post->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug (optional)</label>
                            <input type="text" name="slug" id="slug" class="form-control" 
                                value="{{ old('slug', $post->slug) }}">
                            <small class="text-muted">If empty, it will auto-generate from the title.</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Post Description</label>
                            <textarea name="description" id="editor" class="form-control" rows="5">{{ old('description', $post->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Content --}}
                        <div class="mb-3">
                            <label for="content" class="form-label">Post Content</label>
                            <textarea name="content" id="content-editor" class="form-control" rows="8" required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Existing Images --}}
                        @if($post->images && count($post->images))
                        <div class="mb-3">
                            <label class="form-label">Current Images</label>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($post->images as $image)
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/' . $image) }}" alt="image" class="img-thumbnail" width="100">
                                        {{-- Optional: Add checkbox to remove --}}
                                        <input type="checkbox" name="remove_images[]" value="{{ $image }}" class="form-check-input position-absolute top-0 end-0">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- Upload New Images --}}
                        <div class="mb-3">
                            <label for="images" class="form-label">Upload New Images</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Featured Image --}}
                        <div class="mb-3">
                            <label for="featured_image" class="form-label">Featured Image</label>
                            <input type="file" name="featured_image" id="featured_image" class="form-control">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="featured" class="img-thumbnail mt-2" width="120">
                            @endif
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                         <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                              <select name="status"
                                    class="form-select form-select-lg @error('status') is-invalid @enderror">
                                <option disabled selected>Select Status</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->value }}"
                                        {{ old('status') == $status->value ? 'selected' : '' }}>
                                        {{ ucfirst($status->value) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Published At --}}
                        <div class="mb-3">
                            <label for="published_at" class="form-label">Publish Date</label>
                            <input type="date" name="published_at" id="published_at" class="form-control" 
                                value="{{ old('published_at', $post->published_at?->format('Y-m-d')) }}">
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('admin.post.index') }}"
                               class="btn btn-outline-dark px-4">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn bg-danger-subtle px-4 shadow-sm">
                               Update Post
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection