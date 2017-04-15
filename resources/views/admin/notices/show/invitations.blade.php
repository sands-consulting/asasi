<div role="tabpanel" class="tab-pane" id="tab-notice-invitations">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('notices.attributes.eligibles.name') }}</th>
                <th>{{ trans('notices.attributes.eligibles.created_at') }}</th>
                <th class="col-xs-1">&nbsp;</th>
            </thead>
            <tbody>
                @foreach($notice->invitations()->get() as $invitation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invitation->vendor->name }}</td>
                    <td>{{ $invitation->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="5" align="center">
                        <a href="#" data-toggle="modal" data-target="#modal-eligble"><i class="icon-plus-circle2"></i> {{ trans('notices.buttons.add-eligible') }}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>