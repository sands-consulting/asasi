<ul class="icons-list">
    @can('update', $type)
        <li>
            <a href="{{ route('admin.vendor-types.edit', $type->id) }}">
                <i class="icon-pencil7"></i>
            </a>
        </li>
    @endcan
    @can('destroy', $type)
        <li>
            <a href="{{ route('admin.vendor-types.destroy', $type->id) }}"
               data-method="DELETE" class="text-danger" data-confirm="{{ trans('app.confirmation') }}">
                <i class="icon-trash"></i>
            </a>
        </li>
    @endcan
</ul>