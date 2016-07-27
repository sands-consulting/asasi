@if($place->parent)
{{ $place->parent->name }}
@else
<i class="icon-cross2"></i>
@endif