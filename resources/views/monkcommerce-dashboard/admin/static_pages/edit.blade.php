@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.pages.edit_page')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')

@section('page-content')
<div class="card">
  <div class="card-header">
    {{ ucwords(__('monkcommerce-dashboard.pages.edit_page')) }}
  </div>
  <div class="card-body">
    <form action="{{ route('monk-admin-store-page') }}" method="post">
    @csrf
    <div class="form-group">
      <label for="pageName">{{ ucwords(__('monkcommerce-dashboard.pages.page_name')) }}</label>
      <input type="text" class="form-control" id="pageName" name="pageName" aria-describedby="pageNameHelpBlock" value="{{ $page->name }}" required>
      <small id="pageNameHelpBlock" class="form-text text-muted">
        {{ ucfirst(__('monkcommerce-dashboard.pages.pageNameHelp')) }}
      </small>
    </div>

    <div class="form-group">
      <label for="pageDescription">{{ ucwords(__('monkcommerce-dashboard.general-words.description')) }}</label>
      <textarea class="form-control" id="pageDescription" name="pageDescription" rows="3">{{ $page->description }}</textarea>
    </div>

    <div class="form-check">
      <input type="checkbox" class="form-check-input" name="showInMenu" id="showInMenu"
      @if($page->show_in_menu == 1)
        checked
      @endif
      >
      <label class="form-check-label" for="showInMenu">{{ ucwords(__('monkcommerce-dashboard.general-words.show_in_menu')) }}</label>
    </div>

    <div class="form-group row pt-3">
      <div class="col">
        <button class="btn btn-success" type="submit">{{ ucwords(__('monkcommerce-dashboard.pages.save_page')) }}</button>
        <button class="btn btn-outline-secondary" type="reset">{{ ucwords(__('monkcommerce-dashboard.general-words.reset')) }}</button>
      </div>
    </div>

  </form>
  </div>
</div>
@stop
