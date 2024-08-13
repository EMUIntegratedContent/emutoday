<?php
namespace Emutoday\Http\Controllers\Admin;
use Emutoday\User;
use Emutoday\Role;
use Emutoday\Permission;
use Emutoday\Mediafile;

use Illuminate\Http\Request;
use Emutoday\Http\Requests;

use Emutoday\Announcement;

use Emutoday\Helpers\Interfaces\IBug;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    protected $user;
    protected $bugService;

    public function __construct(User $user, Role $role, Permission $permission, IBug $bugService)
    {
        $this->bugService = $bugService;
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
				View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());

        $this->user = $user;
        $this->permission = $permission;
        $this->role = $role;
        parent::__construct();
    }

    public function index(Request $request)
    {
				$showarchived = $request->input('showarchived'); // Should archived users be shown?
				if($showarchived) {
					$users = $this->user->paginate(10);
				} else {
					$users = $this->user->where('hidden', '0')->paginate(10);
				}
        $permissions = $this->permission->get();
        $roles = $this->role->get();

        return view('admin.user.index', compact('users','permissions','roles'));
    }

    public function form(User $user, Mediafile $mediafile)
    {
        $mediafiles = null;
        $userRoles = \Emutoday\Role::pluck('name', 'id');
        return view('admin.user.form', compact('user','userRoles','mediafiles' ));
    }

    public function store(Requests\User_StoreRequest $request)
    {
        // Create user.
        $this->user->create($request->only('last_name', 'first_name', 'phone', 'email'));

        // Save user roles.
        $newUser = User::orderBy('created_at', 'desc')->first();

        $newUser->roles()->sync($request->input('role_list'));
        flash()->success('User has been created.');
        return redirect()->action('Admin\UserController@index')->with('status', 'User has been updated.');
    }


    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
                $userRoles = \Emutoday\Role::pluck('name', 'id');
                $avatar = $user->mediaFiles->where('type', 'avatar')->first();

                $mediafiles = $user->mediaFiles;
        return view('admin.user.form', compact('user', 'userRoles','mediafiles', 'avatar'));
    }

    public function update(Requests\User_UpdateRequest $request, $id)
    {
			$archive_user = $request->input('archive_user');
			$unarchive_user = $request->input('unarchive_user');

			$user = $this->user->findOrFail($id);
			// If archive_user is selected, set the hidden field to 1 and remove all the user's roles
			if($archive_user == '1') {
				$user->roles()->sync([]); // Remove user roles
				$user->hidden = 1;
				$user->is_idea_assignee = 0; // remove from story idea assignment list
				$user->save();
			}
			// If unarchive_user is selected, set the hidden field to 0
			else if ($unarchive_user == '1') {
				$user->hidden = 0;
				$user->save();
			}
			// Normal update without archiving.
			else {
				$user->fill($request->only('last_name', 'first_name', 'phone', 'email'))->save();
				$rolesList = $request->input('role_list') == null ? [] : $request->input('role_list');
				$user->roles()->sync($rolesList);
			}

			flash()->success('User has been updated.');
			return redirect()->action('Admin\UserController@edit', $user->id);//->with('status', 'User has been updated.');
    }
    public function confirm(Requests\User_DeleteRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);
        return view('admin.user.confirm', compact('user'));
    }

    public function destroy(Requests\User_DeleteRequest $request, $id)
    { // YOU CAN'T DELETE A USER! Because the users INFORMATION is referenced from the CONTENT they have created!
        $user = $this->user->findOrFail($id);
        return $user;
        // $user->delete();
        // flash()->warning('User has been deleted.');
        // return redirect(route('admin_user_index'));//->with('status', 'User has been deleted.');
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
