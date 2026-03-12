@extends('admin.layouts.adminlte')

@section('breadcrumb', 'Create Mini Calendar')

@section('content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Create Mini Calendar</h3>
  </div>
  <div class="box-body">
    <form method="POST" action="/admin/event/minicals">
      @csrf
      <div class="form-group">
        <label for="calendar">Name</label>
        <input type="text" name="calendar" class="form-control" value="{{ old('calendar') }}" required />
      </div>
      <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
        <label for="slug">Slug (optional)</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" pattern="[a-z0-9-]+" title="Only lowercase letters, numbers, and hyphens are allowed." />
        @if($errors->has('slug'))
          <span class="help-block">{{ $errors->first('slug') }}</span>
        @endif
        <p class="help-block">If left blank a kebab-case slug will be generated from the name.</p>
      </div>
      <div class="form-group">
        <label for="parent">Parent</label>
        <select name="parent" class="form-control">
          <option value="">-- No parent --</option>
          @foreach($parents as $p)
            <option value="{{ $p->id }}" {{ old('parent') == $p->id ? 'selected' : '' }}>{{ $p->calendar }}</option>
          @endforeach
        </select>
      </div>
      <button class="btn btn-primary" type="submit">Save</button>
      <a href="/admin/event/minicals" class="btn btn-default">Cancel</a>
    </form>
  </div>
</div>
@endsection
