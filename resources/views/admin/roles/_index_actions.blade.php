<ul class="icons-list">
	<li>
		<a href="{{ route('admin.roles.edit', $role->id) }}">
			<i class="icon-pencil7 text-blue"></i>
		</a>
    </li>
    @if (!$role->fixed)
    <li>
        <a href="{{ route('admin.roles.destroy', $role->id) }}" data-method="DELETE" data-confirm="{{ trans('app.confirmation') }}">
            <i class="icon-trash text-danger"></i>
        </a>
    </li>
    @endif
</ul>