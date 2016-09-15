@extends('admin.layouts.adminlte')

@section('title', 'Permissions')

    @section('content')
        <a href="{{ route('admin.permission.create') }}" class="btn btn-success">Create New Permission</a>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Responsive Hover Table</h3>

                                    <div class="box-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                            <th>Label</th>
                            <th>Edit</th>
                            <th>Delete</th>
                                        </tr>
                                        <tr>
                                            @foreach($permissions as $permission)
                                    <tr>
                                                        <td>
                                                                {{ $permission->id }}
                                                        </td>
                                                          <td>{{ $permission->name }}</td>
                                                            <td>{{ $permission->label }}</td>
                                        <td>
                                            <a href="{{ route('admin.permission.edit', $permission->id) }}">
                                                                        <i class="fa fa-pencil"></i>

                                            </a>
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('admin.role.confirm', $permission->id) }}">
                                                        <i class="fa fa-trash"></i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                        </tr>

                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                </section>
                <!-- /.content -->
    {{-- {!! $permissions->render() !!} --}}

    @endsection
