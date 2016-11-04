{!! Former::open_vertical(route('admin.evaluators.save', $notice->id)) !!}
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info alert-styled-left alert-arrow-left alert-bordered">{{ trans('evaluators.views.edit.info') }}</div>
            @foreach (App\EvaluationType::active()->get() as $evaluationType)
                <fieldset class="mb-20">
                    <legend class="text-semibold"> <i class="icon-coins"></i> Add New {{ $evaluationType->name }} Evaluator</legend>
                    <div class="row"> 
                        <div class="col-sm-12">
                            {!! Former::select("evaluators[{$evaluationType->id}][]")
                                ->multiple(true)
                                ->label(false)
                                ->options(App\User::evaluators()->lists('name','id'))
                                ->data_placeholder('Click here to select evaluator from user list.')
                                ->value($notice->evaluators()->wherePivot('type_id', $evaluationType->id)->lists('user_id'))
                                ->addClass('select') !!}
                        </div>
                    </div>
                </fieldset>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-right">
            <button type="submit" class="btn btn-primary btn-sm pl-20 pr-20">Assign</button>
        </div>
    </div>
{!! Former::close() !!}