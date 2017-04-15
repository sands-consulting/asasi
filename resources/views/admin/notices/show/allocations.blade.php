<div role="tabpanel" class="tab-pane" id="tab-notice-allocations">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('notices.attributes.allocations.name') }}</th>
                <th class="text-right">{{ trans('notices.attributes.allocations.amount') }}</th>
            </thead>
            <tbody>
                @forelse($notice->allocations as $allocation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $allocation->name }}
                            <span class="label bg-blue-700">{{ $allocation->type->name  }}</span>
                        </td>
                        <td class="text-right">{{ setting('currency') }} {{ $allocation->pivot->amount }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">{{ trans('notices.views.admin.show.allocations.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>