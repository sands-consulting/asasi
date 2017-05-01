<div id="modal-eligible" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title">{{ trans('notices.views.admin.modals.eligible.title') }}</h5>
            </div>

            {!! Former::open_vertical(route('admin.notices.eligible', $notice->id))->method('POST') !!}
                <div class="modal-body">
                    {!! Former::select('vendor_id')->label('notices.attributes.eligibles.name')->required()->vModel('vendorId')
                        ->dataUrl(version('v1')->route('vendors.index'))
                        ->dataPlaceholder(trans('notices.views.admin.modals.eligible.vendor_id'))
                        ->options(['-1' => trans('notices.views.admin.modals.eligible.vendor_id')]) !!}
                    {!! Former::textarea('remarks')->label('notices.attributes.remarks')->rows(5)->required()->vModel('remarks') !!}
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">{{ trans('actions.dismiss') }}<span class="legitRipple-ripple"></span><span class="legitRipple-ripple"></span></button>
                    <button type="submit" class="btn btn-warning legitRipple" v-if="vendorId > 0 && remarks.length > 0">{{ trans('notices.views.admin.modals.eligible.submit') }}</button>
                </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>