<div role="tabpanel" class="tab-pane" id="tab-notice-files">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th class="col-xs-2">{{ trans('notices.views.admin.files.table.type') }}</th>
                <th>{{ trans('notices.views.admin.files.table.name') }}</th>
                <th class="col-xs-2">{{ trans('notices.views.admin.files.table.size') }}</th>
                <th class="col-xs-1">&nbsp;</th>
            </thead>
            <tbody>
                @forelse($notice->files as $file)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ trans('notices.file_types.' . $file->type) }}</td>
                    <td>{{ $file->name }}</td>
                    <td>{{ $file->upload->size }}</td>
                    <td>
                        <a href="{{ $file->upload->url }}"><i class="icon-file-download"></i></a>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">{{ trans('notices.views.admin.files.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>