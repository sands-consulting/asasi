<div class="row">
    <div class="col-xs-12 col-md-2">
        @include('admin.notices.form.menu')
    </div>

    <div class="col-xs-12 col-md-10">
        <div class="tab-content">
            @include('admin.notices.form.settings')
            @include('admin.notices.form.details')
            @include('admin.notices.form.events')
            @include('admin.notices.form.qualifications')
            @include('admin.notices.form.files')
            @include('admin.notices.form.allocations')
            @include('admin.notices.form.submission-criterias')
            @include('admin.notices.form.evaluation-criterias')
        </div>

        <div class="btn-group pull-right">
            <a href="#" class="btn bg-blue-700">Save</a>
            <a href="#" class="btn bg-slate-300">Next</a>
            <a href="#" class="btn bg-blue-700">Submit Application</a>
        </div>
    </div>
</div>