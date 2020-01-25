@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.left-panel.pages')) }}
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-index')

@section('header')
  {{ ucwords(__('monkcommerce-dashboard.left-panel.pages')) }}
@stop

@section('card-btn')
  <a href="{{ route('static-page.create') }}" class="btn btn-sm btn-success">{{ ucwords(__('monkcommerce-dashboard.pages.create_new_page')) }}</a>
@stop

@section('card-content')
<!-- Table List -->
<table class="card-table table table-hover table-responsive-lg">
  <tbody>
    @foreach($staticPages as $page)
      <tr>
        <td>{{ $page->name }}</td>
        <td>
          <!-- edit -->
          <a href="{{ route('static-page.edit', $page->id) }}" class="btn btn-sm btn-info mat-inline-center">
            <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
          </a>
          <!-- show in shop -->
          <a href="{{ route('monk-shop-single-page', $page->slug) }}" class="btn btn-sm btn-outline-secondary mat-inline-center ml-3 mr-3" target="_blank">
            {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
          </a>
          <!-- Delete Category -->
          <form action="{{ route('static-page.destroy', $page->id) }}" method="post">
            @method('DELETE')
            @csrf
            <button class="btn btn-sm btn-danger mat-inline-center" type="submit"><i class="material-icons">delete_forever</i> Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@stop

<div class="row pt-3">
  <div class="col-md-12">
    <div class="d-flex justify-content-center">
    {{ $staticPages->links() }}
    </div>
  </div>
</div>
