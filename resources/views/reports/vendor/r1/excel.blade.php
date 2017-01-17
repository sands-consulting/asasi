<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <table>
        <thead>
            <tr>
                <th style="border: 1px solid #000; background: #f3f3f3;">No.</th>
                <th style="border: 1px solid #000; background: #f3f3f3;">Status</th>
                <th style="border: 1px solid #000; background: #f3f3f3;">Count</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach($data as $row)
            <tr>
                <td style="border: 1px solid #000;">{{ $i }}</td>
                <td style="border: 1px solid #000;">{{ ucfirst($row->status) }}</td>
                <td style="border: 1px solid #000;">{{ $row->count }}</td>
            </tr>
            @php $i++; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" style="border: 1px solid #000;">Total</th>
                <th style="border: 1px solid #000;">{{ $data->total }}</th>
            </tr>
        </tfoot>
    </table>
</html>
