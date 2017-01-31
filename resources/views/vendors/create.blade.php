@extends('layouts.portal')

@section('content')
<div class="page-container">
    <div class="page-content">
    	<div class="content-wrapper">
    		<div class="row">
    			<div class="col-xs-12 col-sm-12">
                    {!! Former::open_vertical(action('VendorsController@store'))->method('POST') !!}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="panel-title">{{ trans('vendors.views.apply.title') }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include('vendors.form')
                                    
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary legitRipple">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {!! Former::close() !!}
                    </div>
				</div>
			</div>
		</div>
    </div>
</div>
@stop
