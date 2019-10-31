@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.left-panel.pages')) }}
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-index')

@section('header')
  {{ ucwords(__('monkcommerce-dashboard.left-panel.pages')) }}
@stop

@section('card-btn')
  <a href="{{ route('monk-admin-create-page') }}" class="btn btn-sm btn-success">{{ ucwords(__('monkcommerce-dashboard.pages.create_new_page')) }}</a>
@stop

@section('card-content')
<!-- Table List -->
<table class="card-table table table-hover table-responsive-lg">
  <tbody>
    @foreach($pages as $page)
      <tr>
        <td>{{ $page->name }}</td>
        <td>
          <!-- edit -->
          <a href="{{ route('monk-admin-edit-page', $page->id) }}" class="btn btn-sm btn-info mat-inline-center">
            <i class="material-icons">edit</i>{{ ucwords(__('monkcommerce-dashboard.general-words.edit')) }}
          </a>
          <!-- show in shop -->
          <a href="#" class="btn btn-sm btn-outline-secondary mat-inline-center ml-3 mr-3" target="_blank">
            {{ ucwords(__('monkcommerce-dashboard.general-words.show_in_shop')) }}<i class="material-icons">open_in_new</i>
          </a>
          <!-- Delete Category -->
          <a href="{{ route('monk-admin-destroy-page', $page->id) }}" class="btn btn-sm btn-danger mat-inline-center">
            <i class="material-icons">delete_forever</i> {{ ucwords(__('monkcommerce-dashboard.general-words.delete')) }}
          </a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@stop

<div class="row pt-3">
  <div class="col-md-12">
    <div class="d-flex justify-content-center">
    {{ $pages->links() }}
    </div>
  </div>
</div>
