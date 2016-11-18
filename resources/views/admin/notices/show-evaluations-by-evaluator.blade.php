<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-coins"></i> Commercial Evaluators</legend>
    <div class="row">
        @if (!$evaluators['commercial']->isEmpty())
            @foreach ($evaluators['commercial'] as $evaluator)
                <div class="col-md-4">
                    <div class="panel panel-body">
                        <div class="media mb-10">
                            <div class="media-left">
                                <a href="#" class="btn bg-primary-400 btn-rounded btn-icon legitRipple">
                                    <span class="letter-icon">{{ get_initial($evaluator->user->name) }}</span>
                                </a>
                            </div>

                            <div class="media-body">
                                <h6 class="media-heading">{{ $evaluator->user->name }}</h6>
                                <span class="text-muted">{{ $evaluator->type->name }}</span>
                            </div>

                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-success active" style="width: {{ $evaluator->getProgress($evaluator->type_id) }}%">
                                <span>{{ $evaluator->getProgress($evaluator->type_id) }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No evaluators information found.</p>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('admin.notices.summary-by-type', [$notice->id, 1]) }}" class="btn btn-default">
                <span class="text-thin">Show Summary</span>
            </a>
        </div>
    </div>
</fieldset>

<fieldset class="mb-20">
    <legend class="text-semibold"> <i class="icon-wrench2"></i> Technical Evaluators</legend>
    <div class="row">
        @if (!$evaluators['technical']->isEmpty())
            @foreach ($evaluators['technical'] as $evaluator)
                <div class="col-md-4">
                    <div class="panel panel-body">
                        <div class="media mb-10">
                            <div class="media-left">
                                <a href="#" class="btn bg-primary-400 btn-rounded btn-icon legitRipple">
                                    <span class="letter-icon">{{ get_initial($evaluator->user->name) }}</span>
                                </a>
                            </div>

                            <div class="media-body">
                                <h6 class="media-heading">{{ $evaluator->user->name }}</h6>
                                <span class="text-muted">{{ $evaluator->type->name }}</span>
                            </div>

                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-success active" style="width: {{ $evaluator->getProgress($evaluator->type_id) }}%">
                                <span>{{ $evaluator->getProgress($evaluator->type_id) }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No evaluators information found.</p>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('admin.notices.summary-by-type', [$notice->id, 2]) }}" class="btn btn-default">
                <span class="text-thin">Show Summary</span>
            </a>
        </div>
    </div>
</fieldset>