<fieldset title="5">
    <legend class="text-semibold">Field Codes</legend>
    
    <div id="field-codes" style="margin:30px">
        <div class="row condiotion-neutral">
            <div class="col-sm-1 ">
            </div>
            <div class="col-sm-8">
                {!! Former::select('mof_field_code')
                    ->label(false)
                    ->options(['' => 'Select MOF Field Code']) 
                    ->required() !!}
            </div>

            <div class="col-sm-3">
                <button type="button" class="btn btn-default btn-add-rule" data-template="condition-and">And</button>
                <button type="button" class="btn btn-default btn-add-rule" data-template="condition-or">Or</button>
            </div>
        </div>
    </div>
</fieldset>

@section('scripts')
@parent
    <script id="condition-or" type="text/x-template">
        <div class="row condition-or">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-1">
                        <p class="text-center">OR</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-1">
                        {!! Former::select('mof_field_code')
                            ->label(false)
                            ->options(['' => 'Select MOF Field Code']) 
                            ->required() !!}
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-default btn-add-rule" data-template="condition-and">And</button>
                        <button type="button" class="btn btn-default btn-add-rule" data-template="condition-or">Or</button>
                        <button type="button" class="btn btn-xs btn-danger btn-remove-rule" data-url="/api/requirement-commercials/delete/" style="display:none" data-template="condition-or"><i class="icon-cross2"></i></button>
                    </div>
            </div>
        </div>
    </script>
    <script id="condition-and" type="text/x-template">
        <div class="row condition-and">
            <div class="col-sm-1 conditions">
                <p class="text-center">AND</p>
            </div>
            <div class="col-sm-8">
                {!! Former::select('mof_field_code')
                    ->label(false)
                    ->options(['' => 'Select MOF Field Code']) 
                    ->required() !!}
            </div>
            <div class="col-sm-3">
                <button type="button" class="btn btn-default btn-add-rule" data-template="condition-and">And</button>
                <button type="button" class="btn btn-default btn-add-rule" data-template="condition-or">Or</button>
                <button type="button" class="btn btn-xs btn-danger btn-remove-rule" data-url="/api/requirement-commercials/delete/" style="display:none" data-template="condition-and"><i class="icon-cross2"></i></button>
            </div>
        </div>
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.btn-add-rule', function() {
                var template = $(this).data('template');
                var cachedTemplate = cachedTemplate || $('#'+template).html();
                var clone = $(cachedTemplate).clone();
                var row = $(this).closest('.row-neutral');
                var btn_add = $(this).parent().find('.btn-add-rule');
                var btn_remove = $(this).parent().find('.btn-remove-rule');

                btn_remove.fadeIn();
                btn_add.hide();
                row.after(clone);

            })
            $(document).on('click', '.btn-remove-rule', function() {
                var template_rm = $(this).data('template');
                $(this).closest('.' + template_rm).remove();
            });
        });
    </script>
@stop