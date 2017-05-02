@extends('layouts.portal')

@section('page-title', implode(' | ', [$notice->number, trans('notices.title')]))

@section('content')
<?php if(Auth::check() && Auth::user()->vendor && Auth::user()->vendor->purchases()->whereNoticeId($notice->id)->first()) : ?>
    <?php $fileTypes = ['public', 'purchase']; ?>
<?php else : ?>
    <?php $fileTypes = ['public']; ?>
<?php endif; ?>

<div class="row mb-20">
    <div class="col-xs-12 col-md-2">
        <a href="{{ route('root') }}" class="btn btn-default btn-block btn-labeled btn-raised legitRipple">
            <b><i class="icon-arrow-left52"></i></b> {{ trans('notices.views.show.back') }}
        </a>
    </div>

    @can('purchase', $notice)
    <div class="col-xs-12 col-md-2 col-md-offset-8">
        <a href="{{ route('cart.add', $notice->id) }}" class="btn btn-danger btn-block btn-raised legitRipple" data-method="PUT">
            {{ trans('notices.views.show.purchase') }} <i class="icon-cart-add2 position-right"></i>
        </a>
    </div>
    @endcan
</div>

@include('admin.notices.show.header')

<div class="row">
    <div class="col-xs-12 col-md-3">
        <ul class="list-group list-notice list-prompt-side-tab panel panel-flat" role="tablist">
            <li role="presentation" class="active">
                <a href="#tab-notice-details" aria-controls="tab-notice-details" role="tab" data-toggle="tab" class="list-group-item">
                    <i class="icon-clipboard3"></i> {{ trans('notices.menu.details') }}
                </a>
            </li>

            <li role="presentation">
                <a href="#tab-notice-events" aria-controls="tab-notice-events" role="tab" data-toggle="tab" class="list-group-item">
                    <i class="icon-calendar3"></i> {{ trans('notices.menu.events') }}
                </a>
            </li>

            <li role="presentation">
                <a href="#tab-notice-qualifications" aria-controls="tab-notice-qualifications" role="tab" data-toggle="tab" class="list-group-item">
                    <i class="icon-stack2"></i> {{ trans('notices.menu.qualifications') }}
                </a>
            </li>

            <li role="presentation">
                <a href="#tab-notice-files" aria-controls="tab-notice-files" role="tab" data-toggle="tab" class="list-group-item">
                    <i class="icon-copy3"></i> {{ trans('notices.menu.files') }}
                </a>
            </li>

            @if(setting('submission', false, $notice) && $notice->status_submission == 'published')

            <li class="list-group-divider"></li>

            <li role="presentation">    
                <a href="#tab-notice-submissions" aria-controls="tab-notice-submissions" role="tab" data-toggle="tab" class="list-group-item">
                    <i class="icon-file-presentation"></i> {{ trans('notices.menu.submissions') }}
                </a>
            </li>

            @endif

            @if(setting('award', false, $notice) && $notice->status_award == 'published')

            <li class="list-group-divider"></li>

            <li role="presentation">
                <a href="#tab-notice-award" aria-controls="tab-notice-award" role="tab" data-toggle="tab" class="list-group-item">
                    <i class="icon-medal2"></i> {{ trans('notices.menu.award') }}
                </a>
            </li>

            @endif
        </ul>
    </div>

    <div class="col-xs-12 col-md-9">
        <div class="tab-content">
            @include('admin.notices.show.details')
            @include('admin.notices.show.events')
            @include('admin.notices.show.qualifications')
            @include('admin.notices.show.files')

            @if(setting('submission', false, $notice) && $notice->status_submission == 'published')

            @include('notices.show.submissions')

            @endif

            @if(setting('award', false, $notice) && $notice->status_submission == 'published')

            @include('notices.show.award')

            @endif
        </div>
    </div>
</div>
@endsection
