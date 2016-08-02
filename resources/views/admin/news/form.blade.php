<div class="row">
	<div class="col-xs-12 col-sm-9">
		<div class="panel panel-flat">
			<div class="panel-body">
				{!! Former::text('title')
					->label(trans('news.attributes.title'))
					->required() !!}
				{!! Former::textarea('content')
					->label(trans('news.attributes.content'))
					->addClass('editor-full')
					->required() !!}
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-3">
		<div class="panel panel-flat">
			<div class="panel-body">
				{!! Former::select('category_id')
					->options(\App\NewsCategory::getOptions())
					->label(trans('news.attributes.category'))
					->addClass('select2')
					->required() !!}

				@unless(Auth::user()->hasPermission('news:organization'))
				{!! Former::select('organization_id')
					->options(\App\Organization::getOptions())
					->label(trans('news.attributes.organization'))
					->addClass('select2')
					->required() !!}
				@endunless
			</div>
		</div>
	</div>
</div>

{!! Former::submit(trans('actions.save'))->addClass('bg-blue')->data_confirm(trans('app.confirmation')) !!}
{!! link_to_route('admin.news.index', trans('actions.cancel'), [], ['class' => 'btn btn-default']) !!}

@section('scripts')
<script type="text/javascript">var CKEDITOR_BASEPATH = '/assets/ckeditor/';</script>
<script type="text/javascript" src="{{ url('assets/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
CKEDITOR.replace('content', {
	height: '400px'
});
</script>
@endsection