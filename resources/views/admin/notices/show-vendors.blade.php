<table class="table">
    <thead class="bg-blue-700">
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
    </thead>
    <tbody>
        @if (!$vendors->isEmpty())
            <?php $i = 1; ?>
            @foreach ($vendors as $vendor)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $vendor->name }}</td>
                    <td>{{ $vendor->contact_email }}</td>
                </tr>
                <?php $i++; ?>
            @endforeach
        @else
            <tr>
                <td colspan="3">No vendors information found.</td>
            </tr>
        @endif
    </tbody>
</table>