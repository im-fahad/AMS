<?php

namespace App\Http\Controllers\Api;

use App\Enum\AttendanceStatus;
use App\Enum\WorkingType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function signIn()
    {
        $attendance = Attendance::where('employee_id', auth()->user()->id)->where('date', Carbon::today())->first();

        if ($attendance) {
            return error_res('You Have Already Sign In Today');
        }

        $data = [];
        $data['date'] = Carbon::today();
        $data['entering_time'] = Carbon::now();
        $data['status'] = AttendanceStatus::SIGN_IN;

        Attendance::create($data);

        return success_res('Successfully Sign In');
    }

    public function signOut()
    {
        $attendance = Attendance::where('employee_id', auth()->user()->id)->where('date', Carbon::today())->first();

        if ($attendance->status == AttendanceStatus::SIGN_OUT) {
            return error_res('You Have Already Sign Out Today');
        }

        $data = [];
        $data['out_time'] = Carbon::now();

        $out_time = $data['out_time'];
        $entering_time = $attendance->entering_time;
        $total_working_time = Carbon::parse($out_time)->diff(Carbon::parse($entering_time), true);

        $data['total_working_time'] = CarbonInterval::make($total_working_time->h . 'h ' . $total_working_time->i . 'm ' . $total_working_time->s . 's')->forHumans();

        if ($total_working_time->h < 5) {
            $data['working_type'] = WorkingType::HALF_DAY;
        } else {
            $data['working_type'] = WorkingType::FULL_TIME;
        }
        $data['status'] = AttendanceStatus::SIGN_OUT;

        $attendance->update($data);

        return success_res('Signed out successfully. Today you worked ' . $data['total_working_time']);
    }
}
