@if(Auth::user())

@if(is_path('admin*'))

    <li>
        <a href="{{ route('root') }}"><i class="icon-atom2"></i> {{ trans('menu.access.portal') }}</a>
    </li>

    @if(Auth::user()->hasPermission('access:reports'))
    <li>
        <a href="{{ route('admin') }}"><i class="icon-file-text"></i> {{ trans('menu.access.reports') }}</a>
    </li>
    @endif

    @if(Auth::user()->hasPermission('access:settings'))
    <li>
        <a href="{{ route('settings') }}"><i class="icon-cogs"></i> <span>{{ trans('menu.access.settings') }}</span></a>
    </li>
    @endif

@elseif(is_path('reports*'))

    

@else

    @if(Auth::user()->hasPermission('access:vendor'))

    @unless(is_path(['/', 'notices*', 'news*', 'submissions*', 'awards*', 'contact*']))
    <li>
        <a href="{{ route('root') }}">{{ trans('menu.access.portal') }}</a>
    </li>
    @endunless
    
    @unless(is_path(['vendors*', 'me/bookmarks']))
    <li>
        <a href="{{ route('vendors.eligibles', Auth::user()->vendor->id) }}">{{ trans('menu.access.dashboard') }}</a>
    </li>
    @endunless

    @endif

    @if(Auth::user()->hasPermission('access:administration'))
    <li>
        <a href="{{ route('admin') }}">{{ trans('menu.access.administration') }}</a>
    </li>
    @endif

    @if(Auth::user()->hasPermission('access:reports'))
    <li>
        <a href="{{ route('reports') }}">{{ trans('menu.access.reports') }}</a>
    </li>
    @endif

     @if(Auth::user()->hasPermission('access:settings'))
    <li>
        <a href="{{ route('settings') }}">{{ trans('menu.access.settings') }}</a>
    </li>
    @endif

@endif

@endif