<fieldset title="6">
    <legend class="text-semibold">CIDB</legend>
    
    <div id="field-codes" style="margin:30px">
        <div class="row rules">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-1 ">
                        <p class="form-control-static text-center">BY</p>
                    </div>
                    <div class="col-sm-8">
                        {!! Former::select('cidb_field_code')
                            ->label(false)
                            ->options(['' => 'Select CIDB Field Code']) !!}
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-1"">
                <button type="button" class="btn btn-default btn-add-rule" data-template="cidb-condition-and">And</button>
                <button type="button" class="btn btn-default btn-add-rule" data-template="cidb-condition-or">Or</button>
                <button type="button" class="btn btn-success btn-add-rule" data-confirm="{{ trans('app.confirmation') }}">End</button>
            </div>
        </div>
    </div>
</fieldset>
@section('scripts')
@parent
    <script id="cidb-condition-or" type="text/x-template">
        <div class="row rules">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-1">
                        <p class="form-control-static text-center">OR</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-1">
                        {!! Former::select('cidb_field_code[]')
                            ->label(false)
                            ->options(['' => 'Select CIDB Field Code']) !!}
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-xs btn-danger btn-remove-rule" data-url="/api/requirement-commercials/delete/"><i class="icon-cross2"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </script>
    <script id="cidb-condition-and" type="text/x-template">
        <div class="row rules">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-1 conditions">
                        <p class="form-control-static text-center">AND</p>
                    </div>
                    <div class="col-sm-8">
                        {!! Former::select('cidb_field_code[]')
                            ->label(false)
                            ->options(['' => 'Select CIDB Field Code']) !!}
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-xs btn-danger btn-remove-rule" data-url="/api/requirement-commercials/delete/"><i class="icon-cross2"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </script>
@stop