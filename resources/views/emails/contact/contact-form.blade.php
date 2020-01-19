@component('mail::message')
# You have recieved a Message from {{ $store->shop_name }}

{{ $request->message }}

@endcomponent
