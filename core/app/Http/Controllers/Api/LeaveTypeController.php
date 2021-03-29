<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveTypeRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function getAll()
    {
        $type = LeaveType::all();
        return res($type);
    }

    public function store(LeaveTypeRequest $request)
    {
        $request = $request->all();
        LeaveType::create($request);

        return success_res('Leave Type Created Successfully!');
    }

    public function update(LeaveTypeRequest $request, LeaveType $type)
    {
        $request = $request->all();

        $type->update($request);

        return success_res('Leave Type Updated Successfully!');
    }

    public function delete(LeaveType $type)
    {
        $type->delete();

        return success_res('Leave Type Deleted Successfully!');
    }
}
