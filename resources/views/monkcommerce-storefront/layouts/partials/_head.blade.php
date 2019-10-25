<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('page-title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @yield('schema')

    <script type="application/ld+json">
      {
      "@context": "http://schema.org",
      "@type": "LocalBusiness",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "{{ $storefrontShop->city }}",
        "addressCountry": "{{ $storefrontShop->country }}",
        "streetAddress": "{{ $storefrontShop->street_adress }}",
        "postalCode": "{{ $storefrontShop->postal_code }}",
        "telephone": "{{ $storefrontShop->phone }}"
      },
      "name": "{{ $storefrontShop->shop_name }}",
      "email": "{{ $storefrontShop->email }}",
      "url": "{{ $storefrontShop->url }}"
      }
    </script>

  </head>
  <body>
