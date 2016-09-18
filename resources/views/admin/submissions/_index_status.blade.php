@if($submission->status == 'active')
<span class="label label-success">
@elseif($submission->status == 'inactive')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $submission->status) }}

</span>