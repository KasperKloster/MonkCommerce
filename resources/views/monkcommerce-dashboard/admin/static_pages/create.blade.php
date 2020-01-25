@section('page-title')
  {{ ucwords(__('monkcommerce-dashboard.pages.create_new_page')) }} | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-form')

@section('page-content')
<form action="{{ route('static-page.store') }}" method="post">
@csrf
  <div class="card">
    <div class="card-header">
      {{ ucwords(__('monkcommerce-dashboard.pages.create_new_page')) }}
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="name">{{ ucwords(__('monkcommerce-dashboard.pages.page_name')) }}</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelpBlock" value="{{ old('name') }}" placeholder="{{ ucwords(__('monkcommerce-dashboard.pages.page_name')) }}" required>
        <small id="pageNameHelpBlock" class="form-text text-muted">
          {{ ucfirst(__('monkcommerce-dashboard.pages.pageNameHelp')) }}
        </small>
      </div>

      <div class="form-group">
        <label for="description">{{ ucwords(__('monkcommerce-dashboard.general-words.description')) }}</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{old('description')}}</textarea>
      </div>

      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="show_in_menu" id="show_in_menu" value="1">
        <label class="form-check-label" for="show_in_menu">{{ ucwords(__('monkcommerce-dashboard.general-words.show_in_menu')) }}</label>
      </div>
    </div>

    <div class="card-footer">
      <div class="form-group row pt-3">
        <div class="col">
          <button class="btn btn-success" type="submit">{{ ucwords(__('monkcommerce-dashboard.pages.create_page')) }}</button>
          <button class="btn btn-outline-secondary" type="reset">{{ ucwords(__('monkcommerce-dashboard.general-words.reset')) }}</button>
        </div>
      </div>
    </div>

  </div>
</form>
@stop
