<?php $i = 1; ?>
@foreach ($requirements as $requirement)
    <div class="row mb-5 box row-eq-height">
        <div class="col-xs-4 col-md-1 text-center eq-element valign-middle">{{ $i }}</div>
        <div class="col-xs-8 col-md-2 eq-element">
            {!! $requirement->mandatory ? '<span class="text-success">Mandatory</span>': '<span class="text-danger">Not Mandatory</span>' !!}</div>
        <div class="col-xs-12 col-md-7 eq-element">{{ $requirement->title }}</div>
        <div class="col-xs-12 col-md-2 eq-element greyed">
            {!! Former::number('scores['. $requirement->id .']')
                ->label(false)
                ->append('/ ' . $requirement->full_score)
                ->addClass('text-center')
                ->min(0)
                ->max($requirement->full_score)
                ->value($requirement->score)
                ->required() !!}
        </div>
    </div>
    <?php $i++ ?>
@endforeach