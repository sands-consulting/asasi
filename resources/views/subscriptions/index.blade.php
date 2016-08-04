@extends('layouts.public')

@section('content')
<div class="page-container">
    <div class="page-content">
    	<div class="content-wrapper">
    		<div class="row">
    			<div class="col-xs-12 col-sm-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h4 class="panel-title">{{ trans('subscriptions.views.index.public.title') }}</h4>
                        </div>

                        <div class="panel-body">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
				</div>
			</div>
		</div>
    </div>
</div>
@stop

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection
