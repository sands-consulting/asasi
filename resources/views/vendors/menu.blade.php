<ul class="list-group list-vendor list-prompt-side-tab panel panel-flat" role="tablist">
    <li role="presentation" class="active">
        <a href="{{ route('vendors.show', Auth::user()->vendor->id) }}#tab-vendor-details" aria-controls="tab-vendor-details" role="tab" data-toggle="tab" class="list-group-item">
            <i class=" icon-file-text"></i> {{ trans('vendors.menu.details') }}
        </a>
    </li>

    <li role="presentation">
        <a href="{{ route('vendors.show', Auth::user()->vendor->id) }}#tab-vendor-qualifications" aria-controls="tab-vendor-qualifications" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-folder-check"></i> {{ trans('vendors.menu.qualifications') }}
        </a>
    </li>

    <li role="presentation">
        <a href="{{ route('vendors.show', Auth::user()->vendor->id) }}#tab-vendor-shareholders" aria-controls="tab-vendor-shareholders" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-portfolio"></i> {{ trans('vendors.menu.shareholders') }}
        </a>
    </li>

    <li role="presentation">
        <a href="{{ route('vendors.show', Auth::user()->vendor->id) }}#tab-vendor-employees" aria-controls="tab-vendor-employees" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-users4"></i> {{ trans('vendors.menu.employees') }}
        </a>
    </li>
    <li role="presentation">
        <a href="{{ route('vendors.show', Auth::user()->vendor->id) }}#tab-vendor-accounts" aria-controls="tab-vendor-accounts" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-database4"></i> {{ trans('vendors.menu.accounts') }}
        </a>
    </li>

    <li role="presentation">
        <a href="{{ route('vendors.show', Auth::user()->vendor->id) }}#tab-vendor-files" aria-controls="tab-vendor-files" role="tab" data-toggle="tab" class="list-group-item">
            <i class="icon-stack"></i> {{ trans('vendors.menu.files') }}
        </a>
    </li>

    @can('index', App\User::class)
    <li role="presentation">
        <a href="{{ route('users.index') }}" class="list-group-item">
            <i class="icon-basket"></i> {{ trans('vendors.menu.users') }}
        </a>
    </li>
    @endcan

    @can('index', App\Subscription::class)
    <li role="presentation">    
        <a href="{{ route('subscriptions.index') }}" class="list-group-item">
            <i class="icon-file-presentation"></i> {{ trans('vendors.menu.subscriptions') }}
        </a>
    </li>
    @endcan

</ul>