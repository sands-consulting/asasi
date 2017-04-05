<div role="tabpanel" class="tab-pane" id="tab-vendor-employees">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <tr>
                    <th class="col-xs-1">#</th>
                    <th>{{ trans('vendors.attributes.employees.name') }}</th>
                    <th>{{ trans('vendors.attributes.employees.designation') }}</th>
                    <th>{{ trans('vendors.attributes.employees.role') }}</th>
                </tr>
            </thead>
            <tbody>
            <?php $index = 1; ?>
            @forelse($vendor->employees()->get() as $employee)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->designation }}</td>
                    <td>{{ trans('vendors.attributes.employees.roles.' . $employee->role) }}</td>
                </tr>
                <?php $index++; ?>
            @empty
                <tr>
                    <td colspan="4" class="text-center">{{ trans('vendors.views.admin.show.employees.empty') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>