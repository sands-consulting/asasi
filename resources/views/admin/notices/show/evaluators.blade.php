@extends('admin.notices.show')

@section('show')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title">Evaluators</h6>
        <div class="heading-elements">
            <ul class="icons-list">
                <li>
                    <a href="{{ route('admin.evaluators.edit', $notice->id) }}">
                        <i class=" icon-pencil"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    {!! $dataTable->table() !!}
</div>
@endsection

@section('scripts')
    {!! $dataTable->scripts() !!}
@endsection