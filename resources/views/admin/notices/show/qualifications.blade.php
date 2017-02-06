    
    <div class="panel panel-flat">
        @if($notice->qualifications()->count() > 0)
        <div class="panel-body">
            <span class="text-center">{{ trans('notices.admin.views.show.qualifications.empty') }}</span>
        </div>
        @else
        <table class="table">
            @foreach($notice->qualifications()->get()->groupBy('group') as $group => $codes)
            @endforeach
        </table>
        @endif
    </div>
