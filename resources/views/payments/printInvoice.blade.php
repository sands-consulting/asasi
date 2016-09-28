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
                <li><span class="text-semibold">Eugene Kopyov</span></li>
                <li>2269 Elba Lane</li>
                <li>Paris, France</li>
                <li>888-555-2311</li>
                <li>IBAN: KFH37784028476740</li>
                <li>SWIFT code: BPT4E</li>
            </ul>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
  @stop