@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                {{-- Header --}}
                <div class="bg-danger-subtle border-bottom border-danger-subtle p-4">
                    <h5 class="text-uppercase text-muted small mb-1">Post Management</h5>
                    <h2 class="fw-bold mb-0">Create New Post</h2>
                </div>

                {{-- Body --}}
                <div class="card-body p-5">

                    <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug (optional)</label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror"
                                value="{{ old('slug') }}">
                            <small class="text-muted">If empty, it will auto-generate from the title.</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Short Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Content (rich text) --}}
                        <div class="mb-3">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="editor" class="form-control @error('content') is-invalid @enderror"
                                rows="7" >{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Featured Image --}}
                        <div class="mb-3">
                            <label for="featured_image" class="form-label">Featured Image</label>
                            <input type="file" name="featured_image" id="featured_image" 
                                class="form-control @error('featured_image') is-invalid @enderror">
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Multiple Images --}}
                        <div class="mb-3">
                            <label for="images" class="form-label">Additional Images</label>
                            <input type="file" name="images[]" id="images" multiple
                                class="form-control @error('images.*') is-invalid @enderror">
                            @error('images.*')
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
                            <input type="date" name="published_at" id="published_at"
                                class="form-control @error('published_at') is-invalid @enderror"
                                value="{{ old('published_at') }}">
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                         <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('admin.post.index') }}"
                               class="btn btn-outline-dark px-4">
                                Cancel
                            </a>

                            <button type="submit"
                                    class="btn bg-danger-subtle px-4 shadow-sm">
                               Create Post
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>



@endsection