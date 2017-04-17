@extends('layouts.portal')

@section('page-title', implode(' | ', [trans('reports.reports.vendor.rv1'), trans('reports.title')]))

@section('content')
{!! Former::open('rv1/view')->addClass('panel panel-default panel-report panel-form') !!}
    <div class="panel-heading">
        <h4 class="panel-title">{{ trans('reports.reports.vendor.rv1') }}</h4>
    </div>
    <div class="panel-body">
        {!! Former::select('statuses[]')
            ->label('reports.attributes.status')
            ->options(collect(trans('statuses'))->only('draft', 'pending', 'active', 'inactive', 'suspended'))
            ->multiple(true) !!}
        {!! Former::select('type_ids[]')
            ->label('reports.attributes.vendor_type')
            ->options(App\VendorType::options())
            ->multiple(true) !!}
        {!! Former::select('qualifications[]')
            ->label('reports.attributes.qualifications')
            ->options(App\QualificationCode::groupedOptions())
            ->multiple(true) !!}
    </div>
    <div class="panel-footer">
        {!! link_to_route('reports', trans('actions.cancel'), [], ['class' => 'btn btn-link text-danger']) !!}
        <input type="submit" value="{{ trans('actions.generate') }}" class="btn bg-blue-700 pull-right">
    </div>
{!! Former::close() !!}
@endsection
