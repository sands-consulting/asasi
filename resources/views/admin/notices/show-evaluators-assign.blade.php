<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-coins"></i> Add New Commercial Evaluator</legend>
    {!! Former::open_vertical(route('admin.notices.save-evaluator', $notice->id)) !!}
        <div class="row"> 
            <div class="col-sm-12">
                {!! Former::select('notice_evaluators[user_id][]')
                    ->multiple(true)
                    ->label(false)
                    ->options(App\User::evaluators()->pluck('name','id'))
                    ->data_placeholder('Click here to select evaluator from user list.')
                    ->value($notice->evaluators()->wherePivot('type_id', 1)->pluck('user_id'))
                    ->addClass('select') !!}

                {!! Former::hidden('notice_evaluators[type_id]')->value(1) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-primary btn-sm">Assign</button>
            </div>
        </div>
    {!! Former::close() !!}
</fieldset>

<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-coins"></i> Add New Technical Evaluator</legend>
    {!! Former::open_vertical(route('admin.notices.save-evaluator', $notice->id)) !!}
        <div class="row"> 
            <div class="col-sm-12">
                {!! Former::select('notice_evaluators[user_id][]')
                    ->multiple(true)
                    ->label(false)
                    ->options(App\User::evaluators()->pluck('name','id'))
                    ->data_placeholder('Click here to select evaluator from user list.')
                    ->addClass('select')
                    ->value($notice->evaluators()->wherePivot('type_id', 2)->pluck('user_id'))
                    ->required() !!}

                {!! Former::hidden('notice_evaluators[type_id]')->value(2) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-primary btn-sm">Assign</button>
            </div>
        </div>
    {!! Former::close() !!}
</fieldset>
