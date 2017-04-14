{{ Former::populate($notice) }}
<div class="col-xs-12 col-md-3">
    @include('admin.notices.form.menu')
</div>

<div class="col-xs-12 col-md-9">
    <div class="panel panel-flat panel-form">
        <div class="tab-content">
            @include('admin.notices.form.settings')
            @include('admin.notices.form.details')
            @include('admin.notices.form.events')
            @include('admin.notices.form.qualifications')
            @include('admin.notices.form.files')
            @include('admin.notices.form.allocations')
            @include('admin.notices.form.submission-requirements')
            @include('admin.notices.form.evaluation-requirements')
        </div>
        <div class="panel-footer">
            <a href="#" class="btn btn-default pull-right" v-if="!submit" v-on:click="next">{{ trans('actions.next') }}</a>
            <input type="submit" name="save" class="btn bg-blue-700 pull-right" value="{{ trans('actions.save') }}">
        </div>
    </div>
</div>
