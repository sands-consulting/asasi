@if($organization->parent)
{{ $organization->parent->short_name }}
@else
<i class="icon-cross2"></i>
@endif