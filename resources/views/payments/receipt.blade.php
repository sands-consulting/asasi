@extends('layouts.public')

@section('content')
<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="panel-title">{{ trans('payments.receipt') }}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body no-padding-bottom">
                            <div class="row">
                                <div class="col-sm-6 content-group">
                                    <ul class="list-condensed list-unstyled">
                                        <li>2269 Elba Lane</li>
                                        <li>Paris, France</li>
                                        <li>888-555-2311</li>
                                    </ul>
                                </div>

                                <div class="col-sm-6 content-group">
                                    <div class="receipt-details">
                                        <h5 class="text-uppercase text-semibold">receipt #49029</h5>
                                        <ul class="list-condensed list-unstyled">
                                            <li>Date: <span class="text-semibold">January 12, 2015</span></li>
                                            <li>Due date: <span class="text-semibold">May 12, 2015</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-9 content-group">
                                    <span class="text-muted">receipt To:</span>
                                    <ul class="list-condensed list-unstyled">
                                        <li><h5>Rebecca Manes</h5></li>
                                        <li><span class="text-semibold">Normand axis LTD</span></li>
                                        <li>3 Goodman Street</li>
                                        <li>London E1 8BF</li>
                                        <li>United Kingdom</li>
                                        <li>888-555-2311</li>
                                        <li><a href="#">rebecca@normandaxis.ltd</a></li>
                                    </ul>
                                </div>

                                <div class="col-md-6 col-lg-3 content-group">
                                    <span class="text-muted">Payment Details:</span>
                                    <ul class="list-condensed list-unstyled receipt-payment-details">
                                        <li><h5>Total Due: <span class="text-right text-semibold">$8,750</span></h5></li>
                                        <li>Bank name: <span class="text-semibold">Profit Bank Europe</span></li>
                                        <li>Country: <span>United Kingdom</span></li>
                                        <li>City: <span>London E1 8BF</span></li>
                                        <li>Address: <span>3 Goodman Street</span></li>
                                        <li>IBAN: <span class="text-semibold">KFH37784028476740</span></li>
                                        <li>SWIFT code: <span class="text-semibold">BPT4E</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th class="col-sm-1">Rate</th>
                                        <th class="col-sm-1">Hours</th>
                                        <th class="col-sm-1">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="no-margin">Create UI design model</h6>
                                            <span class="text-muted">One morning, when Gregor Samsa woke from troubled.</span>
                                        </td>
                                        <td>$70</td>
                                        <td>57</td>
                                        <td><span class="text-semibold">$3,990</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="no-margin">Support tickets list doesn't support commas</h6>
                                            <span class="text-muted">I'd have gone up to the boss and told him just what i think.</span>
                                        </td>
                                        <td>$70</td>
                                        <td>12</td>
                                        <td><span class="text-semibold">$840</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="no-margin">Fix website issues on mobile</h6>
                                            <span class="text-muted">I am so happy, my dear friend, so absorbed in the exquisite.</span>
                                        </td>
                                        <td>$70</td>
                                        <td>31</td>
                                        <td><span class="text-semibold">$2,170</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="panel-body">
                            <div class="row receipt-payment">
                                <div class="col-sm-7">
                                    <div class="content-group">
                                    <h6>Authorized person</h6>
                                        <ul class="list-condensed list-unstyled text-muted">
                                            <li>Eugene Kopyov</li>
                                            <li>2269 Elba Lane</li>
                                            <li>Paris, France</li>
                                            <li>888-555-2311</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="content-group">
                                        <h6>Total due</h6>
                                        <div class="table-responsive no-border">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Subtotal:</th>
                                                        <td class="text-right">$7,000</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tax: <span class="text-regular">(25%)</span></th>
                                                        <td class="text-right">$1,750</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td class="text-right text-primary"><h5 class="text-semibold">$8,750</h5></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="text-right">
                                            <button type="button" class="btn btn-primary btn-labeled"><b><i class="icon-printer"></i></b> Print receipt</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h6>Other information</h6>
                            <p class="text-muted">Thank you for using Limitless. This receipt can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</p>
                        </div>

                        <div class="panel-footer">
                            <div class="heading-elements">
                                <a href="{{ route('payments.endpoint') }}" class="heading-text text-default pull-right" data-method="POST">{{ trans('actions.pay') }} <i class="icon-arrow-right14 position-right"></i></a> 
                            </div>
                            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop