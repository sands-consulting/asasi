<div role="tabpanel" class="tab-pane" id="tab-notice-invitations">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('notices.attributes.invitations.name') }}</th>
                <th class="col-xs-2">{{ trans('notices.attributes.invitations.created_at') }}</th>
                <th class="col-xs-2">{{ trans('notices.attributes.invitations.sent_at') }}</th>
                <th width="40">&nbsp;</th>
            </thead>
            <tbody>
                @foreach($notice->invitations()->get() as $invitation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invitation->vendor->name }}</td>
                    <td>{{ $invitation->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        @if($invitation->sent_at)
                        {{ $invitation->sent_at->format('d/m/Y H:i:s') }}
                        @else
                        {!! blank_icon($invitation->sent_at) !!}
                        @endif
                    </td>
                    <td>
                        @can('show', $invitation->vendor)
                        <a href="{{ route('admin.vendors.show', $invitation->vendor_id) }}" class="btn btn-xs bg-blue-700" target="_blank"><i class="icon-office"></i></a>
                        @endcan
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5" align="center">
                        <a href="#" data-toggle="modal" data-target="#modal-invitation"><i class="icon-plus-circle2"></i> {{ trans('notices.buttons.add-invitation') }}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>