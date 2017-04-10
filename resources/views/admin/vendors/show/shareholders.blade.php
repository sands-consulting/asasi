<div role="tabpanel" class="tab-pane" id="tab-vendor-shareholders">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <tr>
                    <th class="col-xs-1">#</th>
                    <th>{{ trans('vendors.attributes.shareholders.name') }}</th>
                    <th>{{ trans('vendors.attributes.shareholders.identity_number') }}</th>
                    <th>{{ trans('vendors.attributes.shareholders.nationality') }}</th>
                    <th>{{ trans('vendors.attributes.shareholders.percentage') }}</th>
                </tr>
            </thead>
            <tbody>
            @forelse($vendor->shareholders()->get() as $shareholder)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $shareholder->name }}</td>
                    <td>{{ $shareholder->identity_number }}</td>
                    <td>{{ $shareholder->nationality->name }}</td>
                    <td>{{ $shareholder->percentage }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">{{ trans('vendors.views.show.details.shareholders.empty') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>