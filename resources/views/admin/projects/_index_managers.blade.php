@if (count($project->managers()))
    @foreach ($project->managers() as $manager)
        {{-- <img src="{{ Gravatar::src($manager->email, 40) }}" class="img-circle" alt="{{ $manager->name }}" title="{{ $manager->name }}">'; --}}
        <a href="{{ route('admin.users.show', $manager->id) }}" class="btn bg-primary-400 btn-rounded btn-icon legitRipple" title="{{ $manager->name }}">
            <span class="letter-icon">{{ get_initial($manager->name) }}</span>
        </a>
    @endforeach
@else
    <span class="text-size-small">No manager.</span>
@endif