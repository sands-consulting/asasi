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
            {!! Former::open_for_files(route('notices.save-submission', $notice->id)) !!}
            {!! Former::hidden('submission_id', $submission->id) !!}
            {!! Former::hidden('type', 'technical') !!}
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Notice Submission (Technicals)</h5>
                </div>
                <div class="panel-body">
                    @foreach($requirements as $requirement)
                        <div class="row is-table-row">
                            <div class="col-sm-1 greyed">
                                <div class="box text-center">
                                    {!! Former::hidden('submission_detail_id['. $requirement->id .']')
                                        ->value($requirement->details->id) !!}
                                    @if(!$requirement->require_file)
                                        @if($requirement->details->value == 1) <?php $checked = 'checked'; ?>
                                        @else <?php $checked = false; ?>
                                        @endif
                                        <input type="checkbox" name="value[{{ $requirement->id }}]" class="styled" value="1" {{ $checked }}>
                                    @else
                                        <input type="checkbox" name="dummy" class="styled" value="" checked>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-11">
                                <div class="box"> 
                                    @if ($requirement->require_file)
                                        {!! Former::file('file['. $requirement->id .']')
                                            ->label(false)
                                            ->addClass('file-styled') !!}
                                        
                                        @if($requirement->details->files()->first())
                                            <a href="{{ $requirement->details->files()->first()->url }}" target="_blank" class="btn btn-success btn-xs">View File</a>
                                        @endif
                                    @endif
                                    {{ $requirement->title }}
                                </div>  
                            </div>
                        </div>
                    @endforeach
                
                    <div class="row is-table-row">
                        <div class="col-sm-12">
                            <a href="{{ route('notices.submission', $notice->id) }}" class="btn btn-default"><span class="p-20">Back</span></a>
                            <button type="submit" class="btn bg-blue pull-right"><span class="p-20">Save</span></button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Former::close() !!}
        </div>
    </div>
@stop