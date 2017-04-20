@if($evaluation->status == 'active')

<a href="{{ route('admin.evaluations.edit', $evaluation->id) }}">
 	<i class="icon-file-zip"></i>
</a>

@else

<a href="{{ route('admin.evaluations.accept', ['notice_id' => $evaluation->notice_id]) }}">
 	<i class="icon-enter2"></i>
</a>

@endif