<div class="form-group">
    <div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
        <?php $today_start = Carbon\Carbon::today()->format('Y-m-d'); ?>
        <?php $today_end = Carbon\Carbon::today()->format('Y-m-d'); ?>
        <a href="#" class="btn btn-shortcut btn-xs btn-default" data-date-start="{{ $today_start }}" data-date-end="{{ $today_end }}">Today</a>

        <?php $yesterday_start = Carbon\Carbon::today()->subDay()->format('Y-m-d'); ?>
        <?php $yesterday_end = Carbon\Carbon::today()->subDay()->format('Y-m-d'); ?>
        <a href="#" class="btn btn-shortcut btn-xs btn-default" data-date-start="{{ $yesterday_start }}" data-date-end="{{ $yesterday_end }}">Yesterday</a>

        <?php $tw_start = Carbon\Carbon::today()->startOfWeek()->format('Y-m-d'); ?>
        <?php $tw_end = Carbon\Carbon::today()->endOfWeek()->format('Y-m-d'); ?>
        <a href="#" class="btn btn-shortcut btn-xs btn-default" data-date-start="{{ $tw_start }}" data-date-end="{{ $tw_end }}">This Week</a>

        <?php $lw_start = Carbon\Carbon::today()->subDays(7)->startOfWeek()->format('Y-m-d'); ?>
        <?php $lw_end = Carbon\Carbon::today()->subDays(7)->endOfWeek()->format('Y-m-d'); ?>
        <a href="#" class="btn btn-shortcut btn-xs btn-default" data-date-start="{{ $lw_start }}" data-date-end="{{ $lw_end }}">Last Week</a>

        <?php $tm_start = Carbon\Carbon::today()->startOfMonth()->format('Y-m-d'); ?>
        <?php $tm_end = Carbon\Carbon::today()->endOfMonth()->format('Y-m-d'); ?>
        <a href="#" class="btn btn-shortcut btn-xs btn-default" data-date-start="{{ $tm_start }}" data-date-end="{{ $tm_end }}">This Month</a>

        <?php $lm_start = Carbon\Carbon::today()->subMonth()->startOfMonth()->format('Y-m-d'); ?>
        <?php $lm_end = Carbon\Carbon::today()->subMonth()->endOfMonth()->format('Y-m-d'); ?>
        <a href="#" class="btn btn-shortcut btn-xs btn-default" data-date-start="{{ $lm_start }}" data-date-end="{{ $lm_end }}">Last Month</a>
    </div>
</div>

<div class="form-group">
    <div class="col-lg-10 col-sm-8 col-lg-offset-2 col-sm-offset-4">
        <?php $tq_start = Carbon\Carbon::today()->firstOfQuarter()->format('Y-m-d'); ?>
        <?php $tq_end = Carbon\Carbon::today()->lastOfQuarter()->format('Y-m-d'); ?>
        <a href="#" class="btn btn-shortcut btn-xs btn-default" data-date-start="{{ $tq_start }}" data-date-end="{{ $tq_end }}">This Quarter</a>

        <?php $lq_start = Carbon\Carbon::today()->subMonth(3)->firstOfQuarter()->format('Y-m-d'); ?>
        <?php $lq_end = Carbon\Carbon::today()->subMonths(3)->lastOfQuarter()->format('Y-m-d'); ?>
        <a href="#" class="btn btn-shortcut btn-xs btn-default" data-date-start="{{ $lq_start }}" data-date-end="{{ $lq_end }}">Last Quarter</a>

        <?php $ty_start = Carbon\Carbon::today()->startOfYear()->format('Y-m-d'); ?>
        <?php $ty_end = Carbon\Carbon::today()->endOfYear()->format('Y-m-d'); ?>
        <a href="#" class="btn btn-shortcut btn-xs btn-default" data-date-start="{{ $ty_start }}" data-date-end="{{ $ty_end }}">This Year</a>

        <?php $ly_start = Carbon\Carbon::today()->subYear()->startOfYear()->format('Y-m-d'); ?>
        <?php $ly_end = Carbon\Carbon::today()->subYear()->endOfYear()->format('Y-m-d'); ?>
        <a href="#" class="btn btn-shortcut btn-xs btn-default" data-date-start="{{ $ly_start }}" data-date-end="{{ $ly_end }}">Last Year</a>
    </div>
</div>