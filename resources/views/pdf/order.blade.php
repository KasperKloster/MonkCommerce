<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="noindex">
    <style>
    .text-right {
    text-align: right;
    }

    #wrapper {
      width: 100%;
      overflow: hidden;
      height:40%;
    }
    #logo {
      width: 75%;
      float:left;
    }
    #number {
      overflow: hidden;

    }
    .three-colum {
      width: 30%;

    }

    .float-left {
      float:left;
    }

    </style>

</head>
  <body style="background: #fff;">

    <div id="wrapper">
      <div id="logo">
        <h1>{{ $shop['shop_name'] }}</h1>
      </div>
      <div id="number">
        <h4>Faktura</h4>
        DATO
        NUMBER
      </div>

      <div>
        <div class="three-colum">

          <h4>{{ $shop['shop_name'] }}</h4>
          {{ $shop['street_address'] }}<br>
          {{ $shop['postal_code'] }}, {{ $shop['city'] }}<br>
          Tlf: {{ $shop['phone'] }} <br>
          Email: {{ $shop['email'] }}<br><br>
          CVR: {{ $shop['vat_number'] }}
        </div>
        <div class="three-colum float-left">
          <h4>From:</h4>
          <strong>Company Inc.</strong><br>
          123 Company Ave. <br>
          Toronto, Ontario - L2R 5A4<br>
          P: (416) 123-4567 <br>
          E: copmany@company.com
        </div>
        <div class="three-colum float-left">
          <h4>From:</h4>
          <strong>Company Inc.</strong><br>
          123 Company Ave. <br>
          Toronto, Ontario - L2R 5A4<br>
          P: (416) 123-4567 <br>
          E: copmany@company.com
        </div>
      </div>

    </div>

      <div>
        <table style="width:100%;">
          <thead style="background: #F5F5F5;">
            <tr>
              <th>Varenr</th>
              <th>Antal</th>
              <th>Navn</th>
              <th>Stk. Pris</th>
            </tr>
          </thead>

          <tbody>
            <tr>
            <td>asd</td>
            <td>asd</td>
            <td>asd</td>
            <td>123</td>
            </tr>
            <tr>
            <td>asd</td>
            <td>asd</td>
            <td>asd</td>
            <td>asd</td>
            </tr>
          </tbody>

        </table>
        <hr/>

        <table style="float:right;">
          <tbody>
            <tr>
              <td>I alt: </td>
            </tr>
          </tbody>
        </table>
      </div>

  </body>
</html>
