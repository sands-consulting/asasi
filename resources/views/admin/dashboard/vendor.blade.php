@extends('layouts.admin')

@section('page-title', trans('dashboard.title'))

@section('header')
    <div class="page-title">
        <h4><i class="icon-home2 position-left"></i> <span class="text-semibold">{{ trans('home.views.index.title') }}</span></h4>

        {{-- <ul class="breadcrumb breadcrumb-caret position-right">
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li class="active">{{ trans('subscriptions.views.history.title') }}</li>
        </ul> --}}
    </div>
    
    @if(Auth::user() && Auth::user()->hasPermission('access:vendor'))
    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="{{ route('admin.dashboard.user') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-user text-primary-700"></i> <span>USER</span></a>
            <a href="{{ route('admin.dashboard.vendor') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-office text-primary-700"></i> <span>VENDOR</span></a>
            <a href="{{ route('admin.dashboard.tender') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-file-empty2 text-primary-700"></i> <span>TENDER</span></a>
            <a href="{{ route('admin.dashboard.transaction') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-credit-card text-primary-700"></i> <span>TRANSACTION</span></a>
            <a href="{{ route('admin.dashboard.portfolio') }}" class="btn btn-link btn-float has-text text-size-small legitRipple"><i class="icon-folder2 text-primary-700"></i> <span>PORTFOLIO</span></a>
        </div>
    </div>
    @endif
@stop

@section('content')

    <!-- start: login activity & last login -->
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ trans('home.views.index.panels.vendors.registration_status') }}</h6>
                </div>

                <div class="panel-body" style="min-height: 210px">
                    <div class="chart-container"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ trans('home.views.index.panels.vendors.paritcipation') }}</h6>
                </div>

                <div class="panel-body" style="min-height: 210px">
                    <ul class="media-list">
                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-pink text-pink btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-statistics"></i></a>
                            </div>
                            
                            <div class="media-body">
                                Christina Elliott
                                <div class="media-annotation">10-02-2016 08:05PM</div>
                            </div>

                            <div class="media-right media-middle dashboard-">
                                <span class="badge badge-primary">73</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-checkmark3"></i></a>
                            </div>
                            
                            <div class="media-body">
                                Christina Elliott
                                <div class="media-annotation">10-02-2016 08:05PM</div>
                            </div>

                            <div class="media-right media-middle">
                                <span class="badge badge-primary">73</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-alignment-unalign"></i></a>
                            </div>
                            
                            <div class="media-body">
                                Christina Elliott
                                <div class="media-annotation">10-02-2016 08:05PM</div>
                            </div>

                            <div class="media-right media-middle">
                                <span class="badge badge-primary">73</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-spinner11"></i></a>
                            </div>

                            <div class="media-body">
                                Christina Elliott
                                <div class="media-annotation">10-02-2016 08:05PM</div>
                            </div>

                            <div class="media-right media-middle">
                                <span class="badge badge-primary">73</span>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-left">
                                <a href="#" class="btn border-teal-400 text-teal btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-redo2"></i></a>
                            </div>
                            
                            <div class="media-body">
                                Christina Elliott
                                <div class="media-annotation">10-02-2016 08:05PM</div>
                            </div>

                            <div class="media-right media-middle">
                                <span class="badge badge-primary">73</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- end: login activity & last login -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ trans('home.views.index.panels.vendors.status') }}</h6>
                </div>

                <div class="panel-body" style="min-height: 210px">
                    <div class="content-group-xs" id="bullets"></div>

                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-highlight">
                            <li class="active"><a href="#left-icon-tab1" data-toggle="tab" class="legitRipple"><i class="icon-menu7 position-left"></i> Active</a></li>
                            <li><a href="#left-icon-tab2" data-toggle="tab" class="legitRipple"><i class="icon-mention position-left"></i> Inactive</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false"><i class="icon-gear position-left"></i> Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#left-icon-tab3" data-toggle="tab">Dropdown tab</a></li>
                                    <li><a href="#left-icon-tab4" data-toggle="tab">Another tab</a></li>
                                </ul>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="left-icon-tab1">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Eugene</td>
                                                <td>Kopyov</td>
                                                <td>@Kopyov</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Victoria</td>
                                                <td>Baker</td>
                                                <td>@Vicky</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>James</td>
                                                <td>Alexander</td>
                                                <td>@Alex</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Franklin</td>
                                                <td>Morrison</td>
                                                <td>@Frank</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="left-icon-tab2">
                                Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
                            </div>

                            <div class="tab-pane" id="left-icon-tab3">
                                DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
                            </div>

                            <div class="tab-pane" id="left-icon-tab4">
                                Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection