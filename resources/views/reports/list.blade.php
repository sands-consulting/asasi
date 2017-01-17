@foreach([1, 2, 3, 4, 5] as $s)
@if ($s == 5 || (!Auth::user()->ability([], ['Report:IsFinance']) || Auth::user()->ability(['Admin'], [])))
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">{{ trans('reports.s' . $s . '.title') }}</h3>
        </div>
        <div class="panel-body">
            <ol>
                @foreach(trans('reports.s'.$s) as $key => $value)
                @if($key != 'title')
                <li>{!! link_to('reports/s' . $s . '/' . $key, $value['title']) !!}</li>
                @endif
                @endforeach
            </ol>
        </div>
    </div>
@endif
@endforeach