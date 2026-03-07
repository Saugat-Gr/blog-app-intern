<div class="card shadow-sm p-3 rounded">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
        <p class="text-muted small mb-2">Status: {{ ($post->status) }}</p>

        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.post.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>

            <form action="{{ route('admin.post.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>