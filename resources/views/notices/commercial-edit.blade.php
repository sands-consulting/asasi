@extends('layouts.public')

@section('header')
    <div class="page-title">
        <h4><i class="icon-file-text position-left"></i> <span class="text-semibold">{{ trans('notices.views.commercial.title') }}</span></h4>

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
            {!! Former::populate($submission) !!}
            {!! Former::hidden('submission_id', $submission->id) !!}
            {!! Former::hidden('type', 'commercial') !!}
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-7"> 
                            {!! Former::text('price')
                                ->label('Offered Price')
                                ->prepend('RM')
                                ->required() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-lg">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Title</th>
                                <th width="30%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$requirements->isEmpty())
                                <?php $i = 1; ?>
                                @foreach($requirements as $requirement)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $requirement->title }}</td>
                                    <td class="text-center">
                                        {!! Former::hidden('submission_detail_id['. $requirement->id .']')
                                            ->value($requirement->details->id) !!}
                                        @if($requirement->require_file)
                                        
                                            {!! Former::file('file['. $requirement->id .']')
                                                ->label(false)
                                                ->addClass('file-styled') !!}
                                            
                                            @if($requirement->details->files()->first())
                                                <a href="{{ $requirement->details->files()->first()->url }}" target="_blank" class="btn btn-success btn-xs">View File</a>
                                            @endif
                                        @else
                                            @if($requirement->details->value == 1) <?php $checked = 'checked'; ?>
                                            @else <?php $checked = false; ?>
                                            @endif
                                            <input type="checkbox" name="value[{{ $requirement->id }}]" class="styled" value="1" {{ $checked }}>
                                            
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++; ?>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="heading-elements">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ route('notices.submission', $notice->id) }}" class="btn btn-default ml-15">Back</a>
                                <button type="submit" class="btn bg-blue pull-right">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Former::close() !!}
        </div>
    </div>
@stop