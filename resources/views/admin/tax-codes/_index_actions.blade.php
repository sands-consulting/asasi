<ul class="icons-list">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="icon-menu9"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="{{ route('admin.tax-codes.edit', $taxCode->id) }}">{{ trans('actions.edit') }}</a></li>

            @can('tax-code:activate')
                <li>
                    <a href="{{ route('admin.tax-codes.activate', [$taxCode->id, 'redirect_to' => route('admin.tax-codes.index')]) }}"
                       data-method="PUT">{{ trans('actions.activate') }}</a></li>
            @endcan

            @can('tax-code:delete')
                <li>
                    <a href="{{ route('admin.tax-codes.destroy', [$taxCode->id, 'redirect_to' => route('admin.tax-codes.index')]) }}"
                       data-method="DELETE">{{ trans('actions.delete') }}</a></li>
            @endcan
        </ul>
    </li>
</ul>