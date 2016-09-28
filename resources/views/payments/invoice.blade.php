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
                                    <h5 class="panel-title">{{ trans('payments.invoice') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body no-padding-bottom">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-bg">
                                        <tr>
                                            <td class="col-3">
                                                <span class="text-muted">Invoice Id</span><br>
                                                49029
                                            </td>
                                            <td  class="col-5" rowspan="3">
                                                <span class="text-muted">Billed To</span>
                                                <ul class="list-condensed list-unstyled">
                                                  <li><h5>Rebecca Manes</h5></li>
                                                  <li><span class="text-semibold">Normand axis LTD</span></li>
                                                  <li>3 Goodman Street</li>
                                                  <li>London E1 8BF</li>
                                                  <li>United Kingdom</li>
                                                  <li>888-555-2311</li>
                                                  <li><a href="#">rebecca@normandaxis.ltd</a></li>
                                                </ul>
                                            </td>
                                            <td  class="col-3 text-right" rowspan="3">
                                                <span class="text-muted">Total Due</span><br>
                                                <h5>RM 30.00</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="text-muted">Invoice Date</span><br>
                                                January 12, 2015
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="text-muted">Due Date</span><br>
                                                May 12, 2015
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th class="col-sm-2 text-right">GST Amount</th>
                                        <th class="col-sm-2 text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="no-margin">PPG. SEL. 10/2016 (N)</h6>
                                            <span class="text-muted">Kerja-Kerja Menaiktaraf Bengkel IAT Syarikat Ain Food Products, Pejabat Pertanian Daerah Gombak/Petaling Selangor Darul Ehsan.</span>
                                        </td>
                                        <td class="text-right">RM 0.00<br>N-T</td>
                                        <td class="text-right">RM 10.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="no-margin">PDP/PLB/55/2016</h6>
                                            <span class="text-muted">KERJA-KERJA MEMBAIKPULIH KEROSAKAN BANGUNAN DAN LAIN-LAIN KERJA BERKAITAN DI BALAI JKKK KAMPUNG BUKIT CHERAKAH DI DALAM DAERAH PETALING</span>
                                        </td>
                                        <td class="text-right">RM 0.00<br>N-T</td>
                                        <td class="text-right">RM 10.00</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="no-margin">PDKS/KP 200-2/1/5-1(S)</h6>
                                            <span class="text-muted">MEMBAIK PULIH DAN PEMBAIKAN TANDAS-TANDAS DISELURUH PEJABAT DAERAH/TANAH KUALA SELANGOR</span>
                                        </td>
                                        <td class="text-right">RM 0.00<br>N-T</td>
                                        <td class="text-right">RM 10.00</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Subtotal</td>
                                        <td class="text-right"><span class="text-semibold">RM 30.00</span></td>
                                    </tr>
                                    <tr class="no-border">
                                        <td></td>
                                        <td>GST (6%)</td>
                                        <td class="text-right"><span class="text-semibold">RM 0.00</span></td>
                                    </tr>
                                    <tr class="no-border">
                                        <td></td>
                                        <td>Total (incld. GST)</td>
                                        <td class="text-right"><span class="text-semibold">RM 30.00</span></td>
                                    </tr>
                                    <tr class="no-border">
                                        <td></td>
                                        <td>Balance Due</td>
                                        <td class="text-right"><span class="text-semibold">RM 30.00</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-body">
                            <div class="row invoice-payment">
                                <div class="col-sm-6">
                                    <div class="content-group">
                                        <div class="table-responsive no-border">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Code</th>
                                                        <th width="80px">Rate</th>
                                                        <th class="text-right" width="80px">Tax</th>
                                                        <th class="text-right" width="80px">Sale Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>N-T</td>
                                                        <td>0%</td>
                                                        <td class="text-right">RM 0.00</td>
                                                        <td class="text-right"><span class="text-semibold">RM 0.00</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>SR</td>
                                                        <td>6%</td>
                                                        <td class="text-right">RM 0.00</td>
                                                        <td class="text-right"><span class="text-semibold">RM 0.00</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel-body">
                            <div class="row invoice-payment">
                                <div class="col-sm-12">
                                    <div class="content-group">
                                    <h6>Account Details</h6>
                                        <ul class="list-condensed list-unstyled text-muted">
                                            <li>Eugene Kopyov</li>
                                            <li>2269 Elba Lane</li>
                                            <li>Paris, France</li>
                                            <li>888-555-2311</li>
                                            <li>IBAN: KFH37784028476740</li>
                                            <li>SWIFT code: BPT4E</li>
                                        </ul>
                                    </div>
                                    <a href="/payments/invoice/print" target="_blank" class="btn btn-primary btn-labeled"><b><i class="icon-printer"></i></b> Print invoice</a>
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