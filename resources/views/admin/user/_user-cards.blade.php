@if(sizeof($users) > 0)
@foreach($users as $user)
    <x-user-card :user="$user" />
@endforeach
@else

  <p class="text-secondary">No Data Available</p>

@endif