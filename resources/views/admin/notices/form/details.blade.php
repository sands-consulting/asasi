<div role="tabpanel" class="tab-pane panel-body" id="tab-notice-details">
    <div class="row">
        <div class="col-xs-12 col-md-9">
            {!! Former::textarea('name')->label('notices.attributes.name')->required()->rows(3) !!}
            {!! Former::textarea('description')->label('notices.attributes.description')->rows(10) !!}
            {!! Former::textarea('rules')->label('notices.attributes.rules')->required()->rows(10) !!}
        </div>

        <div class="col-xs-12 col-md-3">
            {!! Former::text('number')->label('notices.attributes.number')->required() !!}

            <div class="row">
                <div class="col-xs-7">
                    {!! Former::text('price')
                        ->label('notices.attributes.price')
                        ->required() !!}
                </div>

                <div class="col-xs-5">
                    {!! Former::select('tax_code_id')
                        ->options(App\TaxCode::options())
                        ->label('notices.attributes.tax_code_id')
                        ->required() !!}
                </div>
            </div>

            <div class="form-group required{{ $errors->has('published_at') ? ' has-error' : '' }}">
                <label for="number" class="control-label">{{ trans('notices.attributes.published_at') }}<sup>*</sup></label>
                <datetimepicker-single klass="form-control" name="published_at" :date="notice.published_at"></datetimepicker-single>
                @if($errors->has('published_at'))<span class="help-block">{{ $errors->first('published_at') }}</span>@endif
            </div>

            <div class="form-group required{{ $errors->has('expired_at') ? ' has-error' : '' }}">
                <label for="number" class="control-label">{{ trans('notices.attributes.expired_at') }}<sup>*</sup></label>
                <datetimepicker-single klass="form-control" name="expired_at" :date="notice.expired_at"></datetimepicker-single>
                @if($errors->has('expired_at'))<span class="help-block">{{ $errors->first('expired_at') }}</span>@endif
            </div>

            <div class="form-group required{{ $errors->has('purchased_at') ? ' has-error' : '' }}">
                <label for="number" class="control-label">{{ trans('notices.attributes.purchased_at') }}<sup>*</sup></label>
                <datetimepicker-single klass="form-control" name="purchased_at" :date="notice.purchased_at"></datetimepicker-single>
                @if($errors->has('purchased_at'))<span class="help-block">{{ $errors->first('purchased_at') }}</span>@endif
            </div>

             <div class="form-group required{{ $errors->has('submission_at') ? ' has-error' : '' }}">
                <label for="number" class="control-label">{{ trans('notices.attributes.submission_at') }}<sup>*</sup></label>
                <datetimepicker-single klass="form-control" name="submission_at" :date="notice.submission_at"></datetimepicker-single>
                @if($errors->has('submission_at'))<span class="help-block">{{ $errors->first('submission_at') }}</span>@endif
            </div>

            {!! Former::textarea('submission_address')
                ->label('notices.attributes.submission_address')
                ->required()
                ->rows(5) !!}
        </div>
    </div>
</div>