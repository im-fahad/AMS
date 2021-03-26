<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DesignationRequest;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function getAll()
    {
        $designations = Designation::all();

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $designations
        ]);
    }

    public function store(DesignationRequest $request)
    {
        $request = $request->all();
        Designation::create($request);

        return success_res('Designation Created Successfully!');
    }

    public function update(DesignationRequest $request, Designation $designation)
    {
        $request = $request->all();

        $designation->update($request);

        return success_res('Designation Update Successfully!');
    }

    public function delete(Designation $designation)
    {
        $designation->delete();

        return success_res('Designation Deleted Successfully!');
    }
}
