@extends('layouts.printing')

@section('content')
<table class="container container-header">
    <tr>
        <td>
            <table>
                <tr>
                    <td class="col-9 logo-prompt">
                    </td>
                    <td class="col-3 right">
                        <h5 class="invoice-title">TAX INVOICE</h5>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table class="container">
    <tr>
        <td>
            <table class="table table-bg">
                <tr>
                    <td class="col-3">
                        <span class="text-muted">Invoice Id</span><br>
                        {{ $transaction->id }}
                    </td>
                    <td  class="col-5" rowspan="3">
                        <span class="text-muted">Billed To</span>
                        <ul class="list-condensed list-unstyled">
                            <li><h5>{{ $transaction->vendor->contact_person_designation }} {{ $transaction->vendor->contact_person_name }}</h5></li>
                            <li><span class="text-semibold">{{ $transaction->vendor->name }}</span></li>
                            <li>{{ $transaction->vendor->address_1 }}</li>
                            <li>{{ $transaction->vendor->address_2 }}</li>
                            <li>{{ $transaction->vendor->address_postcode }} {{ $transaction->vendor->city->name }}</li>
                            <li>{{ $transaction->vendor->country->name }}</li>
                            <li>{{ $transaction->vendor->contact_person_telephone }}</li>
                            <li><a href="mailto:{{ $transaction->vendor->contact_person_email }}">{{ $transaction->vendor->contact_person_email }}</a></li>
                        </ul>
                    </td>
                    <td  class="col-3 text-right" rowspan="3">
                        <span class="text-muted">Total Due</span><br>
                        <h4>RM {{ $transaction->total }}</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="text-muted">Invoice Date</span><br>
                        {{ $transaction->created_at->getFromSetting() }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="text-muted">Due Date</span><br>
                        {{ $transaction->created_at->copy()->addDays(14)->getFromSetting() }}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table class="container">
    <tr>
        <td>
            <table class="table table-lg">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th width="100px" class="text-right">GST Amount</th>
                        <th width="100px" class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($transaction->details)
                    @foreach ($transaction->details as $detail)
                    <tr>
                        <td>
                            <h6 class="no-margin">{{ $detail->detailable->number }}</h6>
                            <span class="text-muted">{{ $detail->detailable->name }}</span>
                        </td>
                        <td class="text-right">RM {{ $detail->tax_amount }}<br>{{ $detail->tax_code }}</td>
                        <td class="text-right">RM {{ $detail->unit_price }}</td>
                    </tr>
                    @endforeach
                    @endif

                    <tr>
                        <td></td>
                        <td>Subtotal</td>
                        <td class="text-right"><span class="text-semibold">RM {{ $transaction->sub_total }}</span></td>
                    </tr>
                    <tr class="no-border">
                        <td></td>
                        <td>GST (6%)</td>
                        <td class="text-right"><span class="text-semibold">RM {{ $transaction->tax_total }}</span></td>
                    </tr>
                    <tr class="no-border">
                        <td></td>
                        <td>Total (incld. GST)</td>
                        <td class="text-right"><span class="text-semibold">RM {{ $transaction->total }}</span></td>
                    </tr>
                    <tr class="no-border">
                        <td></td>
                        <td>Balance Due</td>
                        <td class="text-right"><span class="text-semibold">RM {{ $transaction->total }}</span></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>
<table class="container">
    <tr>
        <td>
            <table class="table table-lg">
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
        </td>
    </tr>
</table>
<table class="container">
    <tr>
        <td>
            <table>
                <tr>
                    <td class="col-8">
                        <h6>Account Details</h6>
                        <ul class="list-condensed list-unstyled text-muted">
                            <li><span class="text-semibold">Normand axis LTD</span></li>
                            <li>Bank: CIMB Islamic Bank Berhad</li>
                            <li>Branch: UPM Serdang</li>
                            <li>A/C Number: 66234342</li>
                            <li>IBAN: KFH37784028476740</li>
                            <li>SWIFT Code: BPT4E</li>
                            <li>GST Number: 00514513212</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
@stop