<div role="tabpanel" class="tab-pane" id="tab-notice-files">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <th width="5%">#</th>
                <th>{{ trans('notices.attributes.files.name') }}</th>
                <th class="col-xs-2">{{ trans('notices.attributes.files.type') }}</th>
                <th class="col-xs-2">{{ trans('notices.attributes.files.size') }}</th>
                <th class="col-xs-1">&nbsp;</th>
            </thead>
            <tbody>
                @forelse($notice->files as $file)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ trans('notices.file-types.' . $file->type) }}</td>
                    <td>{{ $file->name }}</td>
                    <td>{{ $file->upload->size }}</td>
                    <td>
                        <a href="{{ $file->upload->url }}" target="_blank"><i class="icon-file-download"></i></a>
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