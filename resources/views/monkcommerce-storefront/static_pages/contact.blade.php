@extends('monkcommerce::monkcommerce-storefront.layouts.storefront-main')
@section('page-title')
  {{ $page->name }}
@stop
@section('meta-desc'){{ Str::limit($page->description, $limit = 180, $end = '...') }}@stop

@section('schema')
  <script type="application/ld+json">
  {
      "@context": "http://schema.org",
      "@type": "WebPage",
      "name": "{{$page->name}}",
      "description": "{{ Str::limit($page->description, $limit = 180, $end = '...') }}"
  }
  </script>
@stop

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>{{ $page->name }}</h1>
      <p class="lead">{{ $page->description }}</p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <form method="post" action="{{ route('monk-shop-contact-post') }}">
        @csrf
        <div class="card">
          <div class="card-header">
            Contact Us
          </div>
          <div class="card-body">
            <div class="form-group row">
              <div class="col-md-6">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" value="{{ old('firstName')}}" required>
                @error('firstName')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" value="{{ old('lastName')}}" required>
                @error('lastName')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email')}}" required>
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="Phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone')}}" required>
                @error('phone')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject')}}" required>
              @error('subject')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="form-group">
              <label for="message">Message</label>
              <textarea class="form-control" id="message" name="message" rows="3">{{ old('message') }}</textarea>
              @error('message')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary mb-2">Send Message</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@stop
