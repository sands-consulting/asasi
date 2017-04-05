<div role="tabpanel" class="tab-pane" id="tab-vendor-accounts">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <tr>
                    <th class="col-xs-1">#</th>
                    <th>{{ trans('vendors.attributes.accounts.account_name') }}</th>
                    <th>{{ trans('vendors.attributes.accounts.account_number') }}</th>
                    <th>{{ trans('vendors.attributes.accounts.bank_name') }}</th>
                    <th>{{ trans('vendors.attributes.accounts.bank_iban') }}</th>
                    <th>{{ trans('vendors.attributes.accounts.bank_address') }}</th>
                </tr>
            </thead>
            <tbody>
            <?php $index = 1; ?>
            @forelse($vendor->accounts()->get() as $account)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $account->account_name }}</td>
                    <td>{{ $account->account_number }}</td>
                    <td>{{ $account->bank_name }}</td>
                    <td>{{ $account->bank_iban }}</td>
                    <td>{{ $account->bank_address }}</td>
                </tr>
                <?php $index++; ?>
            @empty
                <tr>
                    <td colspan="6" class="text-center">{{ trans('vendors.views.admin.show.accounts.empty') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>