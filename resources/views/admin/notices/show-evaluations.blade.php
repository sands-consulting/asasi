<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-coins"></i> Commercial Evaluations</legend>
    <table class="table">
        <thead>
            <th>Vendor</th>
            <th>Type</th>
            <th>Progress</th>
            <th>Score</th>
        </thead>
        <tbody>
            @if (!$submissions['commercial']->isEmpty())
                <?php $i = 1; ?>
                @foreach ($submissions['commercial'] as $submission)
                    <tr>
                        <td>{{ $submission->vendor->name }}</td>
                        <td>{{ $submission->type }}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ $submission->getProgress($submission->type) }}%">
                                    <span>{{ $submission->getProgress($submission->type) }}%</span>
                                </div>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No submissions information found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</fieldset>

<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-wrench2"></i> Technical Evaluations</legend>
    <table class="table">
        <thead>
            <th>Vendor</th>
            <th>Type</th>
            <th>Progress</th>
            <th>Score</th>
        </thead>
        <tbody>
            @if (!$submissions['technical']->isEmpty())
                <?php $i = 1; ?>
                @foreach ($submissions['technical'] as $submission)
                    <tr>
                        <td>{{ $submission->vendor->name }}</td>
                        <td>{{ $submission->type }}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ $submission->getProgress($submission->type) }}%">
                                    <span>{{ $submission->getProgress($submission->type) }}%</span>
                                </div>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No submissions information found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</fieldset>