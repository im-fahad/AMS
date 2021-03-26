<?php

namespace App\Http\Controllers\Api;

use App\Enum\LeaveStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveRequest;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function getAll()
    {
        $leaves = Leave::all();
        return res($leaves);
    }

    public function store(LeaveRequest $request)
    {
        $request = $request->all();
        Leave::create($request);

        return success_res('Your Leave Request Submitted Successfully!');
    }

    public function update(LeaveRequest $request, Leave $leave)
    {
        $request = $request->all();

        if ($leave->status != LeaveStatus::PENDING) {
            return error_res('You Can\'t Update This Leave Request Now');
        }

        $leave->update($request);

        return success_res('Leave Request Updated Successfully!');
    }

    public function accept(Request $request, Leave $leave)
    {
        $request = $request->all();

        if ($leave->status == LeaveStatus::ACCEPTED || $leave->status == LeaveStatus::ACCEPTED_WITH_MESSAGE) {
            return error_res('Already Accepted');
        }

        if ($request['message']) {
            $request['status'] = LeaveStatus::ACCEPTED_WITH_MESSAGE;
        } else {
            $request['message'] = null;
            $request['status'] = LeaveStatus::ACCEPTED;
        }
        $leave->update($request);

        return success_res('Leave Request Accepted Successfully!');
    }

    public function reject(Request $request, Leave $leave)
    {
        if ($leave->status == LeaveStatus::REJECTED) {
            return error_res('Already Rejected');
        }

        $request = $request->validate(['message' => 'required']);
        $request['status'] = LeaveStatus::REJECTED;
        $leave->update($request);

        return success_res('Leave Request Rejected');
    }

    public function delete(Leave $leave)
    {
        if ($leave->status != LeaveStatus::PENDING) {
            return error_res('You Can\'t Delete This Leave Request Now');
        }

        $leave->delete();

        return success_res('Leave Request Deleted Successfully!');
    }
}
