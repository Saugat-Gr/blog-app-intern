@extends('layouts.app')

@section('content')

<div class="container mt-4 border p-5 shadow-lg rounded">
    
<div class="btn-group mb-5 d-flex justify-content-between">

<div>
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="filter-btn">
            Filter Users: All
        </button>
        <ul class="dropdown-menu dropdown-menu-end" id="filter-user">
            <li><a id="dropdown-item"  class="dropdown-item" href="#" data-status="all">All</a></li>
            <li><a id="dropdown-item" class="dropdown-item" href="#" data-status="active">Active</a></li>
            <li><a id="dropdown-item" class="dropdown-item" href="#" data-status="in-active">In-Active</a></li>
        </ul>
</div>

  <div>
    <button class="float-end btn btn-success"> <a href="{{ route('admin.plan.create') }}" class="text-decoration-none text-light"> Create a Plan <i class="bi bi-person-fill-add"></i> </a></button>
  </div>

</div>

<div id="user-cards" class="d-grid gap-4" style="grid-template-columns: repeat(4, 1fr);">

       @include('admin.plans._plan-cards', ['plans' => $plans])

</div>

</div>
 
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const filterLinks = document.querySelectorAll('#dropdown-item');
    const cardsContainer = document.getElementById('user-cards');
    const filterBtn = document.getElementById('filter-btn');

    filterLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const status = this.dataset.status;

            filterBtn.textContent = `Filter Users: ${this.textContent}`;

            fetch(`/admin/plan/filter/${status}`, {
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