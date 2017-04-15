<div id="modal-delete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title">{{ trans('notices.modals.delete.title') }}</h5>
            </div>

            {!! Former::open_vertical(route('admin.notices.destroy', $notice->id))->method('DELETE') !!}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                {!! Former::textarea('remarks')
                                    ->label('notices.attributes.remarks')
                                    ->rows(5)
                                    ->required() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">{{ trans('actions.dismiss') }}<span class="legitRipple-ripple"></span><span class="legitRipple-ripple"></span></button>
                    <button type="submit" class="btn btn-danger legitRipple">{{ trans('notices.modals.delete.submit') }}</button>
                </div>
            {!! Former::close() !!}
        </div>
    </div>
</div>