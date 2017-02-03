<fieldset title="2">
    <legend class="text-semibold">Notice Allocation</legend>

    <div class="row">
        <div class="col-md-12">
            <table id="tblNoticeAllocations" class="table" style="margin-bottom: 20px">
                <thead>
                    <tr>
                       <th width="50%">Allocation</th>
                       <th width="35%">Amount</th>
                       <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$notice->allocations->isEmpty())
                        <tr class="table-empty" style="display:none">
                            <td colspan="4">
                                {!! trans('notices.views.admin.create.table.empty') !!}
                            </td>
                        </tr>
                        @foreach($notice->allocations as $allocation)
                        <tr data-id="{{ $allocation->pivot->id }}">
                            <td>
                                <a href="#" class="myeditable" 
                                    data-type="select"
                                    data-showbuttons="false"
                                    data-onblur="submit"
                                    data-name="allocation_id" 
                                    data-source="{{ App\Allocation::options() }}" 
                                    data-pk="{{ $allocation->id }}"
                                    data-value="{{ $allocation->id }}"
                                    data-url="{{ route('api.notice-allocations.update', $notice->id) }}">{{ $allocation->name }}</a>
                            </td>
                            <td>
                                <a href="#" class="myeditable" 
                                    data-type="text"
                                    data-name="amount" 
                                    data-pk="{{ $allocation->id }}" 
                                    data-url="{{ route('api.notice-allocations.update', $notice->id) }}">{{ $allocation->pivot->amount }}</a>
                            </td>
                            <td class="action-column">
                                <button type="button" class="btn btn-xs btn-danger btn-remove" data-url="/api/notice-allocations/delete/"><i class="icon-cross2"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr class="table-empty">
                            <td colspan="6">
                                {!! trans('notices.views.admin.create.table.empty') !!}
                            </td>
                        </tr>
                    @endif
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
                    data-showbuttons="false"
                    data-name="allocation_id"
                    data-source="{{ App\Allocation::options() }}"
                    data-url="{{ route('api.notice-allocations.update', $notice->id) }}"></a>
            </td>
            <td>
                <a href="#" class="myeditable" 
                    data-onblur="submit"
                    data-type="text"
                    data-name="amount" 
                    data-url="{{ route('api.notice-allocations.update', $notice->id) }}"></a>
            </td>
            <td class="action-column">
                <button type="button" class="btn btn-xs btn-success btn-save" data-table="#tblNoticeAllocations" data-url="{{ route('api.notice-allocations.store', $notice->id) }}"><i class="icon-checkmark3"></i></button>
                <button type="button" class="btn btn-xs btn-danger btn-remove" data-url="/api/notice-allocations/delete/"><i class="icon-cross2"></i></button>
            </td>
        </tr>
    </script>
@stop