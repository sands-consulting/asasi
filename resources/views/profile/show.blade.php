@extends('layouts.public')

@section('page-title', trans('profile.title'))

@section('content')
<div class="row row-eq-height">
	<div class="col-md-3">
		<div class="eq-element">
			<div class="thumbnail">
				<div class="thumb thumb-rounded thumb-slide">
					{{-- <a class="btn bg-primary-400 btn-rounded btn-icon legitRipple">
						<span class="letter-icon">{{ get_initial($user->name) }}</span>
					</a> --}}
					<img src="{{ Gravatar::src($user->email, 100) }}" 
						class="img-circle" 
						alt="{{ $user->name }}">

					<div class="caption no-margin">
						<span>
							<a href="#" class="btn bg-success-400 btn-icon btn-xs legitRipple" data-popup="lightbox"><i class="icon-plus2"></i></a>
							<a href="user_pages_profile.html" class="btn bg-success-400 btn-icon btn-xs legitRipple"><i class="icon-link"></i></a>
						</span>
					</div>
				</div>
			
		    	<div class="caption text-center">
		    		<h6 class="text-semibold no-margin">
		    			{{ $user->name }} 
	
		    		</h6>
					{{-- <ul class="icons-list mt-15">
		            	<li><a href="#" data-popup="tooltip" title="" data-original-title="Company"><i class="icon-office position-left"></i></a></li>
		        	</ul> --}}
		    	</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-flat eq-element">
			
			<div class="panel-body">
				<fieldset>
					<legend>
						<i class="icon-user position-left"></i>
						User Information
					</legend>
					<dl class="dl-vertical">
						<div class="col-md-12 mb-15">
							<dt>{{ trans('profile.attributes.email') }}</dt>
							<dd>{{ $user->email }}</dd>
						</div>
						
						<div class="col-md-6 mb-15">
							<dt>{{ trans('profile.attributes.created_at') }}</dt>
							<dd>{{ $user->created_at->formatDateTimeFromSetting() }}</dd>
						</div>

						<div class="col-md-6 mb-15">
							<dt>{{ trans('profile.attributes.updated_at') }}</dt>
							<dd>{{ $user->updated_at->formatDateTimeFromSetting() }}</dd>
						</div>
					</dl>
				</fieldset>
				
			</div>
		</div>
	</div>
</div>
@endsection
