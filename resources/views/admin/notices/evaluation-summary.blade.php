@extends('layouts.admin')

@section('page-title', trans('evaluations.title'))

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.notices.index', trans('notices.title')) }} /
        <span class="text-semibold">{{ trans('notices.views.summary.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if($notice->canPublish() && Auth::user()->hasPermission('notice:publish'))
        <a href="{{ route('admin.notices.publish', $notice->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple">
            <i class="icon-check"></i> <span>{{ trans('actions.publish') }}</span>
        </a>
        @endif

        @if($notice->canUnpublish() && Auth::user()->hasPermission('notice:unpublish'))
        <a href="{{ route('admin.notices.unpublish', $notice->id) }}" data-method="PUT" class="btn btn-link btn-float text-size-small has-text text-warning legitRipple">
            <i class="icon-minus-circle2"></i> <span>{{ trans('actions.unpublish') }}</span>
        </a>
        @endif
        
        @if($notice->canCancel())
        <a href="{{ route('admin.notices.cancel', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#cancel-modal">
            <i class=" icon-cancel-circle2"></i> <span>{{ trans('actions.cancel') }}</span>
        </a>
        @endif
        
        @if(Auth::user()->hasPermission('notice:update'))
        <a href="{{ route('admin.notices.edit', $notice->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class="icon-pencil5"></i> <span>{{ trans('actions.edit') }}</span>
        </a>
        @endif

        @if(Auth::user()->hasPermission('notice:delete'))
        <a href="#" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#delete-modal">
            <i class=" icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        @endif

        <a href="{{ route('admin.notices.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-10">
                        <span class="text-muted">{{ $notice->number}} (<i>{{ $notice->organization->name}}</i>)</span>
                        <div><a href="{{ route('admin.notices.show', $notice->id) }}">{{ $notice->name }}</a></div>
                        <div class="text-muted">{{ !empty($notice->description) ? nl2br($notice->description) : 'N/A' }}</div>
                    </div>
                    <div class="heading-elements">
                        @if ($notice->status == 'published')
                            <span class="label label-success heading-text">
                        @elseif ($notice->status == 'cancelled')
                            <span class="label label-danger heading-text">
                        @else
                            <span class="label label-default heading-text">
                        @endif
                        {{ $notice->status }}</span>
                        <ul class="icons-list">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-cog3"></i><span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#">Notices</a></li>
                                    <li><a href="{{ route('admin.evaluation-requirements.edit', $notice->id) }}">{{ trans('evaluation-requirements.title') }}</a></li>
                                    <li><a href="{{ route('admin.evaluators.index', $notice->id) }}">Evaluators</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">All Settings</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Evaluation Summary</h6>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Vendor Name</th>
                        <th class="text-center">Technical Score</th>
                        <th class="text-center">Commercial Score</th>
                        <th class="text-center">Offered Price</th>
                        <th>Offered Duration</th>
                        <th>Winner</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendors as $vendor)
                    <tr>
                        <td>{{ $vendor->id }}</td>
                        <td><a href="{{ route('admin.vendors.show', $vendor->id) }}">{{ $vendor->name }}</a></td>
                        <td class="text-right">{{ trim_trailing_zeroes($vendor->technical_score) }} %</td>
                        <td class="text-right">{{ trim_trailing_zeroes($vendor->commercial_score) }} %</td>
                        <td class="text-right">{{ 'RM' }} {{ trim_trailing_zeroes($vendor->offered_price) }}</td>
                        <td>{{ $vendor->offered_duration }}</td>
                        <td>
                            <a href="{{ route('admin.notices.award', [$notice->id, $vendor->id]) }}" class="btn btn-primary btn-xs" data-method="POST">Award</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.notices.award', [$notice->id, $vendor->id]) }}" class="btn btn-default btn-xs"><i class="icon-list3"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="panel-body"></div>
        </div>
    </div>
</div>
@endsection