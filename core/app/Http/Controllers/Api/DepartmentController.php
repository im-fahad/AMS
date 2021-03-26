<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getAll()
    {
        $departments = Department::all();

        return res($departments);
    }

    public function store(DepartmentRequest $request)
    {
        $request = $request->all();
        Department::create($request);

        return success_res('Department Created Successfully!');
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $request = $request->all();
        $department->update($request);

        return success_res('Department Updated Successfully!');
    }

    public function delete(Department $department)
    {
        $department->delete();

        return success_res('Department Deleted successfully!');
    }
}
