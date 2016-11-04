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
    <div class="col-sm-3">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 mb-15">
                        <span class="label label-rounded label-default">{{ $notice->status }}</span>
                    </div>
                    <div class="col-sm-12 mb-5">
                        <div class="text-muted">{{ $notice->number }} ({{ $notice->organization->name }})</div>
                    </div>
                    <div class="col-sm-12">
                        <div class="">{{ $notice->name }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
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