<fieldset title="4">
    <legend class="text-semibold">Technical Requirement</legend>

    <div class="row">
        <div class="col-md-12">
            <table id="tblTechReq" class="table" style="margin-bottom: 20px">
                <thead>
                    <tr>
                       <th>Title</th>
                       <th width="15%">Mandatory</th>
                       <th width="15%">Require File</th>
                       <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($requirementTechnicals) && !$requirementTechnicals->isEmpty())
                        <tr class="table-empty" style="display:none">
                            <td colspan="4">
                                {!! trans('requirement-technicals.views.create.table.empty') !!}
                            </td>
                        </tr>
                        @foreach($requirementTechnicals as $requirementTechnical)
                        <tr data-id="{{ $requirementTechnical->id }}">
                            <td>
                                <a href="#" class="myeditable" 
                                    id="update-requirement"
                                    data-type="textarea"
                                    data-name="title" 
                                    data-pk="{{ $requirementTechnical->id }}"
                                    data-url="{{ route('api.requirement-technicals.update') }}">{{ $requirementTechnical->title }}</a>
                            </td>
                        
                            <td>
                                <a href="#" class="myeditable myeditable-switchery"
                                    data-type="switchery"
                                    data-inputclass="switcher-single"
                                    data-name="mandatory"
                                    data-title="Is Mandatory ?"
                                    data-pk="{{ $requirementTechnical->id }}"
                                    data-source="{'1': 'Yes'}"
                                    data-value="{{ $requirementTechnical->mandatory }}" 
                                    data-emptytext="No"
                                    data-url="{{ route('api.requirement-technicals.update') }}"></a>
                            </td>
                            <td>
                                <a href="#" class="myeditable myeditable-switchery"
                                    data-type="switchery"
                                    data-inputclass="switcher-single"
                                    data-name="require_file"
                                    data-title="Require File ?"
                                    data-pk="{{ $requirementTechnical->id }}"
                                    data-source="{'1': 'Yes'}"
                                    data-value="{{ $requirementTechnical->require_file }}"
                                    data-emptytext="No"
                                    data-url="{{ route('api.requirement-technicals.update') }}"
                                ></a>
                            </td>
                            <td class="action-column">
                                <a href="#" class="btn btn-xs btn-danger btn-remove" data-url="/api/requirement-technicals/delete/" data-confirm="{{ trans('app.confirmation') }}"><i class="icon-cross2"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr class="table-empty">
                            <td colspan="4">
                                {!! trans('requirement-technicals.views.create.table.empty') !!}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="4">
                            <button type="button" class="btn btn-xs btn-info btn-add" data-template="#technicalsRow"><i class="icon-add"></i> Add new row</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</fieldset>

@section('scripts')
    @parent
    <script id="technicalsRow" type="text/x-template">
        <tr>
            <td>
                <a href="#" class="myeditable" 
                    id="new-requirement"
                    data-type="textarea"
                    data-name="title"
                    data-url="{{ route('api.requirement-technicals.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable myeditable-switchery"
                    data-type="switchery"
                    data-inputclass="switcher-single"
                    data-name="mandatory"
                    data-title="Is Mandatory ?"
                    data-source="{'1': 'Yes'}" data-value="0" data-emptytext="No"
                    data-url="{{ route('api.requirement-technicals.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable myeditable-switchery"
                    data-type="switchery"
                    data-inputclass="switcher-single"
                    data-name="require_file"
                    data-title="Require File ?"
                    data-source="{'1': 'Yes'}" data-value="0" data-emptytext="No"
                    data-url="{{ route('api.requirement-technicals.update') }}"></a>
            </td>
            <td class="action-column">
                <button type="button" class="btn btn-xs btn-success btn-save" data-table="#tblTechReq" data-url="{{ route('api.requirement-technicals.store', $notice->id) }}">
                    <i class="icon-checkmark3"></i></button>
                <a href="#" class="btn btn-xs btn-danger btn-remove" data-url="/api/requirement-technicals/delete/" data-confirm="{{ trans('app.confirmation') }}">
                    <i class="icon-cross2" data-confirm="{{ trans('app.confirmation') }}"></i></a>
            </td>
        </tr>
    </script>
@stop