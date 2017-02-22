@if(Auth::check() && Auth::user()->hasPermission('access:vendor') && !in_array(Auth::user()->vendor->status, ['active', 'inactive', 'blacklisted']))
<div class="wizard-vendor">
    <div class="wizard">
        <div class="steps clearfix">
            <ul role="tablist">
                @if(in_array(Auth::user()->vendor->status, ['draft', 'rejected']))
                <li role="tab" class="first current" aria-disabled="false" aria-selected="true">
                    <a href="{{ route('vendors.edit', Auth::user()->vendor->id) }}">
                        <span class="number">1</span>
                        {{ trans('app.widgets.portal.wizard.application') }}
                    </a>
                </li>
                @else
                <li role="tab" class="first done" aria-disabled="false" aria-selected="true">
                    <a href="#">
                        <span class="number">1</span>
                        {{ trans('app.widgets.portal.wizard.application') }}
                    </a>
                </li>
                @endif

                @if(Auth::user()->vendor->status == 'pending')
                <li role="tab" class="current" aria-disabled="false" aria-selected="true">
                    <a href="#">
                        <span class="number">2</span>
                        {{ trans('app.widgets.portal.wizard.approval') }}
                    </a>
                </li>
                @elseif(in_array(Auth::user()->vendor->status, ['draft', 'rejected']))
                <li role="tab" class="disabled" aria-disabled="false" aria-selected="true">
                    <a href="#">
                        <span class="number">2</span>
                        {{ trans('app.widgets.portal.wizard.approval') }}
                    </a>
                </li>
                @else
                <li role="tab" class="done" aria-disabled="false" aria-selected="true">
                    <a href="#">
                        <span class="number">2</span>
                        {{ trans('app.widgets.portal.wizard.approval') }}
                    </a>
                </li>
                @endif

                @if(Auth::user()->vendor->status == 'approved')
                <li role="tab" class="last current" aria-disabled="false" aria-selected="true">
                    <a href="#">
                        <span class="number">3</span>
                        {{ trans('app.widgets.portal.wizard.subscription') }}
                    </a>
                </li>
                @else
                <li role="tab" class="last disabled" aria-disabled="false" aria-selected="true">
                    <a href="#">
                        <span class="number">3</span>
                        {{ trans('app.widgets.portal.wizard.subscription') }}
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endif
