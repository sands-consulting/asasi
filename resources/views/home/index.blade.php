@extends('layouts.landing')

@section('content')
    <section class="landing-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="hidden-xs">
                        <img src="/assets/images/landing-picture-1.png" alt="landing-page-image" class="img-responsive">
                    </div>
                    <fieldset class="mb-20">
                        <legend class="text-semibold no-padding-left no-padding-right"> <i class="icon-newspaper"></i> Berita Terkini </legend>
                        <div>
                            <div class="col-md-10 no-padding-left">
                                <h5 class="no-margin">Ralat Penutupan Peti Sebutharga Bagi Kerja Gred G2 Pengkhususan CE21 & CE01, MARRIS, Fasa 2 2016 (26 KERJA)</h5>
                                <span class="text-muted">9 May 2016</span>
                            </div>
                            <div class="col-md-2 no-padding-right">
                                <span class="badge bg-orange-400 pull-right text-size-large">Quotation</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-3">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('login') }}">
                        {!! csrf_field() !!}
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}">
                            <div class="form-control-feedback">
                                <i class="icon-envelop5 text-muted"></i>
                            </div>
                        </div>
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" name="password" placeholder="{{ trans('auth.password') }}">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn bg-blue-700 btn-block legitRipple">{{trans('auth.login_button')}}</button>
                        </div>
                        <div class="text-center">
                            <a href="{{ url('/password/email') }}">{{trans('auth.forgot_password')}}</a>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block legitRipple">{{trans('auth.login_button')}}</button>
                        </div>
                        <div class="text-center text-muted">
                            Get your latest info on the latest Tender and Quotation in Selangor!
                        </div>
                        <hr/>
                        <div class="text-center text-muted">
                            <i class="icon-presentation"></i> How To Register
                        </div>
                        <hr/>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 landing--dt-header">
                    <div class="col-md-9"><h5>Notice</h5></div>
                    <div class="col-md-3">
                        <ul class="list-unstyle list-inline pull-right mt-15">
                            <li><i class="icon-newspaper mr-5"></i>Tender</li>
                            <li><i class="icon-newspaper mr-5"></i>Quotation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="landing-white">
        <div class="container landing--dt-body">
            <div class="row no-padding">
                <div class="col-md-12">
                    <div class="col-md-12">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>  
@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection