@extends('layouts.portal')

@section('page-title', 'User Guide')

@section('content')
<div class="row">
    <div class="col-xs-12 col-md-3">
        <ul class="list-group list-prompt-side-tab panel panel-flat" role="tablist">
            <li role="presentation"><a href="#" class="list-group-item disabled"><i class="icon-book"></i> User Guide</a></li>
            <li role="presentation" class="active"><a href="#docs-1" class="list-group-item" aria-controls="docs-1" role="tab" data-toggle="tab">Vendor Registration</a></li>
            <li role="presentation"><a href="#docs-2" class="list-group-item" aria-controls="docs-2" role="tab" data-toggle="tab">Complete Vendor Registration</a></li>
        </ul>
    </div>

    <div class="col-xs-12 col-md-8">
        <div class="tab-content panel panel-flat panel-content">
            <div role="tabpanel" class="tab-pane panel-body active" id="docs-1">
                @include('docs.1')
            </div>

            <div role="tabpanel" class="tab-pane panel-body" id="docs-2">
                @include('docs.2')
            </div>
        </div>
    </div>
</div>
@endsection
