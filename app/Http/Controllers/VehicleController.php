<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Vehicle;
use App\Models\Expenses;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::with('files')->get();

        return inertia('Vehicles/index', [
            "items" => $vehicles,
            'filters' => request()->all('search', 'count'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Vehicles/form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->validated());

        $file = $request->file('image');
        $path = $file->store('vehicles', 'public');

        // Storage::disk('public')->delete($file->path);
        $vehicle->files()->create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'category' => "image",
            'size' => $file->getSize(),
        ]);

        return to_route('vehicles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load('files');

        $transports = fn() => JsonResource::collection(Transport::paginate(1));

        $expenses = Inertia::lazy(fn() => JsonResource::collection(Expenses::paginate()));

        $users = Inertia::lazy(fn() => User::all()->groupBy(function ($user) {
            return $user->role_id === 1 ? 'drivers' : 'others';
        }));

        return inertia('Vehicles/view', [
            'item' => $vehicle,
            "transports" => $transports,
            "expenses" => $expenses,
            "users" => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
