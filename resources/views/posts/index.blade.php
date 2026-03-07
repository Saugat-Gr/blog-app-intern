@extends('layouts.app')

@section('content')

    <div class="container mt-4 border p-5 shadow-lg rounded">

        <div class="btn-group mb-5 d-flex justify-content-between">

            <div>
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false" id="filter-btn">
                    Filter Posts: All
                </button>
                <ul class="dropdown-menu dropdown-menu-end" id="filter-user">
                    <li><a id="dropdown-item" class="dropdown-item" href="#" data-status="published">Published</a></li>
                    <li><a id="dropdown-item" class="dropdown-item" href="#" data-status="archived">Archived</a></li>
                    <li><a id="dropdown-item" class="dropdown-item" href="#" data-status="draft">Draft</a></li>
                </ul>
            </div>

            @can('create-post')
                <div>
                    <button class="float-end btn btn-success"> <a href="{{ route('admin.post.create') }}"
                            class="text-decoration-none text-light"> Create a Post <i class="bi bi-person-fill-add"></i>
                        </a></button>
                </div>
            @endcan

        </div>

        <div id="post-cards" class="d-grid gap-4" style="grid-template-columns: repeat(4, 1fr);">

            @include('posts._post-cards', ['posts' => $posts])

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterLinks = document.querySelectorAll('#dropdown-item');
            const cardsContainer = document.getElementById('post-cards');
            const filterBtn = document.getElementById('filter-btn');

            filterLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();

                    const status = this.dataset.status;

                    filterBtn.textContent = `Filter Posts: ${this.textContent}`;

                    fetch(`/admin/post/filter/${status}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.text())
                        .then(html => {
                            cardsContainer.innerHTML = html;
                        })
                        .catch(error => console.error(error));
                });
            });
        });
    </script>

@endsection