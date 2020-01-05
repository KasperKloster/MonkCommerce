@component('mail::message')
# We have recived your order
Dear {{ ucwords($customer['first_name'] . ' ' . $customer['last_name']) }},
Thank you for you order.

<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody>
    <tr>
      <td valign="top" width="50%">
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

      <td valign="top" width="50%">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
          <tbody>
            <tr>
              <td>

                <b>Delivery Address</b>
                <table>
                  <tbody align="left">
                    <tr>
                      <th>Name</th>
                      <td>X</td>
                    </tr>
                    <tr>
                      <th>Street Name</th>
                      <td>X</td>
                    </tr>
                    <tr>
                      <th>Postalcode & City</th>
                      <td>X</td>
                    </tr>
                    <tr>
                      <th>Country</th>
                      <td>X</td>
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

#### Payment Method


#### Delivery Method


#### Order ID: {{ $order->id }}
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




{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
