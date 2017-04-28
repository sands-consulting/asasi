@extends('layouts.admin')

@section('page-title', trans('evaluations.title'))

@section('header')
<div class="page-title">
    <h4>{{ trans('evaluations.title') }}</h4>
</div>
<div class="heading-elements">
    
</div>
@endsection

@section('content')

<div id="evaluation-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">{{ trans('evaluations.views.index.submissions') }}</h6>
                </div>

                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th>{{ trans('evaluations.attributes.submission') }}</th>
                            <th>{{ trans('evaluations.attributes.type') }}</th>
                            <th>{{ trans('evaluations.attributes.notice') }}</th>
                            <th>{{ trans('evaluations.attributes.status') }}</th>
                            <th class="text-center">{{ trans('app.table.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="evaluations.length > 0" v-for="evaluation in evaluations">
                            <td v-text="evaluation.submission_number"></td>
                            <td v-text="evaluation.type"></td>
                            <td v-text="evaluation.notice"></td>
                            <td v-text="evaluation.status"></td>
                            <td class="text-center">
                                <div v-if="! loading" class="v-cloak">
                                    <div v-if="! confirm" class="action">
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_accept">
                                            Accept
                                        </button>
                                        <a href="#" class="btn btn-xs btn-danger" @click="confirmation('reject')">Reject</a>
                                    </div>
                                    <div v-if="confirm">
                                        <a href="#" class="btn btn-xs btn-success" @click="confirmed(evaluation.id, action)">Yes</a>
                                        <a href="#" class="btn btn-xs btn-danger" @click="cancel()">No</a>
                                    </div>
                                </div>
                                <div v-show="loading" class="text-center">
                                    <i class="icon-spinner4 spin"></i>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="evaluations.length == 0">
                            <td colspan="5">Currently you have submission to evaluate.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.evaluations.index.modal_accept')

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/pages/evaluations/index.js') }}"></script>
@endsection