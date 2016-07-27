@extends('layouts.public')

@section('content')
<div class="page-container">
    <div class="page-content">
    	<div class="content-wrapper">
    		<div class="row">
    			<div class="col-xs-12 col-sm-12">
                    {!! Former::open_vertical(action('VendorsController@store'))->method('POST') !!}
                        @include('vendors.form')
                    {!! Former::close() !!}
				</div>
			</div>
		</div>
    </div>
</div>
@stop
