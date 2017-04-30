@extends('admin.dashboard.index', ['header' => 'Notice Dashboard'])

@section('content')
<!-- start: user status -->
<!-- start: login activity & last login -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title text-uppercase">{{ strtoupper(trans('dashboard.views.notice.panels.graph.title')) }}</h6>
            </div>

            <div class="panel-body">
                <div class="chart-container">
                    <div class="chart" id="notice-chart"></div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end: login activity & last login -->

<div id="datatable-filter">
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <a href="#" @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-primary-300"
               data-filter="all"
               data-color="primary">
                <div class="title"><i class="icon-clipboard3"></i> Draft</div>
                <div class="number">{{ App\Notice::draft()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-3">
            <a href="#" @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-orange-300"
               data-filter="inactive"
               data-color="orange-300">
                <div class="title"><i class="icon-clipboard3"></i> Published</div>
                <div class="number">{{ App\Notice::published()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-3">
            <a href="#" @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-pink-300"
               data-filter="suspended"
               data-color="pink-300">
                <div class="title"><i class="icon-clipboard3"></i> Submissions</div>
                <div class="number">{{ App\Notice::submissionPublished()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-3">
            <a href="#" @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-success-300"
               data-filter="active"
               data-color="success-300">
                <div class="title"><i class="icon-clipboard3"></i> Awarded</div>
                <div class="number">{{ App\Notice::awarded()->count() }}</div>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-flat border" v-bind:class="border_color">
            <div class="panel-heading">

            </div>
            {!! $dataTable->table(['class' =>'table table-bordered table-striped']) !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}
    <script src="{{ asset('assets/js/pages/dashboard/notice.js') }}"></script>
@endsection