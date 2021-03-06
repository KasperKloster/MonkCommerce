<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page-title') {{ $storefrontShop->prefix }}</title>
    <meta name="description" content="@yield('meta-desc')">
    @yield('seo-robots')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('monkcommerce/css/storefront/basis/basis-style.min.css') }}">
    @yield('stylesheet')

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
      "name": "{{ $storefrontShop->name }}",
      "email": "{{ $storefrontShop->email }}",
      "url": "{{ $storefrontShop->url }}"
    }
    </script>

    <script type="application/ld+json">
    {
    "@context": "https://schema.org",
    "@type": "WebSite",
    "url": "{{ $storefrontShop->url }}",
      "potentialAction": {
      "@type": "SearchAction",
      "target": "{{ $storefrontShop->url }}/search?q={search_term_string}",
      "query-input": "required name=search_term_string"
      }
    }
    </script>

  </head>
  <body>
