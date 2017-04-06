@if($taxCode->status == 'active')
    <span class="label label-success">
@elseif($taxCode->status == 'inactive')
            <span class="label label-danger">
@else
                    <span class="label label-default">
@endif
                        {{ trans('statuses.' . $taxCode->status) }}
</span