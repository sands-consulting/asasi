<fieldset title="6">
    <legend class="text-semibold">Commercial Requirement</legend>

    <div class="row">
        <div class="col-md-12">
            <table id="tblCommReq" class="table" style="margin-bottom: 20px">
                <thead>
                    <tr>
                       <th>Title</th>
                       <th width="15%">Mandatory</th>
                       <th width="15%">Require File</th>
                       <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @if (isset($requirementCommercials) && !$requirementCommercials->isEmpty())
                        <tr class="table-empty" style="display:none">
                            <td colspan="4">
                                {!! trans('requirement-commercials.views.create.table.empty') !!}
                            </td>
                        </tr>
                        @foreach($requirementCommercials as $requirementCommercial)
                        <tr data-id="{{ $requirementCommercial->id }}">
                            <td>
                                <a href="#" class="myeditable"
                                    id="update-requirement"
                                    data-type="textarea"
                                    data-name="title" 
                                    data-pk="{{ $requirementCommercial->id }}"
                                    data-url="{{ route('api.requirement-commercials.update') }}">{{ $requirementCommercial->title }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable myeditable-switchery" data-type="switchery"
                                    data-inputclass="switcher-single"
                                    data-name="mandatory"
                                    data-title="Is Mandatory ?" 
                                    data-source="{'1': 'Yes'}"
                                    data-value="{{ $requirementCommercial->mandatory }}"
                                    data-emptytext="No"
                                    data-pk="{{ $requirementCommercial->id }}"
                                    data-url="{{ route('api.requirement-commercials.update') }}"></a>
                            </td>
                            <td>
                                <a href="#" class="myeditable myeditable-switchery" data-type="switchery"
                                    data-inputclass="switcher-single" data-name="require_file" data-title="Require File ?"
                                    data-source="{'1': 'Yes'}"
                                    data-value="{{ $requirementCommercial->require_file }}"
                                    data-emptytext="No"
                                    data-pk="{{ $requirementCommercial->id }}"
                                    data-url="{{ route('api.requirement-commercials.update') }}"
                                ></a>
                            </td>
                            <td class="action-column">
                                <a href="#" class="btn btn-xs btn-danger btn-remove" data-url="/api/requirement-commercials/delete/" data-confirm="{{ trans('app.confirmation') }}"><i class="icon-cross2"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr class="table-empty">
                            <td colspan="4">
                                {!! trans('requirement-commercials.views.create.table.empty') !!}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="4">
                            <button type="button" class="btn btn-xs btn-info btn-add" data-template="#commercialsRow" data-noticeId="{{ $notice->id }}"><i class="icon-add"></i> Add new row</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</fieldset>

@section('scripts')
@parent
    <script id="commercialsRow" type="text/x-template">
        <tr>
            <td>
                <a href="#" class="myeditable" id="new-requirement" data-type="textarea" data-name="title" data-url="{{ route('api.requirement-commercials.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable myeditable-switchery" data-type="switchery"
                    data-inputclass="switcher-single"
                    data-name="mandatory"
                    data-title="Is Mandatory ?" 
                    data-source="{'1': 'Yes'}"
                    data-value="0"
                    data-emptytext="No"
                    data-url="{{ route('api.requirement-commercials.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable myeditable-switchery" data-type="switchery"
                    data-inputclass="switcher-single" data-name="require_file" data-title="Require File ?" 
                    data-source="{'1': 'Yes'}"
                    data-value="0"
                    data-emptytext="No"
                    data-url="{{ route('api.requirement-commercials.update') }}"
                ></a>
            </td>
            <td class="action-column">
                <button type="button" class="btn btn-xs btn-success btn-save" data-table="#tblCommReq" data-url="{{ route('api.requirement-commercials.store', $notice->id) }}">
                    <i class="icon-checkmark3"></i></button>
                <a href="#" type="button" class="btn btn-xs btn-danger btn-remove" data-url="/api/requirement-commercials/delete/" data-confirm="{{ trans('app.confirmation') }}">
                    <i class="icon-cross2"></i></a>
            </td>
        </tr>
    </script>
@stop