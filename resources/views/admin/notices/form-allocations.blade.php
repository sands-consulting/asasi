<fieldset title="2">
    <legend class="text-semibold">Notice Allocation</legend>

    <div class="row">
        <div class="col-md-12">
            <table id="tblAllocations" class="table" style="margin-bottom: 20px">
                <thead>
                    <tr>
                       <th>Allocation</th>
                       <th width="10%">Amount</th>
                       <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @if (isset($noticeEvents) && !$noticeEvents->isEmpty())
                        <tr class="table-empty" style="display:none">
                            <td colspan="4">
                                {!! trans('notice-events.views.create.table.empty') !!}
                            </td>
                        </tr>
                        @foreach($noticeEvents as $noticeEvent)
                        <tr data-id="{{ $noticeEvent->id }}">
                            <td>
                                <a href="#" class="myeditable" data-type="select" data-name="allocation_id" data-source="{{ App\NoticeEventType::options() }}" 
                                    data-pk="{{ $noticeEvent->id }}"
                                    data-url="{{ route('api.notice-events.update') }}">{{ $noticeEvent->type->name }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable" data-type="text" data-name="name" 
                                    data-pk="{{ $noticeEvent->id }}" 
                                    data-url="{{ route('api.notice-events.update') }}">{{ $noticeEvent->name }}</a>
                            </td>
                            <td class="action-column">
                                <button type="button" class="btn btn-xs btn-danger btn-remove" data-url="/api/notice-events/delete/"><i class="icon-cross2"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    @else --}}
                        <tr class="table-empty">
                            <td colspan="6">
                                {!! trans('notice-events.views.create.table.empty') !!}
                            </td>
                        </tr>
                    {{-- @endif --}}
                    <tr>
                        <td colspan="6">
                            <button type="button" class="btn btn-xs btn-info btn-add" data-template="#allocationRow"><i class="icon-add"></i> Add new row</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</fieldset>

@section('scripts')
    @parent
    <script id="allocationRow" type="text/x-template">
        <tr>
            <td>
                <a href="#" class="myeditable" 
                    data-type="select"
                    data-name="allocation_id"
                    data-source="{{ App\NoticeEventType::options() }}" 
                    data-value=""
                    data-url="{{ route('api.notice-events.update') }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable" data-type="text" data-name="amount" data-url="{{ route('api.notice-events.update') }}"></a>
            </td>
            <td class="action-column">
                <button type="button" class="btn btn-xs btn-success btn-save" data-table="#tblNoticeEvents" data-url="{{ route('api.notice-events.store') }}"><i class="icon-checkmark3"></i></button>
                <button type="button" class="btn btn-xs btn-danger btn-remove" data-url="/api/notice-events/delete/"><i class="icon-cross2"></i></button>
            </td>
        </tr>
    </script>
@stop