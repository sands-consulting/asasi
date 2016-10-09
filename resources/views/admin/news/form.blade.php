<div class="row">
	<div class="panel panel-flat">
		<div class="panel-body">
			<div class="col-xs-12 col-sm-6">
				{!! Former::select('category_id')
					->options(\App\NewsCategory::getOptions())
					->label(trans('news.attributes.category'))
					->addClass('select2')
					->required() !!}
			</div>
			
			@unless(Auth::user()->hasPermission('news:organization'))
				<div class="col-xs-6 col-sm-6"> 
					{!! Former::select('organization_id')
						->options(\App\Organization::getOptions())
						->label(trans('news.attributes.organization'))
						->addClass('select2')
						->required() !!}
				</div>
			@endunless

			<div class="col-xs-12 col-sm-12">
				{!! Former::text('title')
					->label(trans('news.attributes.title'))
					->required() !!}
			</div>
			<div class="col-sm-12">
				{!! Former::textarea('content')
					->label(trans('news.attributes.content'))
					->addClass('editor-full')
					->required() !!}
			</div>
			<div class="col-xs-12 col-sm-12">
				{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
				{!! link_to_route('admin.news.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}
			</div>
		</div>
	</div>
</div>

@section('scripts')
<script type="text/javascript">var CKEDITOR_BASEPATH = '/assets/ckeditor/';</script>
<script type="text/javascript" src="{{ url('assets/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
CKEDITOR.replace('content', {
	height: '400px'
});
</script>
@endsection