<?php

namespace Emutoday\Http\Controllers\Admin;


use Emutoday\Role;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Emutoday\Http\Requests;


class RoleController extends Controller
{

    public function __construct(Role $role)
    {
            $this->role = $role;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->get();

        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {

        $rolePermissions = \Emutoday\Permission::lists('name', 'id');
        return view('admin.role.form', compact('role','rolePermissions' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
             'name' => 'required|alpha_dash|unique:roles,name',
             'label' => 'required|max:400'
     ]);
        $role = new Role();
        $role->name = $request->name;
        $role->label = $request->label;
        $role->save();
        // $id = $role->id;
        flash()->success('Role has been created.');
        return redirect(route('admin.role.edit', ['id' =>  $role->id ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->role->findOrFail($id);
        $rolePermissions = \Emutoday\Permission::lists('name', 'id');

        return view('admin.role.form', compact('role', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
             'name' => 'required|alpha_dash|unique:roles,name,'.$id,
             'label' => 'required|max:400'
     ]);
        $role = $this->role->findOrFail($id);
        $role->fill($request->only('name', 'label'))->save();
        $permissionList = $request->input('permission_list') == null ? [] : $request->input('permission_list');
        $role->permissions()->sync($permissionList);
        flash()->success('Role has been updated.');
        return redirect(route('admin.role.edit', $role->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->role->findOrFail($id);
        $role->delete();
        flash()->warning('Role has been deleted.');
        return redirect(route('admin.role.index'));
    }
}
