<div role="tabpanel" class="tab-pane" id="tab-notice-allocations">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('notices.views.admin.allocations.table.type') }}</th>
                <th>{{ trans('notices.views.admin.allocations.table.name') }}</th>
                <th class="text-right">{{ trans('notices.views.admin.allocations.table.amount') }}</th>
            </thead>
            <tbody>
                @forelse($notice->allocations as $allocation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $allocation->type->name }}</td>
                        <td>{{ $allocation->name }}</td>
                        <td class="text-right">{{ setting('currency') }} {{ $allocation->pivot->amount }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">{{ trans('notices.views.admin.events.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>