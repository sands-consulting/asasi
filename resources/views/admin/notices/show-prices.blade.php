<table class="table">
    <thead class="bg-blue-700">
        <th width="5%">#</th>
        <th>Submission ID</th>
        <th width="20%">Price</th>
    </thead>
    <tbody>
        @if (!$submissions['commercial']->isEmpty())
            <?php $i = 1; ?>
            @foreach ($submissions['commercial'] as $submission)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $submission->id }}</td>
                    <td>{{ $submission->price }}</td>
                </tr>
                <?php $i++; ?>
            @endforeach
        @else
            <tr>
                <td colspan="3">No prices information found.</td>
            </tr>
        @endif
    </tbody>
</table>