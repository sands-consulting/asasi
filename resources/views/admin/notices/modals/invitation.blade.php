<div id="modal-invitation" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title">{{ trans('notices.views.admin.modals.invitation.title') }}</h5>
            </div>

            {!! Former::open_vertical(route('admin.notices.invitation', $notice->id))->method('POST') !!}
                <div class="modal-body">
                    {!! Former::select('vendor_ids[]')
                        ->id('vendor_ids')
                        ->label('notices.attributes.invitations.name')
                        ->required()
                        ->multiple(true)
                        ->vModel('vendorIds')
                        ->dataUrl(route('api.vendors.index'))
                        ->dataPlaceholder(trans('notices.views.admin.modals.invitation.vendor_id'))
                        ->options(['-1' => trans('notices.views.admin.modals.invitation.vendor_id')]) !!}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">{{ trans('actions.dismiss') }}<span class="legitRipple-ripple"></span><span class="legitRipple-ripple"></span></button>
                    <button type="submit" class="btn btn-warning legitRipple" v-if="vendorIds.length > 0">{{ trans('notices.views.admin.modals.invitation.submit') }}</button>
                </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>