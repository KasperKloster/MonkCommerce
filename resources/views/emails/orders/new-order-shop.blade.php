@component('mail::message')
# New Order
<table border="1" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td valign="top" width="50%" style="padding : 20px;">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tbody>
            <tr>
              <td>
                <b>Billing Address</b>
                  <table>
                    <tbody align="left">
                      <tr>
                        <th>Name</th>
                        <td>{{ ucwords($customer['first_name'] . ' ' . $customer['last_name']) }}</td>
                      </tr>
                      <tr>
                        <th>Street Name</th>
                        <td>{{ ucwords($customer['street_address']) }}</td>
                      </tr>
                      <tr>
                        <th>Postalcode & City</th>
                        <td>{{ ucwords($customer['postal_code'] . ' ' . $customer['city']) }}</td>
                      </tr>
                      <tr>
                        <th>Country</th>
                        <td>{{ ucwords($customer['country']) }}</td>
                      </tr>
                      <tr>
                        <th>Phone</th>
                        <td>{{ $customer['phone'] }}</td>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <td>{{ $customer['email'] }}</td>
                      </tr>
                    </tbody>
                  </table>
              </td>
            </tr>
          </tbody>
        </table>
      </td>

      <td valign="top" width="50%" style="padding : 20px;">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tbody>
            <tr>
              <td>

                <b>Delivery Address</b>
                <table>
                  <tbody align="left">
                    <tr>
                      <th>Name</th>
                      <td>{{ ucwords($customerDel['first_name'] . ' ' . $customerDel['last_name']) }}</td>
                    </tr>
                    <tr>
                      <th>Street Name</th>
                      <td>{{ ucwords($customerDel['street_address']) }}</td>
                    </tr>
                    <tr>
                      <th>Postalcode & City</th>
                      <td>{{ ucwords($customerDel['postal_code'] . ' ' . $customerDel['city']) }}</td>
                    </tr>
                    <tr>
                      <th>Country</th>
                      <td>{{ ucwords($customerDel['country']) }}</td>
                    </tr>
                  </tbody>
                </table>

              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>


<table border="1" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td valign="top" width="50%" style="padding : 20px;">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tbody>
            <tr>
              <td>
                <b>Payment Method</b>

              </td>
            </tr>
          </tbody>
        </table>
      </td>

      <td valign="top" width="50%" style="padding : 20px;">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tbody>
            <tr>
              <td>

                <b>Delivery Method</b>

              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>

<br/><br/>
<hr/>
## Order Summary (Order ID: {{ $order->id }})
@component('mail::table')
  | Product  | SKU   | Quantity | Price |
  | -------- |:-----:| --------:|------:|
  @foreach($cart->items as $product)
  | {{ $product['item']['name'] }} | {{ $product['item']['sku'] }} | {{ $product['qty'] }} | @if(!empty($product['item']['special_price'])) {{$product['item']['special_price']}} @else {{ $product['item']['price'] }} @endif |
  @endforeach

@endcomponent


<table valign="right">
  <tbody>
  Subtotal: {{ $cart->totalPrice }}<br/>
  Delivery: {{ $order->shipping }}<br/>
  <b>Total: <u>{{ $cart->totalPrice + $order->shipping}}</u></b>
  </tbody>
</table>




@component('mail::button', ['url' => 'http://127.0.0.1:8000' . '/admin/orders/order/' . $order->id])
See Order in Dashboard
@endcomponent
<br/><br/>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
