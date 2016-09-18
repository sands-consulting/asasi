@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>{{ trans('submissions.views.lists.title', ['notice' => $notice->name ]) }}</h4>
</div>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body form-datatable-search form-inline">
        <input type="text" name="q[keywords]" class="form-control input-sm" placeholder="{{ trans('submissions.views.lists.keywords') }}" v-model="q.keywords">
        <select name="q[status]" class="form-control input-sm" v-model="q.status">
            <option value="" selected="selected">{{ trans('submissions.views.lists.type') }}</option>
            @foreach(collect(trans('submissions.types'))->only('commercial', 'technical') as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach
        </select>
        <a href="#" class="btn btn-sm btn-primary" v-on:click="perform_search">{{ trans('actions.search') }}</a>
        <a href="#" class="btn btn-sm btn-default" v-show="searching" v-on:click="clear_search">{{ trans('actions.clear') }}</a>
    </div>
</div>

<div class="panel panel-flat">
    <table class="table">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Type</th>
                <th>Status</th>
                <th>Created At</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($submissions as $submission)
            <tr>
                <td>{{ $i }}</td>
                <td>
                    @if ($submission->type == 'technical')
                        <i class="icon-wrench2"></i>
                    @else
                        <i class="icon-coins"></i>
                    @endif
                    {{ trans('submissions.types.' . $submission->type) }}
                </td>
                <td>
                    @if ($submission->status == 'pending')
                        <span class="label label-warning">
                    @else
                        <span class="label label-default">
                    @endif
                    {{ trans('statuses.' . $submission->status) }}
                </td>
                <td>
                    {{ $submission->created_at->getshort() }}
                </td>
                <td>
                    <a href="{{ route('admin.submissions.evaluate', $submission->id) }}" class="btn btn-xs btn-default">Evaluate</a>
                </td>
            </tr>
                <?php $i++; ?>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
