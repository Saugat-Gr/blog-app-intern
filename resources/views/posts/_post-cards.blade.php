@if(sizeof($posts) > 0)
@foreach($posts as $post)
    <x-post-card :post="$post" />
@endforeach
@else

  <p class="text-secondary">No Data Available</p>

@endif