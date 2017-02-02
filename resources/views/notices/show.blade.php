@extends('layouts.portal')

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-10">
                <small class="text-muted">{{ $notice->number}} (<i>{{ $notice->organization->name}}</i>)</small>
                <br>
                {{ $notice->name }}
            </div>
            <div class="heading-elements">
                @if ($notice->status == 'published')
                    <span class="label label-success heading-text">
                @elseif ($notice->status == 'cancelled')
                    <span class="label label-danger heading-text">
                @else
                    <span class="label label-default heading-text">
                @endif
                {{ $notice->status }}</span>
            </div>
        </div>
    </div>
    
    <div class="panel-body">
        <div class="row">
            <div class="tabbable nav-tabs-vertical nav-tabs-left">
                <ul class="nav nav-tabs nav-tabs-highlight">
                    <li class="active">
                        <a data-target="#left-tab1" data-toggle="tab"><i class="icon-clipboard3 position-left"></i> Notice Details</a>
                    </li>
                    <li>
                        <a data-target="#tab-events" data-toggle="tab"><i class="icon-calendar3 position-left"></i> Events</a>
                    </li>
                    <li>
                        <a data-target="#left-tab6" data-toggle="tab"><i class="icon-medal-star position-left"></i> Award</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active has-padding" id="left-tab1">
                        @include('notices._show_notice')
                    </div>
                    
                    <div class="tab-pane has-padding" id="tab-events">
                        @include('notices._show_events')
                    </div>

                    <div class="tab-pane has-padding" id="left-tab6">
                        @include('notices._show_award')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer">
        <div class="col-md-12">
            <a href="#" onclick="javascript:history.back(); return false;" class="btn btn-default"><i class="icon-arrow-left52"></i> Back</a>
        </div>
    </div>
</div>
@endsection
