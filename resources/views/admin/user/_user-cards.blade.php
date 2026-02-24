@if(sizeof($users) > 0)
@foreach($users as $user)
  @if($user->id !== Auth::id())
    <x-user-card :user="$user" />
  @endif
@endforeach
@else

  <p class="text-secondary">No Data Available</p>

@endif