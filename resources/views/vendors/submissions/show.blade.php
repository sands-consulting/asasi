@extends('layouts.portal')

@section('content')
    <div id="submission-wrapper" data-submission="{{ $submission->id or null }}">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row row-eq-height">
                    <div class="col-md-9 eq-element" style="border-right: 1px solid #dcdcdc">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Notice Details</h5>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-8">
                                <div class="text-muted">{{ trans('notices.attributes.name') }}</div>
                                <div class="form-control-static">{{ $submission->notice->name }}</div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted">{{ trans('notices.attributes.number') }}</div>
                                <div class="form-control-static">{{ $submission->notice->number }}</div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <div class="text-muted">{{ trans('notices.attributes.price') }}</div>
                                <div class="form-control-static">
                                    {{ $submission->notice->price
                                        ? $submission->notice->price
                                        : 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted">{{ trans('notices.attributes.notice_type_id') }}</div>
                                <div class="form-control-static">
                                    {{ $submission->notice->type
                                        ? $submission->notice->type->name
                                        : 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted">{{ trans('notices.attributes.expired_at') }}</div>
                                <div class="form-control-static">
                                    {{ $submission->notice->expired_at
                                        ? $submission->notice->expired_at->formatDateFromSetting()
                                        : 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-4">
                                <div class="text-muted">{{ trans('notices.attributes.published_at') }}</div>
                                <div class="form-control-static">
                                    {{ $submission->notice->published_at
                                        ? $submission->notice->published_at->formatDateFromSetting()
                                        : 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted">{{ trans('notices.attributes.purchased_at') }}</div>
                                <div class="form-control-static">
                                    {{ $submission->notice->purchased_at
                                        ? $submission->notice->purchased_at->formatDateFromSetting()
                                        : 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-muted">{{ trans('notices.attributes.submission_at') }}</div>
                                <div class="form-control-static">
                                    {{ $submission->notice->submission_at
                                        ? $submission->notice->submission_at->formatDateFromSetting()
                                        : 'N/A' }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="text-muted">{{ trans('notices.attributes.submission_address') }}</div>
                                <div class="form-control-static">
                                    {!! $submission->notice->submission_address
                                        ? nl2br($submission->notice->submission_address)
                                        : 'N/A' !!}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="text-muted">{{ trans('notices.attributes.description') }}</div>
                                <div class="form-control-static">
                                    {{ !empty($submission->notice->description)
                                        ? nl2br($submission->notice->description)
                                        : 'N/A' }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-muted">{{ trans('notices.attributes.rules') }}</div>
                                <div class="form-control-static">
                                    {!! !empty($submission->notice->rules)
                                        ? nl2br($submission->notice->rules)
                                        : 'N/A' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 eq-element">
                        <div v-if="!loading" v-cloak>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="text-center">Notice Requirements</h5>
                                </div>
                            </div>

                            {{-- submission requirement --}}
                            <div class="row" v-for="evaluation in notice.evaluation_settings">
                                <hr>
                                <div class="col-md-12 mb-5">
                                    @{{ evaluation.type.name }}
                                    <span v-if="evaluation.submission_status == 'completed'"
                                          class="label label-success label-rounded pull-right text-thin">Completed</span>
                                    <span v-else class="label label-danger label-rounded pull-right text-thin">Incomplete</span>
                                </div>
                                <div class="col-md-12">
                                    <p class="text-muted">
                                        <small class="text-italic">Note: Lorem ipsum dolor sit amet, consectetur
                                            adipisicing
                                            elit. Hic, corporis minus vel! Quibusdam dolor, cupiditate harum autem
                                            commodi.
                                        </small>
                                    </p>
                                    <div class="text-right">
                                        <a :href="getFormUrl(evaluation.type_id, evaluation.submission_exists)">
                                            <small>
                                                {{ trans('submissions.buttons.public.commercial.view') }}
                                                <i class="icon-arrow-right22"></i>
                                            </small>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <a v-show="submission.status == 'submitted'" href="#"
                               onclick="window.open('{{ route('vendors.submissions.slip', [$vendor->id, $submission->id]) }}', 'Submission Slip', 'location=30, status=1, resizable=1, titlebar=1, width=500, height=860'); return false;"
                               class="btn btn-default btn-block legitRipple submission-btn">
                                <span class="text-thin">Print Slip</span>
                            </a>
                            {{--<a --}}
                            {{--href="{{ route('vendors.submissions.submit', $submission->id) }}"--}}
                            {{--target="_blank"--}}
                            {{--data-method="POST"--}}
                            {{--class="btn btn-primary btn-block legitRipple submission-btn"--}}
                            {{--data-confirm="{{ trans('app.confirm-submission') }}" --}}
                            {{--<span class="text-thin">Submit</span>--}}
                            {{--</a>--}}
                            <p v-if="! can_submit" class="submission-btn text-danger">Please complete requirement above
                                and submit before proceed.</p>
                        </div>
                        <div v-show="loading" class="text-center">
                            <i class="icon-spinner4 spin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('assets/js/pages/submissions/show.js') }}"></script>
@endsection