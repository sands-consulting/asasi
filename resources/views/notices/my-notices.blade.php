@extends('layouts.public')

@section('header')
    <div class="page-title">
        <h4><i class="icon-clipboard3 position-left"></i> <span class="text-semibold">{{ trans('notices.views.my_notices.title') }}</span></h4>

        {{-- <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li class="active">{{ trans('subscriptions.views.history.title') }}</li>
        </ul> --}}
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="panel-title">{{ trans('notices.title') }}</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Number</th>
                            <th>Description</th>
                            <th>Organization</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($myNotices))
                            <?php $i=1; ?>
                            @foreach($myNotices as $myNotice)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $myNotice->number }}</td>
                                <td>{{ $myNotice->description }}</td>
                                <td>{{ $myNotice->organization->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle legitRipple" data-toggle="dropdown">Action <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="{{ route('notices.submission', $myNotice->id) }}">
                                                    <i class="icon-compose"></i> {{ trans('notices.buttons.submission') }}
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="{{ route('payments.invoice', $vendor->transactionDetails(function ($query) {
                                                        return $query->where('detailable_type', 'App\Notice')
                                                            ->where('detailable_id', $myNotice->id);
                                                    })->first()->transaction_id) }}" target="_blank">
                                                    <i class="icon-calculator"></i> {{ trans('notices.buttons.invoice') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('payments.receipt', $vendor->transactionDetails(function ($query) {
                                                        return $query->where('detailable_type', 'App\Notice')
                                                            ->where('detailable_id', $myNotice->id);
                                                    })->first()->transaction_id) }}" target="_blank">
                                                    <i class="icon-newspaper"></i> {{ trans('notices.buttons.receipt') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop