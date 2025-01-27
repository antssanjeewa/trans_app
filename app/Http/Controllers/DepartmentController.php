<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentController extends Controller
{
    private $title = "departments";
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $roles = JsonResource::collection(Department::paginate());

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
    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->validated());
        return to_route('departments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return inertia('Common/form',[
            'title' => $this->title,
            'item' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        return to_route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        //
    }
}
