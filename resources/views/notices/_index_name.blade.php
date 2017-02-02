<span class="text-header"><span class="text-semibold">{{ $notice->organization->short_name }}</span> {{ $notice->number }}</span>

<br>

{!! link_to_route('notices.show', $notice->name, $notice->id) !!}