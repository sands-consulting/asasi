@if ($evaluator->status == 'active')
    <span class="label label-success heading-text">
@elseif ($evaluator->status == 'rejected')
    <span class="label label-danger heading-text">
@else
    <span class="label label-default heading-text">
@endif
{{ $evaluator->status }}</span>