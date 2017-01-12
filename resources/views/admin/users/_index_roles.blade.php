@if(count($user->roles) > 0)
<ul class="list-inline list-inline-separate">
	@foreach($user->roles as $role)<li>{{ $role->display_name}}</li>@endforeach
</ul>
@else
<i class="icon-cross2"></i>
@endif