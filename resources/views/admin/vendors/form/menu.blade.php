<ul class="list-group list-vendor list-prompt-side-tab panel panel-flat" role="tablist">
    <li role="presentation" class="active">
        <a href="#tab-vendor-details" aria-controls="tab-vendor-details" role="tab" data-toggle="tab" class="list-group-item" @click="disableSubmit">
            <i class=" icon-file-text"></i> {{ trans('vendors.menu.details') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-contact-person" aria-controls="tab-vendor-contact-person" role="tab" data-toggle="tab" class="list-group-item" @click="disableSubmit">
            <i class="icon-user-tie"></i> {{ trans('vendors.menu.contact-person') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-qualifications" aria-controls="tab-vendor-qualifications" role="tab" data-toggle="tab" class="list-group-item" @click="disableSubmit">
            <i class="icon-folder-check"></i> {{ trans('vendors.menu.qualifications') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-shareholders" aria-controls="tab-vendor-shareholders" role="tab" data-toggle="tab" class="list-group-item" @click="disableSubmit">
            <i class="icon-portfolio"></i> {{ trans('vendors.menu.shareholders') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-employees" aria-controls="tab-vendor-employees" role="tab" data-toggle="tab" class="list-group-item" @click="disableSubmit">
            <i class="icon-users4"></i> {{ trans('vendors.menu.employees') }}
        </a>
    </li>
    <li role="presentation">
        <a href="#tab-vendor-accounts" aria-controls="tab-vendor-accounts" role="tab" data-toggle="tab" class="list-group-item" @click="disableSubmit">
            <i class="icon-database4"></i> {{ trans('vendors.menu.accounts') }}
        </a>
    </li>

    <li role="presentation">
        <a href="#tab-vendor-files" aria-controls="tab-vendor-files" role="tab" data-toggle="tab" class="list-group-item" @click="enableSubmit">
            <i class="icon-stack"></i> {{ trans('vendors.menu.files') }}
        </a>
    </li>
</ul>
