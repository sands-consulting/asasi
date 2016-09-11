@extends('layouts.admin')

@extends('layouts.admin')

@section('page-title', implode(' | ', [
    $user->name,
    trans('users.title')
]))

@section('header')
<div class="page-title">
    {{-- <h4>{{ link_to_route('admin.users.index', trans('users.title')) }} / <span class="text-semibold">{{ $user->name }}</span></h4> --}}
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
{{--         @if($user->canActivate() && Auth::user()->hasPermission('user:activate'))
        <a href="{{ route('admin.users.activate', $user->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
            <i class="icon-user-check"></i> <span>{{ trans('actions.activate') }}</span>
        </a>
        @endif

        @if($user->canSuspend() && Auth::user()->hasPermission('user:suspend'))
        <a href="{{ route('admin.users.suspend', $user->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
            <i class="icon-user-block"></i> <span>{{ trans('actions.suspend') }}</span>
        </a>
        @endif

        @if(Auth::user()->id != $user->id && Auth::user()->hasPermission('user:assume'))
        <a href="{{ route('admin.users.assume', $user->id) }}" data-method="POST" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
            <i class="icon-user-lock"></i> <span>{{ trans('users.buttons.assume') }}</span>
        </a>
        @endif

        @if(Auth::user()->hasPermission('user:update'))
        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('users.buttons.edit') }}</span>
        </a>
        @endif

        @if(Auth::user()->id != $user->id && Auth::user()->hasPermission('user:delete'))
        <a href="{{ route('admin.users.destroy', $user->id) }}" data-method="DELETE" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple">
            <i class="icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        @endif --}}
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ 'Header' }}</h5>
        <div class="heading-elements">
            @include('admin.users._index_status')
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            @foreach ($commRequirements as $commRequirement)
            <tr>
                <td>{{ $commRequirement->title }}</td>
                <td>{{ $commRequirement->mandatory }}</td>
                <td>{{ $commRequirement->require_file }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection