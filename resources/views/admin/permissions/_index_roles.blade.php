@if(count($permission->roles) > 0)
<ul class="list-unstyled no-margin">
	@foreach($permission->roles as $role)<li>{{ $role->display_name}}</li>@endforeach
</ul>
@else
<i class="icon-cross2"></i>
@endif