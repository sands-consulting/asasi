@extends('layouts.admin')

@section('header')
<div class="page-title">
    <h4>{{ trans('submissions.views.evaluate.title', ['notice' => $submission->type ]) }}</h4>
</div>
@endsection

@section('content')

<div class="panel panel-flat">
    <table class="table">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Title</th>
                <th>Value</th>
                <th width="10%">Rating</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($submissionDetails as $detail)
            <tr>
                <td>{{ $i }}</td>
                <td>
                    {{ $detail->requirement->title }}
                </td>
                <td>
                    @if ($detail->type == 'check')
                        {{ $detail->value == 1 ? 'Yes' : 'No' }}
                    @elseif ($detail->type == 'file')
                        <a href="{{ $detail->files()->first()->url }}" target="_blank" class="btn btn-default btn-xs">View File</a>
                    @endif
                </td>
                <td>
                    {!! Former::select() 
                        ->options(['' => 'Select']) !!}
                </td>
            </tr>
                <?php $i++; ?>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
