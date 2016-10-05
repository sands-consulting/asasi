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
            <h5 class="invoice-title">OFFICIAL RECEIPT</h5>
          </td>
        </tr>
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
                <tbody>
                    <tr class="no-all-border">
                        <td class="col-3"><span class="text-semibold"><h6>Received From</h6></span></td>
                        <td class="col-9">: Rebecca Manes, Normand axis LTD</td>
                    </tr>
                    <tr class="no-all-border">
                        <td class="col-3"><span class="text-semibold"><h6>Ringgit Malaysia</h6></span></td>
                        <td class="col-9">: Thirty Only</td>
                    </tr>
                    <tr class="no-all-border">
                        <td class="col-3"><span class="text-semibold"><h6>Being</h6></span></td>
                        <td class="col-9">: Charge for ...... invoice number: 49029</td>
                    </tr>
                    <tr class="no-all-border">
                        <td class="col-3"><span class="text-semibold"><h6>Ringgit Malaysia (RM)</h6></span></td>
                        <td class="col-9">: 30.00</td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>
  @stop