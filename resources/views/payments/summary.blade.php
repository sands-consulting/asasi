@extends('layouts.portal')

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
                                    Notice Page
                                </div>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Number</th>
                                    <th>Description</th>
                                    <th>Organization</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($notices))
                                    <?php $i=1; ?>
                                    @foreach($notices as $notice)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $notice->number }}</td>
                                        <td>{{ $notice->description }}</td>
                                        <td>{{ $notice->organization->name }}</td>
                                        <td>{{ $notice->price }}</td>
                                    </tr>
                                    <?php $i++; ?>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="panel-footer">
                            <div class="heading-elements">
                                <a href="{{ route('notices.my-notices') }}" class="heading-text text-default pull-right">{{ trans('notices.buttons.my_notices') }} <i class="icon-arrow-right14 position-right"></i></a> 
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