FORMFIELDS

<div class="form-group">
    <div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
        {!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
        {!! link_to_route('admin.model-names.show', trans('actions.cancel'), $model-name->id, ['class' => 'btn btn-default']) !!}
    </div>
</div>