@if(sizeof($plans) > 0)
@foreach($plans as $plan)
    <x-plan-card :plan="$plan" />
@endforeach
@else

  <p class="text-secondary">No Data Available</p>

@endif