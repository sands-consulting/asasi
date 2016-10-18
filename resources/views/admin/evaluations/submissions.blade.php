@extends('layouts.admin')

@section('page-title', trans('evaluations.vendors'))

@section('header')
<div class="page-title">
    <h4>{{ trans('evaluations.title') }}</h4>
</div>
<div class="heading-elements">
    
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Notices</h6>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.name') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->name }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.number') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->number }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.notice_type_id') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->type ? $notice->type->name : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.description') }}</strong>:</label>
                            <div class="form-control-static">{{ !empty($notice->description) ? nl2br($notice->description) : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.rules') }}</strong>:</label>
                            <div class="form-control-static">{!! !empty($notice->rules) ? nl2br($notice->rules) : 'N/A' !!}</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.published_at') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->published_at ? $notice->published_at->formatDateFromSetting() : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.expired_at') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->expired_at ? $notice->expired_at->formatDateFromSetting() : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.purchased_at') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->purchased_at ? $notice->purchased_at->formatDateFromSetting() : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.price') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->price ? $notice->price : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.submission_at') }}</strong>:</label>
                            <div class="form-control-static">{{ $notice->submission_at ? $notice->submission_at->formatDateFromSetting() : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label"><strong>{{ trans('notices.attributes.submission_address') }}</strong>:</label>
                            <div class="form-control-static">{!! $notice->submission_address ? nl2br($notice->submission_address) : 'N/A' !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Submissions</h6>
            </div>
            {!! $dataTable->table() !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}

<script type="text/javascript">
    // $("#dataTableBuilder-notices").DataTable({
    //     "serverSide":true,
    //     "processing":true,
    //     "ajax":"{{ route('admin.evaluations.index') }}",
    //     "columns":[
    //         { "name":"notices.name","data":"name","title":"Name","orderable":true,"searchable":true },
    //         // { "defaultContent":"","data":"action","name":"action","title":"Action","render":null,"orderable":false,"searchable":false,"width":"80","class":"text-center" }
    //     ],
    //     "dom":"<\"datatable-header\"f><\"datatable-scroll\"t><\"datatable-footer\"ip>",
    //     "language":{
    //         "search":"<span>Filter:<\/span> _INPUT_",
    //         "lengthMenu":"<span>Show:<\/span> _MENU_",
    //         "paginate":{
    //             "first":"First","last":"Last","next":"&rarr;","previous":"&larr;"
    //         }
    //     }
    // });
</script>
@endsection