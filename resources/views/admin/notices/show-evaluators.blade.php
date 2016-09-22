<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-coins"></i> Commercial Evaluators</legend>
    <table class="table">
        <thead>
            <th>Evaluator</th>
            <th>Type</th>
            <th>Progress</th>
            <th>Action</th>
        </thead>
        <tbody>
            @if (!$evaluators['commercial']->isEmpty())
                <?php $i = 1; ?>
                @foreach ($evaluators['commercial'] as $evaluator)
                    <tr>
                        <td>{{ $evaluator->user->name }}</td>
                        <td>{{ $evaluator->type }}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" style="width: {{ $evaluator->getProgress($evaluator->type) }}%">
                                    <span>{{ $evaluator->getProgress($evaluator->type) }}%</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ link_to_route('admin.users.show', trans('actions.show'), $evaluator->id) }}</td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No evaluators information found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</fieldset>

<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-wrench2"></i> Technical Evaluators</legend>
    <table class="table">
        <thead>
            <th>Evaluator</th>
            <th>Type</th>
            <th>Progress</th>
            <th>Action</th>
        </thead>
        <tbody>
            @if (!$evaluators['technical']->isEmpty())
                <?php $i = 1; ?>
                @foreach ($evaluators['technical'] as $evaluator)
                    <tr>
                        <td>{{ $evaluator->user->name }}</td>
                        <td>{{ $evaluator->type }}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" style="width: {{ $evaluator->getProgress($evaluator->type) }}%">
                                    <span>{{ $evaluator->getProgress($evaluator->type) }}%</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ link_to_route('admin.users.show', trans('actions.show'), $evaluator->id) }}</td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No evaluators information found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</fieldset>