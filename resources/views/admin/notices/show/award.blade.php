<div role="tabpanel" class="tab-pane" id="tab-notice-award">
	{!! Former::open(route('admin.notices.award', $notice->id))->novalidate()->addClass('panel panel-flat') !!}
		{{ Former::populate($notice->award) }}
		<div class="panel-body">
            {!! Former::select('submission_id')
                ->label('notices.views.admin.show.award.submission')
                ->options($notice->submissions()->whereStatus('submitted')->with('vendor')->get()->pluck('vendor.name', 'id'))
                ->placeholder('notices.views.admin.show.award.select-submission')
                ->required() !!}
			{!! Former::text('period')->required()->placeholder('notices.views.admin.show.award.period') !!}
			{!! Former::text('price')->required()->placeholder('notices.views.admin.show.award.price') !!}
			{!! Former::select('status_award')->label('notices.attributes.status')->options(collect(trans('statuses'))->only('published', 'pending'))->required() !!}
		</div>
		<div class="panel-footer">
            <input type="submit" value="{{ trans('actions.save') }}" class="btn bg-blue-700 pull-right">
		</div>
	{!! Former::close() !!}
</div>