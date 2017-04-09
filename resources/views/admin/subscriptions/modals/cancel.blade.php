<div id="cancel-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title">{{ trans('subscriptions.modals.cancel.title') }}</h5>
            </div>

            {!! Former::open_vertical(route('admin.subscriptions.cancel', $subscription->id))->method('PUT') !!}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                {!! Former::textarea('remarks')
                                    ->label('subscriptions.attributes.remarks')
                                    ->rows(5)
                                    ->required() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">{{ trans('actions.cancel') }}<span class="legitRipple-ripple"></span><span class="legitRipple-ripple"></span></button>
                    <button type="submit" class="btn btn-danger legitRipple">{{ trans('subscriptions.modals.cancel.submit') }}</button>
                </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>