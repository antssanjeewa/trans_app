<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    private $title = "roles";
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $roles = JsonResource::collection(Role::paginate());

        return inertia('Common/index',[
            'title' => $this->title,
            "items" => $roles,
            'filters' => request()->all('search', 'count'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return inertia('Common/form',[
            'title' => $this->title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        Role::create($request->validated());
        return to_route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return inertia('Common/form',[
            'title' => $this->title,
            'item' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        return to_route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
