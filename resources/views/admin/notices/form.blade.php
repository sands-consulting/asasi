<div class="row">
    <div class="col-sm-6"> 
        {!! Former::select('notice_type_id')
            ->label(trans('notices.attributes.notice_type_id'))
            ->options(\App\NoticeType::options(), null)
            ->addClass('select2') !!}
    </div>
    <div class="col-sm-6"> 
        {!! Former::select('organization_id')
            ->label(trans('notices.attributes.organization_id'))
            ->options(\App\Organization::getNestedList('name', 'id', '-'), null)
            ->addClass('select2') !!}
    </div>
    <div class="col-sm-6">
        {!! Former::text('name')
            ->label('notices.attributes.name')
            ->required() !!}
    </div>
    <div class="col-sm-6">
        {!! Former::text('number')
            ->label('notices.attributes.number')
            ->required() !!}
    </div>
    <div class="col-sm-12">
        {!! Former::textarea('description')
            ->label('notices.attributes.description')
            ->required() !!}
    </div>
    <div class="col-sm-12">
        {!! Former::textarea('rules')
            ->label('notices.attributes.rules')
            ->required() !!}
    </div>
    <div class="col-sm-4">
        {!! Former::text('published_at')
            ->label('notices.attributes.published_at')
            ->required() !!}
    </div>
    <div class="col-sm-4">
        {!! Former::text('expired_at')
            ->label('notices.attributes.expired_at')
            ->required() !!}
    </div>
    <div class="col-sm-4">
        {!! Former::text('purchased_at')
            ->label('notices.attributes.purchased_at')
            ->required() !!}
    </div>
    <div class="col-sm-6">
        {!! Former::text('price')
            ->label('notices.attributes.price')
            ->required() !!}
    </div>
    <div class="col-sm-6">
        {!! Former::text('submission_at')
            ->label('notices.attributes.submission_at')
            ->required() !!}
    </div>
    <div class="col-sm-6">
        {!! Former::textarea('submission_address')
            ->label('notices.attributes.submission_address')
            ->required() !!}
    </div>
</div>