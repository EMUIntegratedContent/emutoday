<?php

namespace Emutoday\Http\Controllers\Admin;

use Emutoday\Permission;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Emutoday\Http\Requests;


class PermissionController extends Controller
{
    public function __construct(Permission $permission)
    {
            $this->permission = $permission;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permission->get();

        return view('admin.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Permission $permission)
    {
        return view('admin.permission.form', compact('permission' ));
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
             'name' => 'required|alpha_dash|unique:permissions,name',
             'label' => 'required|max:400'
     ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->label = $request->label;
        $permission->save();
        // $id = $permission->id;
        flash()->success('Permission has been created.');
        return redirect(route('admin.permission.edit', ['id' =>  $permission->id ]));
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
        $permission = $this->permission->findOrFail($id);

        return view('admin.permission.form', compact('permission'));
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
             'name' => 'required|alpha_dash|unique:permissions,name,'.$id,
             'label' => 'required|max:400'
     ]);
        $permission = $this->permission->findOrFail($id);
        $permission->fill($request->only('name', 'label'))->save();
        flash()->success('Permission has been updated.');
        return redirect(route('admin.permission.edit', $permission->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->permission->findOrFail($id);
        $permission->delete();
        flash()->warning('Permission has been deleted.');
        return redirect(route('admin.permission.index'));
    }
}
