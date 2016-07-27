@extends('layouts.public')

@section('content')
<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="panel-title">{{ trans('vendors.views.pending.title') }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>Pending Notes</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident sed error libero consectetur est facilis veniam cumque deserunt quo tenetur, ipsam nisi quas a. Nam, tempora laborum. Ducimus, sequi necessitatibus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
