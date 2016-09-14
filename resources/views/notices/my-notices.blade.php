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
                                    <h5 class="panel-title">{{ trans('notices.title') }}</h5>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($myNotices))
                                    <?php $i=1; ?>
                                    @foreach($myNotices as $myNotice)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $myNotice->number }}</td>
                                        <td>{{ $myNotice->description }}</td>
                                        <td>{{ $myNotice->organization->name }}</td>
                                        <td></td>
                                    </tr>
                                    <?php $i++; ?>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="panel-footer">
                            {{-- foorter --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop