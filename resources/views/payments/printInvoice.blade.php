@extends('layouts.printing')

@section('content')
<table class="container">
  <tr>
    <td>
      <table>
        <tr>
          <td class="col-6">
            <ul class="list-condensed list-unstyled">
              <li>2269 Elba Lane</li>
              <li>Paris, France</li>
              <li>888-555-2311</li>
            </ul>
          </td>
          <td class="col-6 right invoice-details">
            <h5 class="text-uppercase text-semibold">Invoice #49029</h5>
            <ul class="list-condensed list-unstyled">
                <li>Date: <span class="text-semibold">January 12, 2015</span></li>
                <li>Due date: <span class="text-semibold">May 12, 2015</span></li>
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
      <table>
        <tr>
          <td class="col-8">
            <span class="text-muted">Invoice To:</span>
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
          <td class="col-4">
            <span class="text-muted">Payment Details:</span>
            <ul class="list-condensed list-unstyled invoice-payment-details">
              <li><h5>Total Due: <span class="text-right text-semibold">$8,750</span></h5></li>
              <li>Bank name: Profit Bank Europe</li>
              <li>Country: United Kingdom</li>
              <li>City: London E1 8BF</li>
              <li>Address: 3 Goodman Street</li>
              <li>IBAN: KFH37784028476740</li>
              <li>SWIFT code: BPT4E</li>
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
          <thead>
              <tr>
                  <th class="col-9">Description</th>
                  <th class="col-1">Rate</th>
                  <th class="col-1">Hours</th>
                  <th class="col-1">Total</th>
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
    </td>
  </tr>
</table>
<table class="container">
  <tr>
    <td>
      <table>
        <tr>
          <td class="col-8">
            <h6>Authorized person</h6>
            <ul class="list-condensed list-unstyled text-muted">
                <li>Eugene Kopyov</li>
                <li>2269 Elba Lane</li>
                <li>Paris, France</li>
                <li>888-555-2311</li>
            </ul>
          </td>
          <td class="col-4">
            <h6>Total due</h6>
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
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
  @stop