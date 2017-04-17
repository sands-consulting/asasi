@extends('layouts.portal')

@section('page-title', trans('reports.title'))

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">{{ trans('reports.title') }}</h4>
    </div>
    <table class="table">
    @foreach(trans('reports.titles') as $key => $title)
        <tr>
            <th class="col-xs-3 bg-blue-700">{{ $title }}</th>
            <td>
                <ul class="list-unstyled no-margin">
                    @foreach(trans('reports.reports.' . $key ) as $name => $label)
                    <li><a href="/reports/{{ $name }}">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </td>
        </tr>
    @endforeach
    </table>
</div>
@endsection
