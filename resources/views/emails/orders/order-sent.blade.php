@component('mail::message')
# Your Order Has Been Shipped

The body of your message.

@component('mail::table')
  | Product  | SKU   | Quantity | Price |
  | -------- |:-----:| --------:|------:|
  @foreach($products as $product)
  | {{ $product->name }} | {{ $product->sku }} | {{ $product->pivot->qty }} | @if(!empty($product->special_price)) {{$product->special_price}} @else {{ $product->price }} @endif |
  @endforeach

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
