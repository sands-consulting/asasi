<div role="tabpanel" class="tab-pane" id="tab-notice-details">
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            {!! Former::text('name')
                                ->label('notices.attributes.name')
                                ->required() !!}
                        </div>
                        <div class="col-md-4">
                            {!! Former::text('number')
                                ->label('notices.attributes.number')
                                ->required() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-body">
                    {!! Former::textarea('description')
                        ->label('notices.attributes.description')
                        ->rows(10) !!}
                </div>
            </div>

             <div class="panel panel-flat">
                <div class="panel-body">
                    {!! Former::textarea('rules')
                        ->label('notices.attributes.rules')
                        ->required()
                        ->rows(10) !!}
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-3">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-7">
                            {!! Former::text('price')
                                ->label('notices.attributes.price')
                                ->required() !!}
                        </div>

                        <div class="col-xs-5">
                            {!! Former::select('tax_id')
                                ->options(App\TaxCode::options())
                                ->label('notices.attributes.tax_id')
                                ->required() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-body">
                    {!! Former::text('published_at')
                        ->label('notices.attributes.published_at')
                        ->addClass('daterange-single')
                        ->required() !!}

                    {!! Former::text('expired_at')
                        ->label('notices.attributes.expired_at')
                        ->addClass('daterange-single')
                        ->required() !!}

                    {!! Former::text('purchased_at')
                        ->label('notices.attributes.purchased_at')
                        ->addClass('daterange-single')
                        ->required() !!}
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-body">
                    {!! Former::text('submission_at')
                        ->label('notices.attributes.submission_at')
                        ->addClass('daterange-single')
                        ->required() !!}

                    {!! Former::textarea('submission_address')
                        ->label('notices.attributes.submission_address')
                        ->required()
                        ->rows(5) !!}
                </div>
            </div>
        </div>
    </div>
</div>