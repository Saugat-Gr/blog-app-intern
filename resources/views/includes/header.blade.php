@if (Auth::user())
<x-auth_nav></x-auth_nav>
@else
<x-guest_nav></x-guest_nav>
@endif


<x-nav></x-nav>

