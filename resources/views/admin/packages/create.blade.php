@extends('layouts.app')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.packages.index', trans('packages.views.index.title')) }} /
        <span class="text-semibold">{{ trans('packages.views.create.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        <a href="{{ route('admin.packages.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        {!! Former::open(route('admin.packages.index'))->method('POST') !!}
            @include('admin.packages.form')
            <div class="row">
                <div class="col-sm-12 col-md-8 col-md-offset-4">
                    {!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
                    {!! link_to_route('admin.packages.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}
                </div>
            </div>
        {!! Former::close() !!}
    </div>
</div>
@endsection