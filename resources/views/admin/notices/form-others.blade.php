<fieldset title="5">
    <legend class="text-semibold">Field Codes</legend>
    
    <h5>MOF</h5>
    <div id="field-codes" style="margin:30px">
        <div class="row">
            <div class="col-sm-2">
                <button id="btnAddRules" type="button" class="btn btn-default">Add</button>
            </div>
            <div class="col-sm-8">
                {!! Former::select('mof_field_code')
                    ->label(false)
                    ->options(['' => 'Select MOF Field Code']) 
                    ->required() !!}
            </div>
            <div class="col-sm-2">
                <button id="btnAddRules" type="button" class="btn btn-default">></button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                {!! Former::select('and')
                    ->label(false)
                    ->options(['and' => 'AND', 'Or' => 'OR']) 
                    ->required() !!}
            </div>
            <div class="col-sm-8">
                {!! Former::select('mof_field_code')
                    ->label(false)
                    ->options(['' => 'Select MOF Field Code']) 
                    ->required() !!}
            </div>
            <div class="col-sm-2">
                <button id="btnAddRules" type="button" class="btn btn-default">></button>
            </div>
        </div>
    </div>
    
</fieldset>

<fieldset title="6">
    <legend class="text-semibold">Documents</legend>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Method of Evaluation:</label>
                <div class="radio">
                    <label>
                        <input type="radio" name="availability" class="styled">
                        Technical
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="availability" class="styled">
                        Commercial
                    </label>
                </div>

                <div class="radio">
                    <label>
                        <input type="radio" name="availability" class="styled">
                        Both
                    </label>
                </div>
            </div>
        </div>
    </div>
</fieldset>