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
                                    <h5 class="panel-title">{{ trans('payments.title') }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    Payment Page
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <div class="heading-elements">
                                <a href="{{ route('payments.endpoint') }}" class="heading-text text-default pull-right" data-method="POST">{{ trans('actions.pay') }} <i class="icon-arrow-right14 position-right"></i></a> 
                            </div>
                            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop