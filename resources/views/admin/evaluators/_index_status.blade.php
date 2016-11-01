@if ($evaluator->evaluator_status == 'active')
    <span class="label label-success heading-text">
@elseif ($evaluator->evaluator_status == 'rejected')
    <span class="label label-danger heading-text">
@else
    <span class="label label-default heading-text">
@endif
{{ $evaluator->evaluator_status }}</span>