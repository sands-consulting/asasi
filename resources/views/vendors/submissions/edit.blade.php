@extends('layouts.portal')

@section('content')
    {!! Former::open_for_files(route('vendors.submissions.update', [$submission->vendor->id, $submission->id, $detail->id]))->method('PUT') !!}
    {!! Former::populate($submission) !!}


    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Vendor Submission ({{ $detail->type->name }})</h5>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th colspan="2">
                        <div class="text-size-sm">{{ $submission->notice->number }}</div>
                        <div class="text-italic">{{ $submission->notice->name }}</div>
                    </th>
                </tr>
                </thead>
                <tbody>
                {{-- Commercial --}}
                @if ($detail->type_id == 1)
                    <tr>
                        <td style="width: 20%;">

                        </td>
                        <td>
                            Price offer by {{ Auth::user()->vendor->name }} :
                            {!! Former::inline_text('price')
                                ->label(false)
                                ->prepend(\App\Setting::whereKey('currency')->first()->value)
                                ->required() !!}
                        </td>
                    </tr>
                @endif
                {{-- Technical --}}
                @if ($detail->type_id == 2)
                    <tr>
                        <td style="width: 20%;">

                        </td>
                        <td>
                            Project duration proposed by {{ Auth::user()->vendor->name }} :
                            {!! Former::text('duration')
                                ->label(false)
                                ->required() !!}
                        </td>
                    </tr>
                @endif
                @foreach ($requirements as $requirement)
                    <tr>
                        <td class="text-center">
                            @if ($requirement->field_type == 'file')
                                @if ($requirement->items && $requirement->items->files()->first())
                                    <a href="{{ $requirement->items->files()->orderBy('id', 'desc')->first()->url }}"
                                       target="_blank"><span class="icon-file-download2"></span></a>
                                @endif
                            @else
                                @php
                                    $checked = false;
                                    if ($requirement->items) {
                                        $checked = $requirement->items->value == 1 ? 'checked="checked"' : false;
                                    }
                                @endphp
                                <input type="checkbox" name="value[{{ $requirement->id }}]" value="1" {{ $checked }}>
                            @endif
                        </td>
                        <td>
                            @if ($requirement->field_type == 'file')
                                {!! Former::file('file['. $requirement->id .']')
                                    ->label(false)
                                    ->addClass('file-styled') !!}
                            @endif
                            {{ $requirement->title }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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