@extends('layouts.admin')

@section('page-title', trans('evaluations.title'))

@section('header')
<div class="page-title">
    <h4>{{ trans('evaluations.title') }}</h4>
</div>
<div class="heading-elements">
    
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Evaluation Summary</h6>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Company Name</th>
                        <th class="text-center">Technical Score</th>
                        <th class="text-center">Commercial Score</th>
                        <th class="text-center">Offered Price</th>
                        <th>Offered Duration</th>
                        <th>Winner</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendors as $vendor)
                    <tr>
                        <td>{{ $vendor->id }}</td>
                        <td>{{ $vendor->name }}</td>
                        <td class="text-right">{{ trim_trailing_zeroes($vendor->technical_score) }} %</td>
                        <td class="text-right">{{ trim_trailing_zeroes($vendor->commercial_score) }} %</td>
                        <td class="text-right">{{ 'RM' }} {{ trim_trailing_zeroes($vendor->offered_price) }}</td>
                        <td>{{ $vendor->offered_duration }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-xs">Award</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-default btn-xs"><i class="icon-list"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="panel-body"></div>
        </div>
    </div>
</div>
@endsection