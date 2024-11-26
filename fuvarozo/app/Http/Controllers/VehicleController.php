<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function create(Request $request)
    {
        $fields = $request -> validate([
            'brand' => ['required'],
            'type' => ['required'],
            'license_plate' => ['required'],
            'driver_id' =>['required']
        ]);

        $job = Vehicle::create($fields);
        return redirect('/adminview');
    }

    public function delete(Request $request)
    {
        $vevhicle = Vehicle::findOrFail($request -> id);
        $vevhicle -> delete();

        return redirect('/adminview');
    }
}
