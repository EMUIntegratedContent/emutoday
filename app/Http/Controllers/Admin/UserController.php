<?php
namespace Emutoday\Http\Controllers\Admin;
use Emutoday\User;
use Emutoday\Role;
use Emutoday\Permission;
use Emutoday\Mediafile;

use Illuminate\Http\Request;
use Emutoday\Http\Requests;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user, Role $role, Permission $permission)
    {
        $this->user = $user;
        $this->permission = $permission;
        $this->role = $role;
        parent::__construct();
    }

    public function index()
    {
        $users = $this->user->paginate(10);
        $permissions = $this->permission->get();
        $roles = $this->role->get();


        return view('admin.user.index', compact('users','permissions','roles'));
    }

    public function form(User $user, Mediafile $mediafile)
    {
            $mediafiles = null;
            $userRoles = \Emutoday\Role::lists('name', 'id');
        return view('admin.user.form', compact('user','userRoles','mediafiles' ));
    }

    public function store(Requests\User_StoreRequest $request)
    {
        $this->user->create($request->only('last_name', 'first_name', 'phone', 'email', 'password'));
        flash()->success('User has been created.');
        return redirect(route('admin_user_index'));//->with('status', 'User has been created.');
    }


    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
                $userRoles = \Emutoday\Role::lists('name', 'id');
                $avatar = $user->mediaFiles->where('type', 'avatar')->first();

                $mediafiles = $user->mediaFiles;
        return view('admin.users.form', compact('user', 'userRoles','mediafiles', 'avatar'));
    }

    public function update(Requests\User_UpdateRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);
        $user->fill($request->only('last_name', 'first_name', 'phone', 'email', 'password'))->save();
        $rolesList = $request->input('role_list') == null ? [] : $request->input('role_list');
        $user->roles()->sync($rolesList);
        flash()->success('User has been updated.');
        return redirect(route('admin_user_edit', $user->id));//->with('status', 'User has been updated.');
    }
    public function confirm(Requests\User_DeleteRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);
        return view('admin.user.confirm', compact('user'));
    }

    public function destroy(Requests\User_DeleteRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();
        flash()->warning('User has been deleted.');
        return redirect(route('admin_user_index'));//->with('status', 'User has been deleted.');
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->findOrFail($id);
        $userRoles = $user->roles;
        // $userAvatars = $user->mediaFiles;
        //
        // dd($userAvatars->first());
        return view('admin.user.show', compact('user', 'userRoles'));
    }
}
