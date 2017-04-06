@extends('layouts.portal')

@section('content')
<div class="row mb-20">
    <div class="col-xs-12 col-md-2">
        <a href="{{ route('vendors.eligibles', Auth::user()->vendor->id) }}" class="btn btn-default btn-block btn-labeled btn-raised legitRipple">
            <b><i class="icon-arrow-left52"></i></b> {{ trans('vendors.views.show.back') }}
        </a>
    </div>
</div>

@include('admin.vendors.show.header')
    
<div class="row">
    <div class="col-xs-12 col-md-3">
        @include('admin.vendors.show.menu')

        @if(Auth::user()->hasPermissions(['user:index', 'subscription:index']))
        <ul class="list-group list-vendor list-prompt-side-tab panel panel-flat mt-20" role="tablist">
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
        @endif
    </div>

    <div class="col-xs-12 col-md-9">
        @yield('inner')
    </div>
</div>
@endsection
