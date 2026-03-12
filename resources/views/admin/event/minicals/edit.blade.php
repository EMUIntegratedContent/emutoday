@extends('admin.layouts.adminlte')

@section('content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Edit Mini Calendar</h3>
  </div>
  <div class="box-body">
    <form method="POST" action="/admin/event/minicals/{{ $minical->id }}">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="calendar">Name</label>
        <input type="text" name="calendar" class="form-control" value="{{ old('calendar', $minical->calendar) }}" required />
      </div>
      <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
        <label for="slug">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $minical->slug) }}" pattern="[a-z0-9-]+" title="Only lowercase letters, numbers, and hyphens are allowed." />
        @if($errors->has('slug'))
          <span class="help-block">{{ $errors->first('slug') }}</span>
        @endif
      </div>
      <div class="form-group">
        <label for="parent">Parent</label>
        <select name="parent" class="form-control">
          <option value="">-- No parent --</option>
          @foreach($parents as $p)
            <option value="{{ $p->id }}" {{ old('parent', $minical->parent) == $p->id ? 'selected' : '' }}>{{ $p->calendar }}</option>
          @endforeach
        </select>
      </div>
      <button class="btn btn-primary" type="submit">Save</button>
      <a href="/admin/event/minicals" class="btn btn-default">Cancel</a>
    </form>
  </div>
</div>
@endsection
