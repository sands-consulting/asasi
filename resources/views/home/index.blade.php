@extends('layouts.public')

@section('content')
<div class="page-container">
    <div class="page-content">
    	<div class="content-wrapper">
    		<div class="row">
    			<div class="col-xs-12 col-sm-4 col-sm-offset-8">
    				<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">{{ trans('home.views.index.panels.news.title') }}</h6>
							</div>

							<div class="panel-body">
								<div class="content-group-xs" id="bullets"></div>

								<ul class="media-list">
									<li class="media">
										<div class="media-body">
											Stats for July, 6: 1938 orders, $4220 revenue
											<div class="media-annotation">2 hours ago</div>
										</div>

										<div class="media-right">
											<a href="#"><i class="icon-arrow-right13"></i></a>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@stop
