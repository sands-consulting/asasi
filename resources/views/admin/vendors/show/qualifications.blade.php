<div role="tabpanel" class="tab-pane" id="tab-vendor-qualifications">
    <div class="panel"><table class="table table-bordered table-condensed ">
    @foreach($vendor->qualifications()->with('type')->get() as $qualification)
        <thead class="bg-blue-700">
            <tr>
                <th colspan="2">{{ $qualification->type->name }}</th>
            </tr>
        </thead>
        <tbody>
        @if($qualification->type->validity || $qualification->type->reference_one || $qualification->type->reference_two)
        
        @if($qualification->type->reference_one)
        <tr>
            <th class="col-xs-3">{{ $qualification->type->reference_one }}</th>
            <td>{{ $qualification->reference_one }}</td>
        </tr>
        @endif

        @if($qualification->type->reference_two)
        <tr>
            <th class="col-xs-3">{{ $qualification->type->reference_two }}</th>
            <td>{{ $qualification->reference_two }}</td>
        </tr>
        @endif

        @if($qualification->type->validity)
        <tr>
            <th class="col-xs-3">{{ trans('qualification-types.attributes.start_at') }}</th>
            <td>{{ $qualification->start_at->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th class="col-xs-3">{{ trans('qualification-types.attributes.end_at') }}</th>
            <td>{{ $qualification->end_at->format('d/m/Y') }}</td>
        </tr>
        @endif
    
        @endif
        
        @if($qualification->type->type == 'list')
        <tr>
            <th>{{ trans('qualification-types.attributes.codes') }}</th>
            <td class="qualification-codes">
                <table class="table table-bordered">
                    @forelse($vendor->codes()->whereTypeId($qualification->type_id)->whereNull('parent_id')->get() as $vendorCode)
                    <?php $childCount = $vendorCode->children()->count(); ?>
                    <tr>
                        <th colspan="{{ $childCount }}">{{ $vendorCode->code->label }}</th>
                    </tr>
                    @if($childCount > 0)
                    @foreach($vendorCode->children()->get() as $child)
                    <tr>
                        @if($loop->first)<td rowspan="{{ $childCount }}">@endif
                        <td>{{ $child->code->label }}</td>
                    </td>
                    @endforeach
                    @endif
                    @empty
                    <tr>
                        <td>{{ trans('vendors.views.admin.show.details.qualifications.empty') }}</td>
                    </tr>
                    @endforelse
                </table>
            </td>
        </tr>
        @endif
        </tbody>
    @endforeach
    </table></div>
</div>