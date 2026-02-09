@extends('admin.layouts.adminlte')

@section('breadcrumb', 'Mini Calendars')

@section('content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Mini Calendars</h3>
    <div class="box-tools pull-right">
      <a href="/admin/event/minicals/create" class="btn btn-sm btn-success">Create Mini Calendar</a>
    </div>
  </div>
  <div class="box-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Slug</th>
          <th>Parent</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($minicals as $m)
        <tr>
          <td>{{ $m->id }}</td>
          <td>{{ $m->calendar }}</td>
          <td>{{ $m->slug }}</td>
          <td>{{ optional($m->parentCalendar)->calendar }}</td>
          <td><a href="/admin/event/minicals/{{ $m->id }}/edit" class="btn btn-xs btn-primary">Edit</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
