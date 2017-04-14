@extends('layouts.admin')

@section('page-title', implode(' | ', [$notice->number, trans('notices.title')]))

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.notices.index', trans('notices.title')) }} /
        {{ $notice->number }}
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @can('publish', $notice)
        <a href="{{ route('admin.notices.publish', $notice->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
            <i class="icon-check"></i> <span>{{ trans('actions.publish') }}</span>
        </a>
        @endcan

        @can('unpublish', $notice)
        <a href="{{ route('admin.notices.unpublish', $notice->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
            <i class="icon-minus-circle2"></i> <span>{{ trans('actions.unpublish') }}</span>
        </a>
        @endcan
        
        @can('cancel', $notice)
        <a href="{{ route('admin.notices.cancel', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#cancel-modal">
            <i class=" icon-cancel-circle2"></i> <span>{{ trans('actions.cancel') }}</span>
        </a>
        @endcan

        @can('destroy', $notice)
        <a href="#" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#delete-modal">
            <i class=" icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        @endif

        @can('edit', $notice)
        <a href="{{ route('admin.notices.edit', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('actions.edit') }}</span>
        </a>
        @endcan

        @can('index', App\Notice::class)
        <a href="{{ route('admin.notices.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
        @endcan
    </div>
</div>
@endsection

@section('secondary-header')
<ul class="breadcrumb breadcrumb-caret">
    <li><a href="{{ route('admin') }}"><i class="icon-home2 position-left"></i> {{ trans('app.admin') }}</a></li>
    <li><a href="{{ route('admin.notices.index') }}">{{ trans('notices.title') }}</a></li>
</ul>
<ul class="breadcrumb-elements">
    @can('histories', $notice)
    <li>
        <a href="{{ route('admin.notices.histories', $notice->id) }}" class="legitRipple">
            <i class="icon-database-time2"></i> {{ trans('user-histories.title') }}
        </a>
    </li>
    @endcan

    @can('revisions', $notice)
    <li>
        <a href="{{ route('admin.notices.revisions', $notice->id) }}" class="legitRipple">
            <i class="icon-database-edit2"></i> {{ trans('revisions.title') }}
        </a>
    </li>
    @endcan
</ul>
@endsection

@section('content')
@include('admin.notices.show.header')

<div class="row">
    <div class="col-xs-12 col-md-2">
        @include('admin.notices.show.menu')
    </div>

    <div class="col-xs-12 col-md-10">
        <div class="tab-content">
            @include('admin.notices.show.details')
            @include('admin.notices.show.events')
            @include('admin.notices.show.qualifications')
            @include('admin.notices.show.files')

            @include('admin.notices.show.allocations')
            @include('admin.notices.show.submission-criterias')
            @include('admin.notices.show.evaluation-criterias')

            @include('admin.notices.show.eligibles')
            @include('admin.notices.show.purchases')
            @include('admin.notices.show.submissions')

            @include('admin.notices.show.evaluations')
            @include('admin.notices.show.award')
        </div>
    </div>
</div>

@include('admin.notices.show.modals.cancel')
@include('admin.notices.show.modals.delete')
@endsection
