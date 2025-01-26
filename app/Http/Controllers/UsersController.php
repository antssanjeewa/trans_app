<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResouce;
use Illuminate\Support\Facades\Request as FRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(){
        $users = UserResouce::collection(User::filter(FRequest::all())->paginate());
        $filters = [];

        return inertia('Users/index',[
            "users" => $users,
            'filters' => FRequest::all('search', 'count'),
        ]);
    }

    public function create()
    {
        $roles = Role::get()->pluck('name');
        return inertia('User/UserForm', [
            "roles" => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required | string | max:100',
            'role'              => 'required | string | max:50',
            'email'             => 'required | email | unique:users',
            'password'          => 'required',
            'password_confirm'  => 'required|same:password',
        ]);
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());

        $user->addNewRemark();

        return redirect()->route('users.index')->with('success', 'User Created Successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::get()->pluck('name');
        return inertia('User/UserForm', [
            'member' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ],
            "roles" => $roles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required | string | max:100',
            'email' => 'required | email | max:50',
            'role' => 'required | string | max:50',
            'remark' => 'required | string | min:6'
        ]);

        $old_item = clone $user;

        $user->update($request->all());

        $user->updateRemark($old_item, $request->remark);

        return redirect()->route('users.index')->with('success', 'User Updated Successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        $user->deleteRemark();

        return redirect()->route('users.index')->with('success', 'User Deleted Successfully');
    }

    public function restore(User $user)
    {
        $user->restore();

        return redirect()->back()->with('success', 'User Restored.');
    }
}
