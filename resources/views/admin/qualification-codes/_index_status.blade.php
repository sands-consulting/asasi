@if($code->status == 'active')
<span class="label label-success">
@else
<span class="label label-default">
@endif

{{ trans('statuses.' . $code->status) }}

</span>