@if($noticeCategory->status == 'active')
<span class="label label-success">
@elseif($noticeCategory->status == 'inactive')
<span class="label label-danger">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $noticeCategory->status) }}

</span>
