<ul class="list-group list-vendor list-prompt-side-tab panel panel-flat" role="tablist">
    <li role="presentation">
        <a href="#tab-vendor-details" aria-controls="tab-vendor-details" role="tab" data-toggle="tab" class="list-group-item">
            <i class=" icon-file-text"></i> {{ trans('vendors.menu.details') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-shareholders" aria-controls="tab-vendor-shareholders" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-portfolio"></i> {{ trans('vendors.menu.shareholders') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-qualifications" aria-controls="tab-vendor-qualifications" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-folder-check"></i> {{ trans('vendors.menu.qualifications') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-employees" aria-controls="tab-vendor-employees" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-users4"></i> {{ trans('vendors.views._form.nav.employees') }}
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-vendor-accounts" aria-controls="tab-vendor-accounts" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-database4"></i> {{ trans('vendors.views._form.nav.accounts') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-files" aria-controls="tab-vendor-files" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-stack"></i> {{ trans('vendors.menu.files') }}
        </a>
    </li>


    <li class="list-group-divider"></li>


    <li role="presentation">    
        <a href="#tab-vendor-users" aria-controls="tab-vendor-users" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-basket"></i> {{ trans('vendors.menu.users') }}
        </a>
    </li>

    <li role="presentation">    
        <a href="#tab-vendor-subscriptions" aria-controls="tab-vendor-subscriptions" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-file-presentation"></i> {{ trans('vendors.menu.subscriptions') }}
        </a>
    </li>


    @if(Auth::check() && is_path('admin*') && !Auth::user()->hasPermission('access:vendor'))


    <li class="list-group-divider"></li>


    <li role="presentation">
        <a href="#tab-vendor-eligibles" aria-controls="tab-vendor-eligibles" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-clipboard2"></i> {{ trans('vendors.menu.eligibles') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-invitations" aria-controls="tab-vendor-sinvitations" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-list-numbered"></i> {{ trans('vendors.menu.invitations') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-purchases" aria-controls="tab-vendor-purchases" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-cash4"></i> {{ trans('vendors.menu.purchases') }}
        </a>
    </li>


    @endif
</ul>