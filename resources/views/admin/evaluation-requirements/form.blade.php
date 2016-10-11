<div class="row">
    <div class="col-sm-12">
        <fieldset>
            <legend>Commercials</legend>
            <table id="tblCommReq" class="table" style="margin-bottom: 20px">
                <thead>
                    <tr>
                       <th width="5%">Seq</th>
                       <th>Title</th>
                       <th width="15%">Score</th>
                       <th width="30%">Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @if (!$requirementCommercials->isEmpty())
                        <tr class="table-empty" style="display:none">
                            <td colspan="4">
                                {!! trans('requirement-commercials.views.create.table.empty') !!}
                            </td>
                        </tr>
                        @foreach($requirementCommercials as $requirementCommercial)
                        <tr data-id="{{ $requirementCommercial->id }}">
                            <td>
                                <a href="#" class="myeditable"
                                    data-type="text"
                                    data-name="sequence" 
                                    data-pk="{{ $requirementCommercial->id }}"
                                    data-url="{{ route('api.evaluation-requirements.update') }}">{{ $requirementCommercial->sequence }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable"
                                    data-type="textarea"
                                    data-name="title" 
                                    data-pk="{{ $requirementCommercial->id }}"
                                    data-url="{{ route('api.evaluation-requirements.update') }}">{{ $requirementCommercial->title }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable"
                                    data-name="full_score" 
                                    data-pk="{{ $requirementCommercial->id }}"
                                    data-url="{{ route('api.evaluation-requirements.update') }}"
                                >{{ $requirementCommercial->full_score }}</a>
                            </td>
                            <td class="action-column">
                                <a href="#" class="btn btn-xs btn-danger btn-remove" data-url="/api/evaluation-requirements/delete/" data-confirm="{{ trans('app.confirmation') }}"><i class="icon-cross2"></i></a>
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
        </fieldset>
    </div>
    <div class="col-sm-12">
        <fieldset>
            <legend>Technicals</legend>
            <table id="tblTechReq" class="table" style="margin-bottom: 20px">
                <thead>
                    <tr>
                       <th width="5%">Seq</th>
                       <th>Title</th>
                       <th width="15%">Score</th>
                       <th width="30%">Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @if (!$requirementTechnicals->isEmpty())
                        <tr class="table-empty" style="display:none">
                            <td colspan="4">
                                {!! trans('requirement-commercials.views.create.table.empty') !!}
                            </td>
                        </tr>
                        @foreach($requirementTechnicals as $requirementTechnical)
                        <tr data-id="{{ $requirementTechnical->id }}">
                            <td>
                                <a href="#" class="myeditable"
                                    data-type="text"
                                    data-name="sequence" 
                                    data-pk="{{ $requirementTechnical->id }}"
                                    data-url="{{ route('api.evaluation-requirements.update') }}">{{ $requirementTechnical->sequence }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable"
                                    data-type="textarea"
                                    data-name="title" 
                                    data-pk="{{ $requirementTechnical->id }}"
                                    data-url="{{ route('api.evaluation-requirements.update') }}">{{ $requirementTechnical->title }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable"
                                    data-type="text"
                                    data-name="full_score" 
                                    data-pk="{{ $requirementTechnical->id }}"
                                    data-url="{{ route('api.evaluation-requirements.update') }}">{{ $requirementTechnical->full_score }}</a>
                            </td>
                            <td class="action-column">
                                <a href="#" class="btn btn-xs btn-danger btn-remove" data-url="/api/evaluation-requirements/delete/" data-confirm="{{ trans('app.confirmation') }}"><i class="icon-cross2"></i></a>
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
                            <button type="button" class="btn btn-xs btn-info btn-add" data-template="#technicalsRow" data-noticeId="{{ $notice->id }}"><i class="icon-add"></i> Add new row</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </div>
</div>

@section('scripts')
@parent
    <script id="commercialsRow" type="text/x-template">
        <tr>
            <td>
                <a href="#" class="myeditable"
                    data-type="text"
                    data-name="sequence"
                    data-url="{{ route('api.evaluation-requirements.update') }}"
                ></a>
            </td>
            <td>
                <a href="#" class="myeditable" 
                    id="new-requirement"
                    data-type="textarea"
                    data-name="title"
                    data-url="{{ route('api.evaluation-requirements.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable"
                    data-type="text"
                    data-name="full_score"
                    data-url="{{ route('api.evaluation-requirements.update') }}"
                ></a>
            </td>
            <td class="action-column">
                <button type="button" class="btn btn-xs btn-success btn-save" data-table="#tblCommReq" data-url="{{ route('api.evaluation-requirements.store', 
                    [$notice->id, 'type' => 'Commercials']) }}"><i class="icon-checkmark3"></i></button>
                <a href="#" type="button" class="btn btn-xs btn-danger btn-remove" data-url="/api/evaluation-requirements/delete/" data-confirm="{{ trans('app.confirmation') }}">
                    <i class="icon-cross2"></i></a>
            </td>
        </tr>
    </script>
    <script id="technicalsRow" type="text/x-template">
        <tr>
            <td>
                <a href="#" class="myeditable"
                    data-type="text"
                    data-name="sequence"
                    data-url="{{ route('api.evaluation-requirements.update') }}"
                ></a>
            </td>
            <td>
                <a href="#" class="myeditable" 
                    id="new-requirement"
                    data-type="textarea"
                    data-name="title"
                    data-url="{{ route('api.evaluation-requirements.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable"
                    data-type="text"
                    data-name="full_score"
                    data-url="{{ route('api.evaluation-requirements.update') }}"
                ></a>
            </td>
            <td class="action-column">
                <button type="button" class="btn btn-xs btn-success btn-save" data-table="#tblTechReq" data-url="{{ route('api.evaluation-requirements.store',
                    [$notice->id, 'type' => 'Technicals']) }}"><i class="icon-checkmark3"></i></button>
                <a href="#" type="button" class="btn btn-xs btn-danger btn-remove" data-url="/api/evaluation-requirements/delete/" data-confirm="{{ trans('app.confirmation') }}">
                    <i class="icon-cross2"></i></a>
            </td>
        </tr>
    </script>
@stop