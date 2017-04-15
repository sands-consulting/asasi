@extends('layouts.portal')

@section('page-title', implode(' | ', [$notice->number, trans('notices.title')]))

@section('content')
<?php if(Auth::check() && Auth::user()->vendor && Auth::user()->vendor->purchases()->find($notice->id)) : ?>
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

    <div class="col-xs-12 col-md-2 col-md-offset-8">
        <a href="{{ route('cart.add', $notice->id) }}" class="btn btn-danger btn-block btn-raised legitRipple">
            {{ trans('notices.views.show.purchase') }} <i class=" icon-cart-add2 position-right"></i>
        </a>
    </div>
</div>

@include('admin.notices.show.header')

<div class="row">
    <div class="col-xs-12 col-md-3">
        @include('admin.notices.show.menu')
    </div>

    <div class="col-xs-12 col-md-9">
        <div class="tab-content">
            @include('admin.notices.show.details')
            @include('admin.notices.show.events')
            @include('admin.notices.show.qualifications')
            @include('admin.notices.show.files')
        </div>
    </div>
</div>
@endsection
