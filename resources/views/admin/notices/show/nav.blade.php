<ul class="list-group list-notice panel panel-flat" role="tablist">
    <li role="presentation">
        <a href="#tab-notice-details" aria-controls="tab-notice-details" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-clipboard3"></i> {{ trans('notices.navs.details') }}
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-notice-events" aria-controls="tab-notice-events" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-calendar3"></i> {{ trans('notices.navs.events') }}
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-notice-qualifications" aria-controls="tab-notice-qualifications" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-stack2"></i> {{ trans('notices.navs.qualifications') }}
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-notice-files" aria-controls="tab-notice-files" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-copy3"></i> {{ trans('notices.navs.files') }}
        </a>
    </li>

    @if(!is_path_active('admin*') && $notice->awarded)
    <li role="presentation">
        <a href="#tab-notice-award" aria-controls="tab-notice-award" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-medal2"></i> {{ trans('notices.navs.award') }}
        </a>
    </li>
    @endif
</ul>

@if(is_path_active('admin*'))
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