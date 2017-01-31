@extends('layouts.portal')

@section('content')
<div class="page-container">
    <div class="page-content">
    	<div class="content-wrapper">
    		<div class="row">
    			<div class="col-sm-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">{{ trans('home.views.index.panels.vendors.title') }}</h6>
                        </div>

                        <div class="panel-body">
                            @if (!empty($vendor))
                                {!! Former::setOption('TwitterBootstrap3.labelWidths', array('large' => 5, 'small' => 5)) !!}
                                {!! Former::open_horizontal()->method('POST') !!}
                                    {!! Former::populate($vendor) !!}
                                    
                                    {!! Former::text('name')
                                        ->label('vendors.attributes.name')
                                        ->readonly() !!}

                                    {!! Former::text('created_at')
                                        ->label('vendors.attributes.created_at')
                                        ->forceValue($vendor->created_at->format('d-m-Y'))
                                        ->readonly() !!}

                                    {!! Former::text('status')
                                        ->label('vendors.attributes.status')
                                        ->forceValue(trans("statuses.$vendor->status"))
                                        ->readonly() !!}
                                    @if ($vendor->status != 'approved')
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                            @if ($vendor->status == 'draft')
                                                {!! link_to_route('vendors.edit', trans('vendors.buttons.edit-application'), $vendor->id, ['class' => 'btn btn-default btn-block']) !!}
                                                {!! Former::submit(trans('vendors.buttons.complete-application'))
                                                    ->addClass('btn-block bg-blue')
                                                    ->data_confirm(trans('app.confirmation'))
                                                    ->formaction(route('vendors.complete-application', $vendor->id)) !!}
                                            @endif
                                            @if($vendor->status == 'pending-approval')
                                                {!! Former::submit(trans('vendors.buttons.cancel-application'))
                                                    ->addClass('btn-block btn-danger')
                                                    ->data_confirm(trans('app.confirmation'))
                                                    ->formaction(route('vendors.cancel-application', $vendor->id)) !!}
                                            @endif
                                            @if($vendor->status == 'rejected')
                                                {!! link_to_route('vendors.create', trans('vendors.buttons.create-application'), [], ['class' => 'btn btn-default bg-blue btn-block']) !!}
                                            @endif
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    {!! link_to_route('vendors.create', trans('vendors.buttons.create-application')) !!}
                                @endif
                            {!! Former::close() !!}
                        </div>
                    </div>
                </div>
			</div>
		</div>
    </div>
</div>
@stop
