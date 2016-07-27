@extends('layouts.public')

@section('content')
<div class="page-container">
    <div class="page-content">
    	<div class="content-wrapper">
    		<div class="row">
    			<div class="col-xs-12 col-sm-12">
    				<form action="#">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">{{ trans('vendors.views.index.panels.vendors.title') }}</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                            </div>

                            <div class="panel-body">
                                <fieldset>
                                    <legend class="text-semibold">
                                        <i class="icon-file-text2 position-left"></i>
                                        Enter your information
                                        <a class="control-arrow" data-toggle="collapse" data-target="#demo1">
                                            <i class="icon-circle-down2"></i>
                                        </a>
                                    </legend>

                                    <div class="collapse in" id="demo1">
                                        <div class="form-group">
                                            <label>Enter your name:</label>
                                            <input type="text" class="form-control" placeholder="Eugene Kopyov">
                                        </div>

                                        <div class="form-group">
                                            <label>Enter your password:</label>
                                            <input type="password" class="form-control" placeholder="Your strong password">
                                        </div>

                                        <div class="form-group">
                                            <label>Repeat password:</label>
                                            <input type="password" class="form-control" placeholder="Repeat password">
                                        </div>

                                        <div class="form-group">
                                            <label>Your message:</label>
                                            <textarea rows="5" cols="5" class="form-control" placeholder="Enter your message here"></textarea>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend class="text-semibold">
                                        <i class="icon-reading position-left"></i>
                                        Add personal details
                                        <a class="control-arrow" data-toggle="collapse" data-target="#demo2">
                                            <i class="icon-circle-down2"></i>
                                        </a>
                                    </legend>

                                    <div class="collapse in" id="demo2">
                                        <div class="form-group">
                                            <label>Your country:</label>
                                            <select data-placeholder="Select your country" class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option value="USA">USA</option> 
                                                <option value="United Kingdom">United Kingdom</option> 
                                                <option value="...">...</option> 
                                                <option value="Australia">Australia</option> 
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-68i8-container"><span class="select2-selection__rendered" id="select2-68i8-container" title="USA">USA</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>

                                        <div class="form-group">
                                            <label>Select your state:</label>
                                            <select data-placeholder="Select your state" class="select select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option></option>
                                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                </optgroup>
                                                <optgroup label="Pacific Time Zone">
                                                    <option value="CA">California</option>
                                                    <option value="NV">Nevada</option>
                                                    <option value="WA">Washington</option>
                                                </optgroup>
                                                <optgroup label="Mountain Time Zone">
                                                    <option value="AZ">Arizona</option>
                                                    <option value="CO">Colorado</option>
                                                    <option value="WY">Wyoming</option>
                                                </optgroup>
                                                <optgroup label="Central Time Zone">
                                                    <option value="AL">Alabama</option>
                                                    <option value="AR">Arkansas</option>
                                                    <option value="KY">Kentucky</option>
                                                </optgroup>
                                                <optgroup label="Eastern Time Zone">
                                                    <option value="CT">Connecticut</option>
                                                    <option value="DE">Delaware</option>
                                                    <option value="FL">Florida</option>
                                                </optgroup>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-dw4c-container"><span class="select2-selection__rendered" id="select2-dw4c-container"><span class="select2-selection__placeholder">Select your state</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="display-block">Gender:</label>

                                            <label class="radio-inline">
                                                <div class="choice"><span class="checked"><input type="radio" name="gender2" class="styled" checked="checked"></span></div>
                                                Male
                                            </label>

                                            <label class="radio-inline">
                                                <div class="choice"><span><input type="radio" name="gender2" class="styled"></span></div>
                                                Female
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label class="display-block">Your CV:</label>
                                            <div class="uploader"><input type="file" class="file-styled"><span class="filename" style="-webkit-user-select: none;">No file selected</span><span class="action btn bg-pink-400 legitRipple" style="-webkit-user-select: none;">Choose File</span></div>
                                            <span class="help-block">Accepted formats: pdf, doc. Max file size 2Mb</span>
                                        </div>

                                        <div class="form-group">
                                            <label>About yourself:</label>
                                            <textarea rows="5" cols="5" placeholder="Few words about yourself..." class="form-control"></textarea>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary legitRipple">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
    </div>
</div>
@stop
