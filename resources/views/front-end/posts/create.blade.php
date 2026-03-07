@extends('layouts.app')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                <div class="card border-0 shadow-lg overflow-hidden">

                    {{-- Header --}}
                    <div class="card-header text-white bg-danger-subtle p-4">

                        <h4 class="mb-0 fw-bold">Create New Post</h4>

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
                                    A new post
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


                        <form action="{{ route('user.posts.store', auth()->user()) }}" method="POST" enctype="multipart/form-data">

                            @csrf


                            {{-- Title --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Post Title <span class="text-danger">*</span>
                                </label>

                                <input type="text" name="title" class="form-control form-control-lg"
                                    placeholder="Enter your post title" required>

                            </div>


                            {{-- Description --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Short Description <span class="text-danger">*</span>
                                </label>

                                <textarea name="description" class="form-control" rows="3"
                                    placeholder="Short description for preview"></textarea>

                            </div>


                            {{-- Content --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Post Content <span class="text-danger">*</span>
                                </label>

                                <textarea name="content" class="form-control" rows="8" id="editor"
                                    placeholder="Write your post here..."></textarea>

                            </div>


                            {{-- Featured Image --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Featured Image
                                </label>

                                <input type="file" name="featured_image" class="form-control" accept="image/*"
                                    onchange="previewImage(event)">

                                <img id="featured-preview" class="mt-3 rounded shadow"
                                    style="max-height:200px; display:none;">
                            </div>


                            {{-- Additional Images --}}
                            <div class="mb-4">

                                <label class="form-label fw-semibold">
                                    Post Gallery Images 
                                </label>

                                <input type="file" name="images[]" multiple class="form-control" accept="image/*">

                            </div>


                            {{-- Status --}}
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status"
                                    class="form-select form-select-lg @error('status') is-invalid @enderror">
                                    <option disabled selected>Select Status</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->value }}" {{ old('status') == $status->value ? 'selected' : '' }}>
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


                            {{-- Buttons --}}
                            <div class="d-flex justify-content-between mt-5">

                                <a href="{{ route('user.posts', auth()->user()) }}" class="btn btn-dark px-4">

                                    Cancel

                                </a>


                                <button type="submit" class="btn bg-danger-subtle px-5 shadow-sm">

                                    Publish Post

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