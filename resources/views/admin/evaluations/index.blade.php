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

<div id="evaluation-wrapper" data-url="/api/evaluations">
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
                        <tr v-if="evaluations.length > 0" v-for="(evaluation, index) in evaluations">
                            <td v-text="evaluation.submission_number"></td>
                            <td v-text="evaluation.type"></td>
                            <td v-text="evaluation.notice_number"></td>
                            <td v-html="evaluation.status_label"></td>
                            <td>
                                <div v-if="! loading">
                                    <div v-if="evaluation.status == 'pending'" class="text-center v-cloak">
                                        <div v-if="! evaluation.hasOwnProperty('confirm') || ! evaluation.confirm" class="action">
                                            <button 
                                                type="button" class="btn btn-primary btn-xs" data-toggle="modal" :data-target="'#modal_accept' + evaluation.id">
                                                Accept
                                            </button>
                                            <a href="#" class="btn btn-xs btn-danger" @click="confirmation(index)">Reject</a>
                                        </div>
                                        <div v-else class="text-center">
                                            <small>Are you sure you want to reject?</small> <br>
                                            <a href="#" class="btn btn-xs btn-success" @click="reject(evaluation.id)">Yes</a>
                                            <a href="#" class="btn btn-xs btn-danger" @click="cancel(index)">No</a>
                                        </div>
                                    </div>
                                    {{-- todo: refactor this code --}}
                                    <div v-if="evaluation.status == 'accepted' || evaluation.status == 'incomplete' || evaluation.status == 'completed'" class="text-center">
                                        <a :href="evaluation.url_edit" class="btn btn-default btn-xs">Evaluate</a>
                                    </div>
                                </div>
                                <div v-else class="text-center">
                                    <i class="icon-spinner4 spin"></i>
                                </div>
                                <modal :modal-id="'modal_accept' + evaluation.id" :evaluation="evaluation"></modal>
                            </td>
                        </tr>
                        <tr v-if="evaluations.length == 0">
                            <td colspan="5">Currently you do not have submission to evaluate.</td>
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