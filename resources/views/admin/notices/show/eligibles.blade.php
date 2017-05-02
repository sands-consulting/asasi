<div role="tabpanel" class="tab-pane" id="tab-notice-eligibles">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('notices.attributes.eligibles.name') }}</th>
                <th class="col-xs-2">{{ trans('notices.attributes.eligibles.exception') }}</th>
                <th class="col-xs-2">{{ trans('notices.attributes.eligibles.notified_at') }}</th>
                <th width="40">&nbsp;</th>
            </thead>
            <tbody>
                @forelse($notice->eligibles()->get() as $eligible)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $eligible->vendor->name }}
                        <?php $vendor = $eligible->vendor; ?>
                        @include('admin.vendors.index.status')
                    </td>
                    <td>
                        {!! boolean_icon($eligible->exception) !!}
                        @if($eligible->exception)
                        <br><small>{!! nl2br($eligible->remarks) !!}</small>
                        @if($eligible->upload)<a href="{{ $eligible->upload->url }}" target="_blank"></a>@endif
                        @endif
                    </td>
                    <td>
                        @if($eligible->notified_at)
                        {{ $eligible->notified_at->format('d/m/Y H:i:s') }}
                        @else
                        {!! blank_icon($eligible->notified_at) !!}
                        @endif
                    </td>
                    <td>
                        @can('show', $eligible->vendor)
                        <a href="{{ route('admin.vendors.show', $eligible->vendor_id) }}" class="btn btn-xs bg-blue-700" target="_blank"><i class="icon-office"></i></a>
                        @endcan
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" align="center">
                        {{ trans('notices.views.admin.show.eligibles.empty') }}
                    </td>
                </tr>
                @endforelse
                <tr>
                    <td colspan="5" align="center">
                        <a href="#" data-toggle="modal" data-target="#modal-eligible"><i class="icon-plus-circle2"></i> {{ trans('notices.buttons.add-eligible') }}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>