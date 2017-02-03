<span class="text-thin"><strong>{{ $notice->organization->name }}</strong> {{ $notice->number }}</span>

<br>

{!! link_to_route('notices.show', $notice->name, $notice->id) !!}