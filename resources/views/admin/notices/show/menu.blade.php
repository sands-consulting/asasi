<ul class="list-group list-notice list-prompt-side-tab panel panel-flat" role="tablist">
    <li role="presentation" class="active">
        <a href="#tab-notice-details" aria-controls="tab-notice-details" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-clipboard3"></i> <span class="text-size-mini">{{ trans('notices.menu.details') }}</span>
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-notice-events" aria-controls="tab-notice-events" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-calendar3"></i> <span class="text-size-mini">{{ trans('notices.menu.events') }}</span>
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-notice-qualifications" aria-controls="tab-notice-qualifications" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-stack2"></i> <span class="text-size-mini">{{ trans('notices.menu.qualifications') }}</span>
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-notice-files" aria-controls="tab-notice-files" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-copy3"></i> <span class="text-size-mini">{{ trans('notices.menu.files') }}</span>
        </a>
    </li>

    @if(Auth::check() && is_path('admin*') && !Auth::user()->hasPermission('access:vendor'))


    <li class="list-group-divider"></li>


    <li role="presentation">
        <a href="#tab-notice-allocations" aria-controls="tab-notice-allocations" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-cash4"></i> <span class="text-size-mini">{{ trans('notices.menu.allocations') }}</span>
        </a>
    </li>

    @if(setting('submission', false, $notice))

    <li role="presentation">
        <a href="#tab-notice-submission-requirements" aria-controls="tab-notice-submission-requirements" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-list-numbered"></i> <span
                    class="text-size-mini">{{ trans('notices.menu.submission-requirements') }}</span>
        </a>
    </li>

    @endif

    @if(setting('evaluation', false, $notice))

    <li role="presentation">
        <a href="#tab-notice-evaluation-requirements" aria-controls="tab-notice-evaluation-requirements" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-clipboard2"></i> <span
                    class="text-size-mini">{{ trans('notices.menu.evaluation-requirements') }}</span>
        </a>
    </li>

    @endif


    <li class="list-group-divider"></li>


    @if($notice->invitation)
    <li role="presentation">
        <a href="#tab-notice-invitations" aria-controls="tab-notice-invitations" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-mailbox"></i> <span class="text-size-mini">{{ trans('notices.menu.invitations') }}</span>
        </a>
    </li>
    @else
    <li role="presentation">    
        <a href="#tab-notice-eligibles" aria-controls="tab-notice-eligibles" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-users4"></i> <span class="text-size-mini">{{ trans('notices.menu.eligibles') }}</span>
        </a>
    </li>
    @endif

    @if(setting('purchase', false, $notice))

    <li role="presentation">    
        <a href="#tab-notice-purchases" aria-controls="tab-notice-purchases" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-basket"></i> <span class="text-size-mini">{{ trans('notices.menu.purchases') }}</span>
        </a>
    </li>

    @endif

    @if(setting('submission', false, $notice) && Auth::user()->hasPermission('submission:index'))

    <li class="list-group-divider"></li>

    <li role="presentation">    
        <a href="#tab-notice-submissions" aria-controls="tab-notice-submissions" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-file-presentation"></i> <span
                    class="text-size-mini">{{ trans('notices.menu.submissions') }}</span>
        </a>
    </li>

    @endif

    @if(setting('evaluation', false, $notice) && Auth::user()->hasPermission('evaluation:index'))

    <li class="list-group-divider"></li>

    <li role="presentation">
        <a href="#tab-notice-evaluations" class="list-group-item" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-stack-check"></i> <span class="text-size-mini">{{ trans('notices.menu.evaluations') }}</span>
        </a>
    </li>

    @endif

    @if(setting('award', false, $notice) && Auth::user()->hasPermission('notice:award'))

    <li role="presentation">
        <a href="#tab-notice-award" aria-controls="tab-notice-award" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-medal2"></i> <span class="text-size-mini">{{ trans('notices.menu.award') }}</span>
        </a>
    </li>

    @endif

    @endif
</ul>