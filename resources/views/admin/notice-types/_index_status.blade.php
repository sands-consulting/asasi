@if($noticeType->status == 'active')
<span class="label label-success">
@elseif($noticeType->status == 'inactive')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $noticeType->status) }}

</span>
