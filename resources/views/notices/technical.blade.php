@extends('layouts.public')

@section('header')
    <div class="page-title">
        <h4><i class="icon-file-text position-left"></i> <span class="text-semibold">{{ trans('notices.views.technical.title') }}</span></h4>

        {{-- <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li class="active">{{ trans('subscriptions.views.history.title') }}</li>
        </ul> --}}
    </div>
    
    @if(Auth::user() && Auth::user()->hasPermission('access:vendor'))
    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('subscriptions.current') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-stack text-indigo-400"></i> <span>My Package</span></a>
            <a href="{{ route('notices.my-notices') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-clipboard3 text-indigo-400"></i> <span>My Notices</span></a>
        </div>
    </div>
    @endif
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <table class="table table-striped table-bordered table-lg">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$requirements->isEmpty())
                            @foreach($requirements as $requirement)
                            <tr>
                                <td>#</td>
                                <td>{{ $requirement->title }}</td>
                                <td>
                                    @if($requirement->require_file)
                                        {{ Former::file($requirement->id)
                                            ->label(false)
                                            ->addClass('file-input') }}
                                    @else
                                        checkbox
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop