<ul class="navigation navigation-main navigation-accordion">
    <li class="{{ is_path_active('admin') }}">
        <a href="{{ route('admin') }}"><i class="icon-home4"></i><span>{{ trans('menu.dashboard') }}</span></a>
    </li>

    <li class="navigation-header">                               
        <span>{{ trans('menu.admin.manage.title') }}</span> <i class="icon-menu" title="{{ trans('menu.admin.manage.title') }}" data-original-title="{{ trans('menu.admin.manage.title') }}"></i>
    </li>

    @can('index', App\Allocation::class)
    <li class="{{ is_path_active('admin/allocations*') }}">
        <a href="{{ route('admin.allocations.index') }}"><i class="icon-coins"></i> <span>{{ trans('menu.admin.manage.allocations') }}</span></a>
    </li>
    @endcan

    @can('index', App\Evaluation::class)
    <li class="{{ is_path_active('admin/evaluations*') }}">
        <a href="{{ route('admin.evaluations.index') }}" class="legitRipple">
            <i class="icon-pencil"></i> <span>{{ trans('menu.admin.manage.evaluations.index') }}</span>
        </a>
    </li>
    @endcan

    @can('index', App\News::class)
    <li class="{{ is_path_active('admin/news*') }}">
        <a href="{{ route('admin.news.index') }}"><i class="icon-newspaper"></i> <span>{{ trans('menu.admin.manage.news') }}</span></a>
    </li>
    @endcan
    
    @can('index', App\Notice::class)
    <li class="{{ is_path_active('admin/notices*') }}">
        <a href="{{ route('admin.notices.index') }}"><i class="icon-clipboard3"></i> <span>{{ trans('menu.admin.manage.notices') }}</span></a>
    </li>
    @endcan
    
    @can('index', App\Project::class)
    <li class="{{ is_path_active('admin/projects*') }}">
        <a href="{{ route('admin.projects.index') }}"><i class="icon-folder-check"></i> <span>{{ trans('menu.admin.manage.projects') }}</span></a>
    </li>
    @endcan

    @can('index', App\Subsscription::class)
    <li class="{{ is_path_active('admin/subscriptions*') }}">
        <a href="{{ route('admin.subscriptions.index') }}"><i class="icon-envelope"></i> <span>{{ trans('menu.admin.manage.subscriptions') }}</span></a>
    </li>
    @endcan

    @can('index', App\Vendor::class)
    <li class="{{ is_path_active('admin/vendors*') }}">
        <a href="{{ route('admin.vendors.index') }}" class="legitRipple"><i class="icon-office"></i> <span>{{ trans('menu.admin.manage.vendors') }}</span></a>
    </li>
    @endcan

    <li class="navigation-header">                               
        <span>{{ trans('menu.admin.administration.title') }}</span> <i class="icon-menu" title="{{ trans('menu.admin.administration.title') }}" data-original-title="{{ trans('menu.admin.administration.title') }}"></i>
    </li>

    @if(Auth::user()->hasPermission('user:index'))
    <li class="{{ is_path_active('admin/users*') }}">
        <a href="{{ route('admin.users.index') }}"><i class="icon-users"></i> <span>{{ trans('menu.admin.administration.users') }}</span></a>
    </li>
    @endif

    @if(Auth::user()->hasPermission('role:index'))
    <li class="{{ is_path_active('admin/roles*') }}">
        <a href="{{ route('admin.roles.index') }}"><i class="icon-user-tie"></i> <span>{{ trans('menu.admin.administration.roles') }}</span></a>
    </li>
    @endif

    @if(Auth::user()->hasPermission('permission:index'))
    <li class="{{ is_path_active('admin/permissions*') }}">
        <a href="{{ route('admin.permissions.index') }}"><i class="icon-unlocked2"></i> <span>{{ trans('menu.admin.administration.permissions') }}</span></a>
    </li>
    @endif

    @if(Auth::user()->hasPermission('organization:index'))
    <li class="{{ is_path_active('admin/organizations*') }}">
        <a href="{{ route('admin.organizations.index') }}"><i class="icon-grid5"></i> <span>{{ trans('menu.admin.administration.organizations') }}</span></a>
    </li>
    @endif

    @if(Auth::user()->hasPermission('package:index'))
    <li class="{{ is_path_active('admin/packages*') }}">
        <a href="{{ route('admin.packages.index') }}"><i class="icon-stack3"></i> <span>{{ trans('menu.admin.administration.packages') }}</span></a>
    </li>
    @endif

    @if(Auth::user()->hasPermissions(['qualification-code:index', 'qualification-code-type:index']))
    <li class="{{is_path_active('admin/qualification*') }}">
        <a href="{{ route('admin.qualification-codes.index') }}" class="has-ul legitRipple">
            <i class="icon-drawer3"></i> <span>{{ trans('menu.admin.administration.qualification-codes') }}</span>
        </a>
        <ul class="hidden-ul">
            <li class="{{ is_path_active('admin/qualification-codes*') }}">
                <a href="{{ route('admin.qualification-codes.index') }}" class="legitRipple">{{ trans('menu.admin.administration.qualification-codes') }}</a>
            </li>
            {{--<li class="{{ is_path_active('admin/qualification-types*') }}">--}}
                {{--<a href="{{ route('admin.qualification-types.index') }}" class="legitRipple">{{ trans('menu.admin.administration.qualification-types') }}</a>--}}
            {{--</li>--}}
        </ul>
    </li>
    @endif

    @if(Auth::user()->hasPermission('place:index'))
    {{--<li class="{{ is_path_active('admin/places*') }}">--}}
        {{--<a href="{{ route('admin.places.index') }}"><i class="icon-city"></i> <span>{{ trans('menu.admin.administration.places') }}</span></a>--}}
    {{--</li>--}}
    @endif

    <li class="navigation-header">                               
        <span>{{ trans('menu.admin.settings.title') }}</span> <i class="icon-cogs" title="{{ trans('menu.admin.settings.title') }}" data-original-title="{{ trans('menu.admin.settings.title') }}"></i>
    </li>
    
    @if(Auth::user()->hasPermission('payment-gateways:index'))
    <li class="{{ is_path_active('admin/payment-gateways*') }}">
        <a href="{{ route('admin.organizations.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.settings.payment-gateways') }}</span></a>
    </li>
    @endif

    @if(Auth::user()->hasPermission('allocation-type:index'))
    <li class="{{ is_path_active('admin/allocation-types*') }}">
        <a href="{{ route('admin.allocation-types.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.settings.allocation-types') }}</span></a>
    </li>
    @endif

    @if(Auth::user()->hasPermission('news-category:index'))
    <li class="{{ is_path_active('admin/news-categories*') }}">
        <a href="{{ route('admin.news-categories.index') }}"><i class="icon-cog3"></i> <span>{{ trans('menu.admin.settings.news-categories') }}</span></a>
    </li>
    @endif

</ul>