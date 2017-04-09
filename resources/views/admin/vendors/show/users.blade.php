<div role="tabpanel" class="tab-pane" id="tab-vendor-users">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <tr>
                    <th class="col-xs-1">#</th>
                    <th>{{ trans('users.attributes.name') }}</th>
                    <th>{{ trans('users.attributes.email') }}</th>
                    <th>{{ trans('users.attributes.roles') }}</th>
                    <th>{{ trans('users.attributes.created_at') }}</th>
                    <th width="40">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            @foreach($vendor->users()->get() as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <ul class="list-unstyled m-0">
                        @foreach($user->roles as $role)<li>{{ $role->display_name }}</li>@endforeach
                        </ul>
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                    <td><a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-xs bg-blue-700" target="new"><i class="icon-user"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>