@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>
        {{ link_to_route('admin.vendors.index', trans('vendors.title')) }} /
        {{ link_to_route('admin.vendors.show', $vendor->name, $vendor->id) }} /
        <span class="text-semibold">{{ trans('vendors.views.show.title') }}</span>
    </h4>
</div>
<div class="heading-elements">
    <div class="heading-btn-group">
        @if($vendor->canApprove())
        <a href="{{ route('admin.vendors.approve', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-blue legitRipple" data-method="PUT" data-confirm="{{ trans('app.confirmation') }}">
            <i class=" icon-checkmark4"></i> <span>{{ trans('vendors.buttons.approve') }}</span>
        </a>
        @endif
        @if($vendor->canReject())
        <a href="{{ route('admin.vendors.reject', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#reject-modal">
            <i class=" icon-cross2"></i> <span>{{ trans('vendors.buttons.reject') }}</span>
        </a>
        @endif
        @if(Auth::user()->hasPermission('vendor:update'))
        <a href="{{ route('admin.vendors.edit', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple" data-method="GET">
            <i class=" icon-pencil5"></i> <span>{{ trans('vendors.buttons.edit') }}</span>
        </a>
        @endif
        @if($vendor->canSuspend())
        <a href="{{ route('admin.vendors.suspend', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-toggle="modal" data-target="#suspend-modal">
            <i class=" icon-user-lock"></i> <span>{{ trans('vendors.buttons.suspend') }}</span>
        </a>
        @endif
        @if($vendor->canActivate())
        <a href="{{ route('admin.vendors.activate', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-success legitRipple" data-method="PUT">
            <i class=" icon-user-check"></i> <span>{{ trans('vendors.buttons.activate') }}</span>
        </a>
        @endif
        @if(Auth::user()->hasPermission('vendor:blacklist') && $vendor->canBlacklist())
        <a href="{{ route('admin.vendors.blacklist', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple" data-toggle="modal" data-target="#blacklist-modal">
            <i class=" icon-user-block"></i> <span>{{ trans('vendors.buttons.blacklist') }}</span>
        </a>
        @endif
        @if(Auth::user()->hasPermission('vendor:unblacklist') && $vendor->canUnblacklist())
        <a href="{{ route('admin.vendors.unblacklist', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text legitRipple" data-method="PUT">
            <i class=" icon-user-block"></i> <span>{{ trans('vendors.buttons.unblacklist') }}</span>
        </a>
        @endif
        @if(Auth::user()->hasPermission('vendor:update'))
        <a href="{{ route('admin.vendors.destroy', $vendor->id) }}" class="btn btn-link btn-float text-size-small has-text text-danger legitRipple" data-method="DELETE" data-confirm="{{ trans('app.confirmation') }}">
            <i class=" icon-trash"></i> <span>{{ trans('actions.delete') }}</span>
        </a>
        <a href="{{ route('admin.vendors.index') }}" class="btn btn-link btn-float text-size-small has-text legitRipple">
            <i class=" icon-undo2"></i> <span>{{ trans('actions.back') }}</span>
        </a>
        @endif
    </div>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">{{ trans('vendors.views.show.admin.title') }}: {{ $vendor->name }}</h5>
        <div class="heading-elements">
            @if ($vendor->status == 'active')
                <span class="label label-success heading-text">
            @elseif ($vendor->status == 'suspended')
                <span class="label label-danger heading-text">
            @elseif ($vendor->status == 'blacklisted')
                <span class="label bg-grey-800 heading-text">
            @else
                <span class="label label-default heading-text">
            @endif
            {{ $vendor->status }}</span>
        </div>
    </div>
    
    <div class="panel-body">
        <div class="tabbable">
            <ul class="nav nav-pills nav-pills-toolbar nav-justified">
                <li class="active"><a href="#vendor" data-toggle="tab" class="legitRipple" aria-expanded="true">Vendor Details</a></li>
                <li class=""><a href="#vendor-subscriptions" data-toggle="tab" class="legitRipple" aria-expanded="false">Subscriptions</a></li>
                <li class=""><a href="#vendor-transactions" data-toggle="tab" class="legitRipple" aria-expanded="false">Transactions</a></li>
                {{-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#" data-toggle="tab">Dropdown pill</a></li>
                        <li><a href="#" data-toggle="tab">Another pill</a></li>
                    </ul>
                </li> --}}
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="vendor">
                    @include('admin.vendors.show-vendor')
                </div>
                
                <div class="tab-pane" id="vendor-subscriptions">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Package</th>
                                <th>Started At</th>
                                <th>Expired At</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($vendor->subscriptions)
                                <?php $i = 1; ?>
                                @foreach ($vendor->subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $subscription->package->name }}</td>
                                        <td>{{ $subscription->started_at }}</td>
                                        <td>{{ $subscription->expired_at }}</td>
                                        <td>{{ strtolower($subscription->status) }}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No subscription found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="vendor-transactions">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Reference No</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($vendor->transactions)
                                <?php $i = 1; ?>
                                @foreach ($vendor->transactions as $transaction)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $transaction->reference_number }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No transaction found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


    @include('admin.vendors.modals.reject')
    @include('admin.vendors.modals.suspend')
    @include('admin.vendors.modals.blacklist')
@endsection