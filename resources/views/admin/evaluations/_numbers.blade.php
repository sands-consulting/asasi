<div class="row">
    <div class="col-xs-12 col-md-4">
        <a href="#" class="prompt-box border border-bottom-grey-600">
            <div class="title text-center">{{ trans('evaluations.numbers.all') }}</div>
            <div class="number text-green-600">2</div>
        </a>
    </div>

    <div class="col-xs-12 col-md-4">
        <a href="#" class="prompt-box border border-bottom-teal-400">
            <div class="title text-center">{{ trans('evaluations.numbers.commercials') }}</div>
            <div class="number text-teal-400">{{ $evaluation->where }}</div>
        </a>
    </div>

    <div class="col-xs-12 col-md-4">
        <a href="#" class="prompt-box border border-bottom-teal-400">
            <div class="title text-center">{{ trans('evaluations.numbers.technicals') }}</div>
            <div class="number text-teal-400">1</div>
        </a>
    </div>
</div>