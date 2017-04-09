<div role="tabpanel" class="tab-pane" id="tab-vendor-files">
    <div class="panel panel-flat">
        <table class="table">
            <thead>
                <tr>
                    <th class="col-xs-1">#</th>
                    <th>{{ trans('vendors.attributes.files.type') }}</th>
                    <th>{{ trans('vendors.attributes.files.size') }}</th>
                    <th>{{ trans('vendors.attributes.files.type') }}</th>
                    <th width="40">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php $index = 1; ?>
            @forelse($vendor->files()->get() as $file)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $file->type->display_name }}</td>
                    <td>{{ $file->upload->size }}</td>
                    <td>{{ $file->upload->mime_type }}</td>
                    <td><a href="{{ $file->upload->url }}" class="btn btn-xs bg-blue-700" target="new"><i class="icon-file-download"></i></a></td>
                </tr>
                <?php $index++; ?>
            @empty
                <tr>
                    <td colspan="5" class="text-center">{{ trans('vendors.views.admin.show.files.empty') }}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>