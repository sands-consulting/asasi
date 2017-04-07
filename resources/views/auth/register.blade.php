@extends('layouts.portal')

@section('ahead')
    @include('layouts.portal.aheads.public')
@endsection

@section('page-title', trans('auth.register'))

@section('content')
    @include('layouts.menu.portal')
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 p-20">
                    <h5>Why Regitering with Us</h5>
                    <p class="text-justify">
                        Welcome to Procurement Management for Tender & Project System (PROMPT).
                        By joining PROMPT you will receive priority information before it’s released to the public
                        domain. You can use your account to:
                    </p>
                    <ul class="list list-square" style="list-style-type: square; padding-left: 25px">
                        <li>Look for matched Tender & Quotation</li>
                        <li>Buy Tender & Quotation documents online</li>
                        <li>Renew your subscriptions</li>
                        <li>Check your transactions history and activities log</li>
                        <li>Manage your account details</li>
                        <li>Participate Tender & Quotation exercise online</li>
                        <li>Notified on current event and news.</li>
                    </ul>
                    <br>
                    <p class="text-justify">
                        Sign-up today to receive the latest development news straight to your inbox.
                    </p>
                    <p class="text-justify">
                        All information provided will be treated in the strictest confidence and in compliance with the
                        Personal Data Protection Act 2010 (PDPA),
                        no information shall be passed onto any third party and shall only be used to advise of any
                        amendments or updates throughout the progress
                        of any chosen development.
                    </p>
                </div>
                <div class="col-md-6 p-20">
                    <h5>Register New Account</h5>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('vendor_registration_number') ? ' has-error' : '' }} has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="vendor_registration_number"
                                   value="{{ old('vendor_registration_number') }}"
                                   placeholder="{{ trans('auth.attributes.vendor_registration_number') }}">
                            <div class="form-control-feedback">
                                <i class="icon-bookmark text-muted"></i>
                            </div>
                            @if($errors->has('vendor_registration_number'))<span
                                    class="help-block">{{ $errors->first('vendor_registration_number') }}</span>@endif
                        </div>

                        <div class="form-group{{ $errors->has('vendor_name') ? ' has-error' : '' }} has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="vendor_name" value="{{ old('vendor_name') }}"
                                   placeholder="{{ trans('auth.attributes.vendor_name') }}">
                            <div class="form-control-feedback">
                                <i class="icon-office text-muted"></i>
                            </div>
                            @if($errors->has('vendor_name'))<span
                                    class="help-block">{{ $errors->first('vendor_name') }}</span>@endif
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                   placeholder="{{ trans('auth.attributes.name') }}">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                            @if($errors->has('name'))<span class="help-block">{{ $errors->first('name') }}</span>@endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback has-feedback-left">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   placeholder="{{ trans('auth.attributes.email') }}">
                            <div class="form-control-feedback">
                                <i class="icon-envelop5 text-muted"></i>
                            </div>
                            @if($errors->has('email'))<span
                                    class="help-block">{{ $errors->first('email') }}</span>@endif
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback has-feedback-left">
                                    <input type="password" class="form-control" name="password"
                                           placeholder="{{ trans('auth.attributes.password') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    @if($errors->has('password'))<span
                                            class="help-block">{{ $errors->first('password') }}</span>@endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6">
                                <div class="form-group has-feedback has-feedback-left">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder="{{ trans('auth.attributes.password_confirmation') }}">
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit"
                                    class="btn bg-blue-700 btn-block legitRipple">{{trans('actions.register')}}</button>
                        </div>

                        <div class="text-center">
                            <a href="{{ url('password/reset') }}">{{trans('auth.forgot_password')}}</a> &bullet; <a
                                    href="{{ url('login') }}">{{trans('auth.login')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
