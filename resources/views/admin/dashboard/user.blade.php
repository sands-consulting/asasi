@extends('admin.dashboard.index')

@section('content')
<!-- start: user status -->
<div class="row">
    <div class="col-md-12 dashboard-panel-user-status">
        <div class="panel panel-flat">
            <div class="panel-body text-center">
                <div class="col-sm-3 col-xs-12 dashboard-panel-user-detail">
                    <div class="col-sm-12 col-xs-6">
                        <div class="dashboard-panel-user-icon text-green-700">
                            <i class="icon-user"></i>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-6"><div class="text-muted">ACTIVE USER</div>
                        <div class="dashboard-panel-user-number text-green-700">1000</div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 dashboard-panel-user-detail">
                    <div class="dashboard-panel-user-icon text-orange-700">
                        <i class="icon-user"></i>
                    </div>
                    <div class="text-muted">INACTIVE USER</div>
                    <div class="dashboard-panel-user-number text-orange-700">1000</div>
                </div>
                <div class="col-sm-3 col-xs-6 dashboard-panel-user-detail">
                    <div class="dashboard-panel-user-icon text-primary-700">
                        <i class="icon-user"></i>
                    </div>
                    <div class="text-muted">ALL USER</div>
                    <div class="dashboard-panel-user-number text-primary-700">1000</div>
                </div>
                <div class="col-sm-3 col-xs-6 dashboard-panel-user-detail">
                    <div class="dashboard-panel-user-icon text-danger-800">
                        <i class="icon-user"></i>
                    </div>
                    <div class="text-muted">SUSPENDED USER</div>
                    <div class="dashboard-panel-user-number text-danger-800">1000</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: user status -->
<!-- start: login activity & last login -->
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title text-uppercase">{{ strtoupper(trans('home.views.index.panels.login.activity')) }}</h6>
            </div>

            <div class="panel-body">
                <div class="chart-container">
                    <div class="chart" id="c3-area-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-flat">
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
                                <img src="{{ Gravatar::src($lastLogin->user->email, 40) }}" class="img-circle" alt="{{ $lastLogin->user->name }}">
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
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">{{ trans('home.views.index.panels.users.title') }}</h6>
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