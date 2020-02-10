@section('page-title')
  Users | Admin Dashboard
@stop

@extends('monkcommerce::monkcommerce-dashboard.layouts.dashboard-index')

@section('header')
<h1>Users</h1>
@stop

@section('card-btn')
<a href="#" class="btn btn-sm btn-success">Add New User</a>
@stop

@section('card-content')
<table class="card-table table table-hover table-responsive-lg">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Role</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->role->role }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="card-footer d-flex justify-content-center">
  {{ $users->links() }}
</div>
@stop
