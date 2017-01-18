<fieldset id="mof" title="4">
    <legend class="text-semibold">MOF</legend>
    
    <div id="field-codes" style="margin:30px">
        <div class="row rules">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-1 ">
                        <p class="form-control-static text-center">BY</p>
                    </div>
                    <div class="col-sm-8">
                        {!! Former::select('qualification_code_id[]')
                            ->label(false)
                            ->options(['' => 'Select MOF Field Code'] + App\QualificationCode::whereStatus('active')->whereTypeId(1)->get()->pluck('full_name', 'id')->toArray())  !!}
                        {!! Former::hidden('condition[]')->value(null) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-1"">
                <button type="button" class="btn btn-default btn-add-rule" data-template="mof-condition-and">And</button>
                <button type="button" class="btn btn-default btn-add-rule" data-template="mof-condition-or">Or</button>
                <button type="button" class="btn btn-success btn-save-rule" data-confirm="{{ trans('app.confirmation') }}">End</button>
            </div>
        </div>
    </div>
</fieldset>

@section('scripts')
@parent
    <script id="mof-condition-or" type="text/x-template">
        <div class="row rules">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-1">
                        <p class="form-control-static text-center">OR</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-1">
                        {!! Former::select('qualification_code_id[]')
                            ->label(false)
                            ->options(['' => 'Select MOF Field Code']) !!}

                        {!! Former::hidden('condition[]')->value('or') !!}
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-xs btn-danger btn-remove-rule" data-url="/api/requirement-commercials/delete/"><i class="icon-cross2"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </script>
    <script id="mof-condition-and" type="text/x-template">
        <div class="row rules">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-1 conditions">
                        <p class="form-control-static text-center">AND</p>
                    </div>
                    <div class="col-sm-8">
                        {!! Former::select('qualification_code_id[]')
                            ->label(false)
                            ->options(['' => 'Select MOF Field Code']) !!}

                        {!! Former::hidden('condition[]')->value('and') !!}
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-xs btn-danger btn-remove-rule" data-url="/api/requirement-commercials/delete/"><i class="icon-cross2"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </script>
@stop