<div role="tabpanel" class="tab-pane" id="tab-notice-purchases">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('notices.attributes.purchases.name') }}</th>
                <th>{{ trans('notices.attributes.purchases.number') }}</th>
                <th>{{ trans('notices.attributes.purchases.created_at') }}</th>
            </thead>
            <tbody>
                @forelse($notice->purchases()->get() as $purchase)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $purchase->vendor->name }}</td>
                    <td>{{ $purchase->number }}</td>
                    <td>{{ $purchase->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" align="center">
                        {{ trans('notices.views.admin.show.purchases.empty') }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>