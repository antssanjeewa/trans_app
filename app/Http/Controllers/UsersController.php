<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\UserResouce;
use Illuminate\Support\Facades\Request as FRequest;

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
        $roles = Role::select(['id','name'])->get();
        $departments = Department::select(['id','name'])->get();

        return inertia('Users/form', [
            "roles" => $roles,
            "departments" => $departments,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required | string | max:100',
            'email'             => 'required | email | unique:users',
            'password'          => 'required',
            'password_confirm'  => 'required|same:password',
        ]);

        $user = User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User Created Successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::select(['id','name'])->get();
        $departments = Department::select(['id','name'])->get();

        return inertia('Users/form', [
            'user' => $user,
             "roles" => $roles,
            "departments" => $departments,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required | string | max:100',
            'email' => 'required | email | max:50',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User Updated Successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User Deleted Successfully');
    }

    public function restore(User $user)
    {
        $user->restore();

        return redirect()->back()->with('success', 'User Restored.');
    }
}
