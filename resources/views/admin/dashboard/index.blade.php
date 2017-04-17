@extends('layouts.admin')

@section('header')
    <div class="row">
        <div class="col-sm-12 pl-15">
            <div class="page-title">
                <h4><i class="icon-home2 position-left"></i> <span class="text-semibold">User Activity Dashboard</span></h4>

                {{-- <ul class="breadcrumb breadcrumb-caret position-right">
                    <li><a href="{{ route('home.index') }}">Home</a></li>
                    <li class="active">{{ trans('subscriptions.views.history.title') }}</li>
                </ul> --}}
            </div>
            
            <div class="heading-elements">
                <div class="heading-btn-group">
                    {{--@can('user')--}}
                    <a href="{{ route('admin.dashboard.user') }}"
                       class="btn btn-link btn-float has-text text-size-small legitRipple {{ is_path_active('admin/dashboard/user') }}">
                        <i class="icon-user text-primary-700"></i> <span>USER</span>
                    </a>
                    {{--@endcan--}}
                    {{--@can('vendor')--}}
                    <a href="{{ route('admin.dashboard.vendor') }}"
                       class="btn btn-link btn-float has-text text-size-small legitRipple {{ is_path_active('admin/dashboard/vendor') }}">
                        <i class="icon-office text-primary-700"></i> <span>VENDOR</span>
                    </a>
                    {{--@endcan--}}
                    {{--<a href="{{ route('admin.dashboard.tender') }}" class="btn btn-link btn-float has-text text-size-small legitRipple {{ is_path_active('admin/dashboard/tender') }}">--}}
                    {{--<i class="icon-file-empty2 text-primary-700"></i> <span>TENDER</span>--}}
                    {{--</a>--}}
                    {{--<a href="{{ route('admin.dashboard.transaction') }}" class="btn btn-link btn-float has-text text-size-small legitRipple {{ is_path_active('admin/dashboard/transaction') }}">--}}
                    {{--<i class="icon-credit-card text-primary-700"></i> <span>TRANSACTION</span>--}}
                    {{--</a>--}}
                    {{--<a href="{{ route('admin.dashboard.portfolio') }}" class="btn btn-link btn-float has-text text-size-small legitRipple {{ is_path_active('admin/dashboard/portfolio') }}">--}}
                    {{--<i class="icon-folder2 text-primary-700"></i> <span>PORTFOLIO</span>--}}
                    {{--</a>--}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    @yield('content')
@stop
