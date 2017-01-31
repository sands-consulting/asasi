@extends('layouts.portal')

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
                        <div class="panel-body">
                            <div class="row invoice-payment">
                                <div class="col-sm-12">
                                    <div class="content-group">
                                    <h6>Receiver Detail</h6>
                                        <ul class="list-condensed list-unstyled">
                                            <li><span class="text-semibold">Normand axis LTD</span></li>
                                            <li>Bank: CIMB Islamic Bank Berhad</li>
                                            <li>Branch: UPM Serdang</li>
                                            <li>A/C Number: 66234342</li>
                                            <li>IBAN: KFH37784028476740</li>
                                            <li>SWIFT Code: BPT4E</li>
                                            <li>GST Number: 00514513212</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-lg">
                                        <tbody>
                                            <tr class="no-all-border">
                                                <td class="col-sm-3"><span class="text-semibold"><h6>Received From</h6></span></td>
                                                <td class="col-sm-9">: Rebecca Manes, Normand axis LTD</td>
                                            </tr>
                                            <tr class="no-all-border">
                                                <td class="col-sm-3"><span class="text-semibold"><h6>Ringgit Malaysia</h6></span></td>
                                                <td class="col-sm-9">: Thirty Only</td>
                                            </tr>
                                            <tr class="no-all-border">
                                                <td class="col-sm-3"><span class="text-semibold"><h6>Being</h6></span></td>
                                                <td class="col-sm-9">: Charge for ...... invoice number: 49029</td>
                                            </tr>
                                            <tr class="no-all-border">
                                                <td class="col-sm-3"><span class="text-semibold"><h6>Ringgit Malaysia (RM)</h6></span></td>
                                                <td class="col-sm-9">: 30.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="/payments/receipt/print" target="_blank" class="btn btn-primary btn-labeled"><b><i class="icon-printer"></i></b> Print invoice</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop