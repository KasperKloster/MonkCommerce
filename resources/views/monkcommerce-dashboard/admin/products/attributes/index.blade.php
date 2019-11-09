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
<!-- Table List -->
<table class="card-table table table-hover table-responsive-lg">
  <tbody>
    @foreach($attrs as $attr)
      <tr>
        <td>{{ $attr->name }}</td>
        <td>
          <!-- value -->
          <a href="{{ route('monk-admin-products-attr-edit', $attr->id) }}" class="btn btn-sm btn-info mat-inline-center">
            <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
          </a>
          <!-- Delete Category -->
          <a href="{{ route('monk-admin-products-attr-destroy', $attr->id) }}" class="btn btn-sm btn-danger mat-inline-center">
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
