<div role="tabpanel" class="tab-pane" id="tab-vendor-subscriptions">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <tr>
                    <th class="col-xs-1">#</th>
                    <th>{{ trans('subscriptions.attributes.number') }}</th>
                    <th>{{ trans('subscriptions.attributes.package') }}</th>
                    <th>{{ trans('subscriptions.attributes.start_at') }}</th>
                    <th>{{ trans('subscriptions.attributes.end_at') }}</th>
                    <th>{{ trans('subscriptions.attributes.status') }}</th>
                    <th width="40">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            @forelse($vendor->subscriptions()->get() as $subscription)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subscription->number }}</td>
                    <td>{{ $subscription->package->name }}</td>
                    <td>{{ $subscription->start_at->format('d/m/Y') }}</td>
                    <td>{{ $subscription->end_at->format('d/m/Y') }}</td>
                    <td>@include('admin.subscriptions.index.status')</td>
                    <td>
                        @if(is_path('admin*'))
                            @can('show', $subscription)
                            <a href="{{ route('admin.subscriptions.show', $subscription->id) }}" class="btn btn-xs bg-blue-700" target="_blank"><i class="icon-file-text2"></i></a>
                            @endcan
                        @else
                            @if($subscription->status != 'pending')
                            {!! link_to_route('subscriptions.show', trans('vendors.views.admin.show.subscriptions.certificate'), $subscription->id, ['class' => 'btn btn-xs bg-blue-700']) !!}
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="7">{{ trans('vendors.views.admin.show.subscriptions.empty') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>