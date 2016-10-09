<fieldset title="3">
    <legend class="text-semibold">Notice Event</legend>

    <div class="row">
        <div class="col-md-12">
            <table id="tblNoticeEvents" class="table" style="margin-bottom: 20px">
                <thead>
                    <tr>
                       <th>Name</th>
                       <th width="10%">Type</th>
                       <th>Location</th>
                       <th width="10%">Date/Time</th>
                       <th width="10%">Required</th>
                       <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($noticeEvents) && !$noticeEvents->isEmpty())
                        <tr class="table-empty" style="display:none">
                            <td colspan="4">
                                {!! trans('notice-events.views.create.table.empty') !!}
                            </td>
                        </tr>
                        @foreach($noticeEvents as $noticeEvent)
                        <tr data-id="{{ $noticeEvent->id }}">
                            <td>
                                <a href="#" class="myeditable" 
                                    data-type="text"
                                    data-name="name" 
                                    data-pk="{{ $noticeEvent->id }}" 
                                    data-url="{{ route('api.notice-events.update') }}">{{ $noticeEvent->name }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable"
                                    data-type="select" 
                                    data-name="notice_event_type_id" 
                                    data-source="{{ App\NoticeEventType::options() }}"
                                    data-value="{{ $noticeEvent->notice_event_type_id }}" 
                                    data-pk="{{ $noticeEvent->id }}"
                                    data-url="{{ route('api.notice-events.update') }}">{{ $noticeEvent->type->name }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable" 
                                    data-type="textarea"
                                    data-name="location" 
                                    data-pk="{{ $noticeEvent->id }}" 
                                    data-url="{{ route('api.notice-events.update') }}">{{ $noticeEvent->location }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable"
                                    data-type="daterange"
                                    data-onblur="ignore"
                                    data-name="event_at"
                                    data-title="Select date & time"
                                    data-pk="{{ $noticeEvent->id }}"
                                    data-daterangepicker="{ singleDatePicker: true, timePicker: true, timePicker24Hour: true, }"
                                    data-url="{{ route('api.notice-events.update') }}">{{ $noticeEvent->event_at }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable myeditable-switchery" data-type="switchery" data-inputclass="switcher-single" data-name="required" data-title="Is Required ?" 
                                    data-source="{'1': 'Yes'}" data-pk="{{ $noticeEvent->id }}" data-value="{{ $noticeEvent->required }}" data-emptytext="No"
                                    data-url="{{ route('api.notice-events.update') }}"></a>
                            </td>
                            <td class="action-column">
                                <button type="button" class="btn btn-xs btn-danger btn-remove" data-url="/api/notice-events/delete/"><i class="icon-cross2"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr class="table-empty">
                            <td colspan="6">
                                {!! trans('notice-events.views.create.table.empty') !!}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="6">
                            <button type="button" class="btn btn-xs btn-info btn-add" data-template="#noticeEventsRow"><i class="icon-add"></i> Add new row</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</fieldset>

@section('scripts')
    @parent
    <script id="noticeEventsRow" type="text/x-template">
        <tr>
            <td>
                <a href="#" class="myeditable" data-type="text" data-name="name" data-url="{{ route('api.notice-events.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable" 
                    data-type="select"
                    data-name="notice_event_type_id"
                    data-source="{{ App\NoticeEventType::options() }}" 
                    data-value=""
                    data-url="{{ route('api.notice-events.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable" data-type="textarea" data-name="location"  
                    data-url="{{ route('api.notice-events.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable" 
                    data-type="daterange" 
                    data-onblur="ignore"
                    data-name="event_at" 
                    data-title="Select date & time"
                    data-daterangepicker="{ singleDatePicker: true, timePicker: true, timePicker24Hour: true, }"
                    data-url="{{ route('api.notice-events.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable myeditable-switchery" 
                    data-type="switchery" 
                    data-classInput="switcher-single" 
                    data-name="required" 
                    data-title="Is Required ?" 
                    data-source="{'1': 'Yes'}"
                    data-value="0" 
                    data-emptytext="No" 
                    data-url="{{ route('api.notice-events.update') }}"></a>
            </td>
            <td class="action-column">
                <button type="button" class="btn btn-xs btn-success btn-save" data-table="#tblNoticeEvents" data-url="{{ route('api.notice-events.store', $notice->id) }}">
                    <i class="icon-checkmark3"></i></button>
                <button type="button" class="btn btn-xs btn-danger btn-remove" data-url="/api/notice-events/delete/"><i class="icon-cross2"></i></button>
            </td>
        </tr>
    </script>
@stop