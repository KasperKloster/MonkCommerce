@section('page-title')
{{ ucwords(__('monkcommerce-dashboard.attr.all_products_attr')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-index')

@section('header')
<h1>{{ ucwords(__('monkcommerce-dashboard.attr.all_products_attr')) }}</h1>
@stop

@section('card-btn')
<a href="{{ route('monk-admin-products-attr-create') }}" class="btn btn-sm btn-success">{{ ucwords(__('monkcommerce-dashboard.attr.create_new_attr')) }}</a>
@stop

@section('card-content')

  <h2>Attributes</h2>
<ul>
  @foreach($attrs as $attr)
     <li>{{$attr->name }}</li>
       <ul>
       @foreach($attr->attributeValues as $attrValue)
         <li>{{$attrValue->value}}</li>
       @endforeach
       </ul>
  @endforeach
</ul>

<!-- Table List -->
<table class="card-table table table-hover table-responsive-lg">
  <tbody>
    @foreach($attrs as $attr)
      <tr>
        <td>{{ $attr->name }}</td>
        <td>
          <!-- value -->
          <a href="{{-- route('monk-admin-edit-product', $product->id) --}}" class="btn btn-sm btn-info mat-inline-center">
            <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
          </a>
          <!-- show in shop -->
          <a href="{{-- route('monk-shop-single-product', $product->slug) --}}" class="btn btn-sm btn-outline-secondary mat-inline-center ml-3 mr-3" target="_blank">
            {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
          </a>
          <!-- Delete Category -->
          <a href="{{-- route('monk-admin-destroy-product', $product->id) --}}" class="btn btn-sm btn-danger mat-inline-center">
            <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
          </a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<!-- Pagination -->
<div class="row pt-3">
  <div class="col-md-12">
    <div class="d-flex justify-content-center">
      {{ $attrs->links() }}
    </div>
  </div>
</div>

@stop
