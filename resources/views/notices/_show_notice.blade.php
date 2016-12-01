<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-clipboard3"></i> Notice Details</legend>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label"><strong>{{ trans('notices.attributes.description') }}</strong>:</label>
                <div class="form-control-static">{{ !empty($notice->description) ? nl2br($notice->description) : 'N/A' }}</div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label"><strong>{{ trans('notices.attributes.rules') }}</strong>:</label>
                <div class="form-control-static">{!! !empty($notice->rules) ? nl2br($notice->rules) : 'N/A' !!}</div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label"><strong>{{ trans('notices.attributes.published_at') }}</strong>:</label>
                <div class="form-control-static">{{ $notice->published_at ? $notice->published_at->formatDateFromSetting() : 'N/A' }}</div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label"><strong>{{ trans('notices.attributes.expired_at') }}</strong>:</label>
                <div class="form-control-static">{{ $notice->expired_at ? $notice->expired_at->formatDateFromSetting() : 'N/A' }}</div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label"><strong>{{ trans('notices.attributes.purchased_at') }}</strong>:</label>
                <div class="form-control-static">{{ $notice->purchased_at ? $notice->purchased_at->formatDateFromSetting() : 'N/A' }}</div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="control-label"><strong>{{ trans('notices.attributes.price') }}</strong>:</label>
                <div class="form-control-static">{{ $notice->price ? $notice->price : 'N/A' }}</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label"><strong>{{ trans('notices.attributes.submission_at') }}</strong>:</label>
                <div class="form-control-static">{{ $notice->submission_at ? $notice->submission_at->formatDateFromSetting() : 'N/A' }}</div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label"><strong>{{ trans('notices.attributes.submission_address') }}</strong>:</label>
                <div class="form-control-static">{!! $notice->submission_address ? nl2br($notice->submission_address) : 'N/A' !!}</div>
            </div>
        </div>
    </div>
</fieldset>