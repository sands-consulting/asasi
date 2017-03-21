<ul class="list-group list-notice list-prompt-side-tab panel panel-flat" role="tablist">
    <li role="presentation" class="active">
        <a href="#tab-notice-details" aria-controls="tab-notice-details" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-clipboard3"></i> {{ trans('notices.menu.details') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-notice-events" aria-controls="tab-notice-events" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-calendar3"></i> {{ trans('notices.menu.events') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-notice-qualifications" aria-controls="tab-notice-qualifications" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-stack2"></i> {{ trans('notices.menu.qualifications') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-notice-files" aria-controls="tab-notice-files" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-copy3"></i> {{ trans('notices.menu.files') }}
        </a>
    </li>

    @unless(Auth::user()->hasPermission('access:vendor'))


    <li class="list-group-divider"></li>


    <li role="presentation">
        <a href="#tab-notice-allocations" aria-controls="tab-notice-allocations" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-cash4"></i> {{ trans('notices.menu.allocations') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-notice-submission-criterias" aria-controls="tab-notice-submission-criterias" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-list-numbered"></i> {{ trans('notices.menu.submission-criterias') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-notice-evaluation-criterias" aria-controls="tab-notice-evaluation-criterias" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-clipboard2"></i> {{ trans('notices.menu.evaluation-criterias') }}
        </a>
    </li>


    <li class="list-group-divider"></li>


    @if($notice->invitation)
    <li role="presentation">
        <a href="#tab-notice-invitations" aria-controls="tab-notice-invitations" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-mailbox"></i> {{ trans('notices.menu.invitations') }}
        </a>
    </li>
    @else
    <li role="presentation">    
        <a href="#tab-notice-eligibles" aria-controls="tab-notice-eligibles" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-users4"></i> {{ trans('notices.menu.eligibles') }}
        </a>
    </li>
    @endif

    <li role="presentation">    
        <a href="#tab-notice-purchases" aria-controls="tab-notice-purchases" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-basket"></i> {{ trans('notices.menu.purchases') }}
        </a>
    </li>

    <li role="presentation">    
        <a href="#tab-notice-submissions" aria-controls="tab-notice-submissions" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-file-presentation"></i> {{ trans('notices.menu.submissions') }}
        </a>
    </li>


    <li class="list-group-divider"></li>


    <li role="presentation">
        <a href="#tab-notice-evaluators" class="list-group-item">
            <i class="icon-user-check"></i> {{ trans('notices.menu.evaluators') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-notice-evaluations" class="list-group-item">
            <i class="icon-stack-check"></i> {{ trans('notices.menu.evaluations') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-notice-award" aria-controls="tab-notice-award" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-medal2"></i> {{ trans('notices.menu.award') }}
        </a>
    </li>

    <li class="list-group-divider"></li>

    <li role="presentation">
        <a href="#tab-notice-settings" aria-controls="tab-notice-settings" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-cogs"></i> {{ trans('notices.menu.settings') }}
        </a>
    </li>

    @endunless
</ul>