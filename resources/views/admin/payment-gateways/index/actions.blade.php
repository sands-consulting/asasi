<ul class="icons-list">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="icon-menu9"></i>
		</a>
		<ul class="dropdown-menu dropdown-menu-right">

            @can('edit', $gateway)
            <li><a href="{{ route('admin.payment-gateways.edit', $gateway->id) }}">{{ trans('actions.edit') }}</a></li>
            @endcan

            @can('destroy', $gateway)
                <li>
                    <a href="{{ route('admin.payment-gateways.destroy', [$gateway->id, 'redirect_to' => route('admin.gateways.index')]) }}"
                       data-method="DELETE">{{ trans('actions.delete') }}</a></li>
            @endcan
		</ul>
	</li>
</ul>