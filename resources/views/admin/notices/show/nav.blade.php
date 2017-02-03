<ul class="list-group panel panel-flat">
    <a href="{{ route('admin.notices.show', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.show', ' bg-blue-300') }}">
        <i class="icon-clipboard3"></i> {{ trans('notices.navs.details') }}
    </a>
    <a href="{{ route('admin.notices.events', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.events', ' bg-blue-300') }}">
        <i class="icon-calendar3"></i> {{ trans('notices.navs.events') }}
    </a>
    <a href="{{ route('admin.notices.qualification-codes', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.qualification-codes', ' bg-blue-300') }}">
        <i class="icon-stack2"></i> {{ trans('notices.navs.qualification_codes') }}
    </a>
    <a href="{{ route('admin.notices.files', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.files', ' bg-blue-300') }}">
        <i class="icon-copy3"></i> {{ trans('notices.navs.files') }}
    </a>
</ul>

@if(Auth::user()->hasPermission('access:admin'))
<ul class="list-group panel panel-flat">
    {{-- <a href="{{ route('admin.notices.allocations', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.allocations', ' bg-blue-300') }}">
        <i class="icon-copy3"></i> {{ trans('notices.navs.allocations') }}
    </a> --}}
    {{-- <a href="{{ route('admin.notices.submission_criterias', $notice->id) }}" class="list-group-item{{ is_route_active('admin.notices.submission_criterias', ' bg-blue-300') }}">
        <i class="icon-copy3"></i> {{ trans('notices.navs.submission_criterias') }}
    </a> --}}
    <a href="{{ route('admin.evaluation-requirements.edit', $notice->id) }}" class="list-group-item{{ is_route_active('admin.evaluation-requirements.edit', ' bg-blue-300') }}">
        <i class="icon-copy3"></i> {{ trans('notices.navs.evaluation_criterias') }}
    </a>
    <a href="{{ route('admin.evaluators.index', $notice->id) }}" class="list-group-item{{ is_path_active('admin/evaluators*', ' bg-blue-300') }}">
        <i class="icon-user-check"></i> {{ trans('notices.navs.evaluators') }}
    </a>
</ul>

<ul class="list-group panel panel-flat">
    <a href="#" class="list-group-item">
        <i class="icon-user-check"></i> {{ trans('notices.navs.eligibles') }}
    </a>
    <a href="#" class="list-group-item">
        <i class="icon-basket"></i> {{ trans('notices.navs.purchases') }}
    </a>
    <a href="#" class="list-group-item">
        <i class="icon-file-presentation"></i> {{ trans('notices.navs.submissions') }}
    </a>
    <a href="#" class="list-group-item">
        <i class="icon-user-check"></i> {{ trans('notices.navs.evaluations') }}
    </a>
    <a href="#" class="list-group-item">
        <i class="icon-medal2"></i> {{ trans('notices.navs.award') }}
    </a>
</ul>
@endif