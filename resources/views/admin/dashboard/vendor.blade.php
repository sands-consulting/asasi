@extends('admin.dashboard.index', ['header' => 'Vendor Dashboard'])

@section('content')

<!-- start: vendor register & top purchaser -->
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title text-uppercase">{{ strtoupper(trans('dashboard.views.vendors.panels.registration_status')) }}</h6>
            </div>

            <div class="panel-body">
                <div class="chart-container">
                    <div class="chart eq-element" id="c3-bar-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-flat" style="height: 390px">
            <div class="panel-heading">
                <h6 class="panel-title text-uppercase">{{ trans('dashboard.views.vendors.panels.top_purchaser') }}</h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a href="#"><i class="icon-arrow-right13"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <ul class="media-list">
                    @if ($topPurchasers)
                        @foreach ($topPurchasers as $topPurchaser)
                            <li class="media">
                                <div class="media-left">
                                    <a href="#" class="btn bg-primary-400 btn-rounded btn-icon legitRipple">
                                        <span class="letter-icon">{{ get_initial($topPurchaser->vendor_name) }}</span>
                                    </a>
                                </div>

                                <div class="media-body">
                                    <div class="pt-10">
                                        {{ $topPurchaser->vendor_name }}
                                        <span class="label bg-grey-300 pull-right">{{ $topPurchaser->purchases }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <div class="text-center">No record found.</div>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end: vendor register & top purchaser -->
<div class="datatable-filter">
    <div class="row">
        <div class="col-xs-12 col-md-3">
            <a @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-white border border-bottom-primary"
               data-filter="all"
               data-color="primary">
                <div class="title"><i class="icon-users"></i> All</div>
                <div class="number text-primary">{{ App\Vendor::count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-3">
            <a @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-white border border-bottom-success"
               data-filter="active"
               data-color="success">
                <div class="title"><i class="icon-user"></i> Active</div>
                <div class="number text-success">{{ App\Vendor::active()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-3">
            <a @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-white border border-bottom-warning"
               data-filter="inactive"
               data-color="warning">
                <div class="title"><i class="icon-user"></i> Inactive</div>
                <div class="number text-warning">{{ App\Vendor::inactive()->count() }}</div>
            </a>
        </div>
        <div class="col-xs-12 col-md-3">
            <a @click.prevent="handle_dashboard($event)"
               class="prompt-box bg-white border border-bottom-danger"
               data-filter="blacklisted"
               data-color="danger">
                <div class="title"><i class="icon-user"></i> Blacklisted</div>
                <div class="number text-danger">{{ App\Vendor::blacklisted()->count() }}</div>
            </a>
        </div>
    </div>
    <!-- end: user status -->

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-flat border" v-bind:class="border_color">
                <div class="panel-heading">
                    
                </div>
                {!! $dataTable->table(['class' =>'table table-bordered table-striped']) !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}
    <script src="{{ asset('assets/js/pages/dashboard/vendor.js') }}"></script>
@endsection