@extends('layouts.portal')

@section('content')
    {!! Former::open_for_files() !!}
    {!! Former::populate($submission) !!}


    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Vendor Submission ({{ $type->name }})</h5>
        </div>
        <div class="panel-body">
            @include('vendors.submissions._form')
            <hr>
            <div class="col-md-12">
                <a href="{{ route('vendors.submissions.show', [ $submission->vendor->id, $submission->id ] ) }}"
                   class="btn btn-default"><span class="p-20">Back</span></a>
                <button type="submit" class="btn bg-blue pull-right"><span class="p-20">Save</span></button>
            </div>

        </div>
    </div>
    {!! Former::close() !!}
@stop