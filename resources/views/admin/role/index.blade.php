@extends('admin.layouts.adminlte')

@section('title', 'Roles')

    @section('content')
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Roles</h3>
                                    @include('admin.components.boxtools', ['rte' => 'role', 'path' => 'admin/role'])

                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover table-bordered">
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                            <th>Label</th>
                            <th>Edit</th>
                            <th>Delete</th>
                                        </tr>
                                        <tr>
                                            @foreach($roles as $role)
                                    <tr>
                                                        <td>
                                                                {{ $role->id }}
                                                        </td>
                                                          <td>{{ $role->name }}</td>
                                                            <td>{{ $role->label }}</td>
                                        <td>
                                            <a href="{{ route('admin.role.edit', $role->id) }}">
                                                                        <i class="fa fa-pencil"></i>

                                            </a>
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('admin.role.confirm', $role->id) }}">
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
    {{-- {!! $roles->render() !!} --}}

    @endsection
