<table class="table table-striped">
    <thead>
    <tr>
        <th colspan="2">
            <div class="text-size-sm">{{ $notice->number }}</div>
            <div class="text-italic">{{ $notice->name }}</div>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach ($requirements as $requirement)
        <tr>
            <td>
                @if ($requirement->field_type == 'file')

                @else
                    <input type="checkbox" name="value[{{ $requirement->id }}]">
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
