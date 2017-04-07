@if($notice->status == 'published')
    <span class="label label-success">
@elseif($notice->status == 'inactive')
            <span class="label label-danger">
@elseif($notice->status == 'draft')
                    <span class="label bg-blue">
@else
                            <span class="label label-default">
@endif
                                {{ trans('statuses.' . $notice->status) }}
</span>