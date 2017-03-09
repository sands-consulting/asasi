@extends('admin.dashboard.index')

@section('content')
<!-- start: user status -->
<!-- start: login activity & last login -->
<div class="row">
    <div class="col-lg-9">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title text-uppercase">{{ strtoupper(trans('home.views.index.panels.login.activity')) }}</h6>
            </div>

            <div class="panel-body">
                <div class="chart-container">
                    <div class="chart eq-element" id="c3-area-chart"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-3">
        <div class="panel panel-flat" style="height: 390px">
            <div class="panel-heading">
                <h6 class="panel-title text-uppercase">{{ trans('home.views.index.panels.login.last') }}</h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a href="#"><i class="icon-arrow-right13"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <ul class="media-list">
                    @foreach ($lastLogins as $lastLogin)
                        <li class="media">
                            <div class="media-left media-middle">
                                <img src="{{ Gravatar::src($lastLogin->user->email, 40) }}"class="img-circle" alt="{{ $lastLogin->user->name }}">
                            </div>
                            
                            <div class="media-body">
                                {{ $lastLogin->user->name }}
                                <div class="media-annotation">{{ $lastLogin->created_at->formatDateTimeFromSetting() }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
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
                <div class="title"><i class="icon-users"></i> All</div>
                <div class="number">{{ App\User::count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-3">
            <a href="#" @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-success-300"
               data-filter="active"
               data-color="success-300">
                <div class="title"><i class="icon-user"></i> Active</div>
                <div class="number">{{ App\User::active()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-3">
            <a href="#" @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-orange-300"
               data-filter="inactive"
               data-color="orange-300">
                <div class="title"><i class="icon-user"></i> Inactive</div>
                <div class="number">{{ App\User::inactive()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-3">
            <a href="#" @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-pink-300"
               data-filter="suspended"
               data-color="pink-300">
                <div class="title"><i class="icon-user"></i> Suspended</div>
                <div class="number">{{ App\User::suspended()->count() }}</div>
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
    <script src="{{ asset('assets/js/pages/dashboard/user.js') }}"></script>
@endsection