@extends('layouts.public')

@section('sidebar')
<div class="sidebar sidebar-secondary sidebar-default">
    <div class="sidebar-content ml-15">

        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible mt-10">
            <div class="category-title h6">
                <span>Notices</span>
                <ul class="icons-list">
                    <li><a href="#" data-action="collapse"></a></li>
                </ul>
            </div>

            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    {{-- <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="" data-original-title="Main pages"></i></li> --}}
                    <li><a href="{{ route('dashboard.index') }}"><i class="icon-home4"></i> <span>All</span></a></li>
                    <li><a href="{{ route('dashboard.eligible') }}"><i class="icon-home4"></i> <span>Eligibles</span></a></li>
                    <li><a href="{{ route('dashboard.purchased') }}"><i class="icon-home4"></i> <span>My Notices</span></a></li>
                    <li class="active"><a href="{{ route('dashboard.limited') }}"><i class="icon-home4"></i> <span>Limited</span></a></li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
@endsection

@section('content')
    <div class="panel panel-flat mt-15">
        <div class="panel-heading">
            <h5 class="panel-title">Notice</h5>
            <div class="heading-elements">
                <ul class="list-unstyle list-inline pull-right mt-15">
                    <li><i class="icon-newspaper mr-5"></i>Tender</li>
                    <li><i class="icon-newspaper mr-5"></i>Quotation</li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    {!! $dataTable->table(['class' => 'table table-bordered table-condensed']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection