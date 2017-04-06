<ul class="navigation navigation-main navigation-accordion">
    <li class="{{ is_path_active('admin') }}">
        <a href="{{ route('admin') }}"><i class="icon-home4"></i><span>{{ trans('menu.access.dashboard') }}</span></a>
    </li>


    <li class="navigation-header">                               
        <span>{{ trans('menu.admin.manage') }}</span> <i class="icon-menu" title="{{ trans('menu.admin.manage') }}" data-original-title="{{ trans('menu.admin.manage') }}"></i>
    </li>


    @can('index', App\Allocation::class)
    <li class="{{ is_path_active('admin/allocations*') }}">
        <a href="{{ route('admin.allocations.index') }}"><i class="icon-coins"></i> <span>{{ trans('menu.admin.allocations') }}</span></a>
    </li>
    @endcan

    @can('index', App\Evaluation::class)
    <li class="{{ is_path_active('admin/evaluations*') }}">
        <a href="{{ route('admin.evaluations.index') }}" class="legitRipple"><i class="icon-pencil"></i> <span>{{ trans('menu.admin.evaluations') }}</span></a>
    </li>
    @endcan

    @can('index', App\News::class)
    <li class="{{ is_path_active('admin/news*') }}">
        <a href="{{ route('admin.news.index') }}"><i class="icon-newspaper"></i> <span>{{ trans('menu.admin.news') }}</span></a>
    </li>
    @endcan
    
    @can('index', App\Notice::class)
    <li class="{{ is_path_active('admin/notices*') }}">
        <a href="{{ route('admin.notices.index') }}"><i class="icon-clipboard3"></i> <span>{{ trans('menu.admin.notices') }}</span></a>
    </li>
    @endcan
    
    @can('index', App\Project::class)
    <li class="{{ is_path_active('admin/projects*') }}">
        <a href="{{ route('admin.projects.index') }}"><i class="icon-folder-check"></i> <span>{{ trans('menu.admin.projects') }}</span></a>
    </li>
    @endcan

    @can('index', App\Subscription::class)
    <li class="{{ is_path_active('admin/subscriptions*') }}">
        <a href="{{ route('admin.subscriptions.index') }}"><i class="icon-hyperlink"></i> <span>{{ trans('menu.admin.subscriptions') }}</span></a>
    </li>
    @endcan

    @can('index', App\Transaction::class)
    <li class="{{ is_path_active('admin/transactions*') }}">
        <a href="{{ route('admin.transactions.index') }}"><i class="icon-cash4"></i> <span>{{ trans('menu.admin.transactions') }}</span></a>
    </li>
    @endcan

    @can('index', App\User::class)
    <li class="{{ is_path_active('admin/users*') }}">
        <a href="{{ route('admin.users.index') }}"><i class="icon-users"></i> <span>{{ trans('menu.admin.users') }}</span></a>
    </li>
    @endcan

    @can('index', App\Vendor::class)
    <li class="{{ is_path_active('admin/vendors*') }}">
        <a href="{{ route('admin.vendors.index') }}" class="legitRipple"><i class="icon-office"></i> <span>{{ trans('menu.admin.vendors') }}</span></a>
    </li>
    @endcan


    <li class="navigation-header">                               
        <span>{{ trans('menu.admin.administration') }}</span> <i class="icon-menu" title="{{ trans('menu.admin.administration') }}" data-original-title="{{ trans('menu.admin.administration') }}"></i>
    </li>

    @can('index', App\AllocationType::class)
    <li class="{{ is_path_active('admin/allocation-types*') }}">
        <a href="{{ route('admin.allocation-types.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.allocation-types') }}</span></a>
    </li>
    @endif

    @can('index', App\NewsCategory::class)
    <li class="{{ is_path_active('admin/news-categories*') }}">
        <a href="{{ route('admin.news-categories.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.news-categories') }}</span></a>
    </li>
    @endif

    @can('index', App\NoticeCategory::class)
    <li class="{{ is_path_active('admin/notice-categories*') }}">
        <a href="{{ route('admin.notice-categories.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.notice-categories') }}</span></a>
    </li>
    @endif

    @can('index', App\NoticeType::class)
    <li class="{{ is_path_active('admin/notice-types*') }}">
        <a href="{{ route('admin.notice-types.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.notice-types') }}</span></a>
    </li>
    @endif

    @can('index', App\Organization::class)
    <li class="{{ is_path_active('admin/organizations*') }}">
        <a href="{{ route('admin.organizations.index') }}"><i class="icon-grid5"></i> <span>{{ trans('menu.admin.organizations') }}</span></a>
    </li>
    @endcan

    @can('index', App\Package::class)
    <li class="{{ is_path_active('admin/packages*') }}">
        <a href="{{ route('admin.packages.index') }}"><i class="icon-stack3"></i> <span>{{ trans('menu.admin.packages') }}</span></a>
    </li>
    @endcan

    @can('index', App\PaymentGateway::class)
    <li class="{{ is_path_active('admin/payment-gateways*') }}">
        <a href="{{ route('admin.payment-gateways.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.payment-gateways') }}</span></a>
    </li>
    @endcan

    @can('index', App\Permission::class)
    <li class="{{ is_path_active('admin/permissions*') }}">
        <a href="{{ route('admin.permissions.index') }}"><i class="icon-unlocked2"></i> <span>{{ trans('menu.admin.permissions') }}</span></a>
    </li>
    @endcan

    @can('index', App\Place::class)
    <li class="{{ is_path_active('admin/places*') }}">
        <a href="{{ route('admin.places.index') }}"><i class="icon-city"></i> <span>{{ trans('menu.admin.places') }}</span></a>
    </li>
    @endcan

    @can('index', App\QualificationCode::class)
    <li class="{{ is_path_active('admin/qualification-codes*') }}">
        <a href="{{ route('admin.qualification-codes.index') }}"><i class="icon-grid5"></i> <span>{{ trans('menu.admin.qualification-codes') }}</span></a>
    </li>
    @endcan

    @can('index', App\QualificationType::class)
    <li class="{{ is_path_active('admin/qualification-types*') }}">
        <a href="{{ route('admin.qualification-types.index') }}"><i class="icon-grid5"></i> <span>{{ trans('menu.admin.qualification-types') }}</span></a>
    </li>
    @endcan

    @can('index', App\Role::class)
    <li class="{{ is_path_active('admin/roles*') }}">
        <a href="{{ route('admin.roles.index') }}"><i class="icon-user-tie"></i> <span>{{ trans('menu.admin.roles') }}</span></a>
    </li>
    @endcan

    @can('index', App\TaxCode::class)
    <li class="{{ is_path_active('admin/tax-codes*') }}">
        <a href="{{ route('admin.tax-codes.index') }}"><i class="icon-percent"></i> <span>{{ trans('menu.admin.tax-codes') }}</span></a>
    </li>
    @endcan

    @can('index', App\VendorType::class)
    <li class="{{ is_path_active('admin/vendor-types*') }}">
        <a href="{{ route('admin.vendor-types.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.vendor-types') }}</span></a>
    </li>
    @endcan
</ul>
