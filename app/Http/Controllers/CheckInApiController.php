<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\IpRange;
use App\Models\OfficeTime;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;

class CheckInApiController extends Controller
{
    public function checkIn(Request $request)
    {

        $officeTime = OfficeTime::first();
        $currentTime = Carbon::now()->setTimezone('Asia/Karachi');
        // Fetch the user from the database
        // if(!auth()->check()){
        //     return response()->json(['message' => ' Login please','status'=>'error'], 401);

        // }
        $user = User::find(auth('sanctum')->user()->id);
        if ($user->ip_required === 1) {
            if ($currentTime->lt($officeTime->min_reporting_time)) {

                return response()->json(['message' => 'Contact HR. You cannot check in before Office Reporting Time.', 'status' => 'error', 'token'], 400);
            }

            if (!$this->validateIp($request->ip())) {

                return response()->json(['message' => 'Your IP is not valid to mark attendance.', 'status' => 'error'],400 );
            }
            //push the notificaiton if user checkin late then Max reporting time...
            if ($currentTime->gt($officeTime->max_reporting_time)) {
                $userArray[] = $user->id;
                //   NotificationController::pushNotification('checkinLate', $userArray);
            }
        }

        $attendanceDate = now()->format('Y-m-d');

        // Check if the user has already marked attendance for the current date
        $existingAttendance = EmployeeAttendance::where('user_id', $user->id)
            ->whereDate('attendance_date', $attendanceDate)
            ->first();

        if ($existingAttendance) {
            // User has already checked in for today
            if ($existingAttendance->status === 'present') {

                // return redirect()->back()->with('error', 'You have already checked in .');
                return response()->json(['message' => 'You have already checked in.', 'status' => 'error'], 400 );
            } else {
                // Update existing attendance to mark present
                $existingAttendance->status = 'present';
                $existingAttendance->check_in = Carbon::now()->setTimezone('Asia/Karachi')->toTimeString();
                $existingAttendance->save();

                return response()->json(['message' => 'Check-in updated successfully', 'status' => 'success'],200);
            }
        }

        $currentTime = Carbon::now()->setTimezone('Asia/Karachi')->toTimeString();

        // Create a new attendance record for check-in
        $attendance = new EmployeeAttendance();
        $attendance->attendance_date = $attendanceDate;
        $attendance->check_in = $currentTime;
        $attendance->user_id = $user->id;
        // Set status to 'present'
        $attendance->status = 'present';
        $attendance->save();

        // Mark other users as absent if they haven't marked attendance for today
        $otherUsers = User::where('id', '!=', $user->id)->where('role', 'employee')->get();
        foreach ($otherUsers as $otherUser) {
            $otherUserAttendance = EmployeeAttendance::where('user_id', $otherUser->id)
                ->whereDate('attendance_date', $attendanceDate)
                ->first();
            if (!$otherUserAttendance) {
                $absentAttendance = new EmployeeAttendance();
                $absentAttendance->attendance_date = $attendanceDate;
                $absentAttendance->user_id = $otherUser->id;
                $absentAttendance->status = 'absent';
                $absentAttendance->save();
            }
        }

        flashy()->success('Check-In Marked Successfully!', '');
        // Redirect back with success message
        // return redirect()->back()->with('success', 'Check-in successful');
        return response()->json(['message' => 'Check-in marked successfully', 'status' => 'success']);
    }


    public function checkOut(Request $request)
    {
        $officeTime = OfficeTime::first();
        $currentTime = Carbon::now()->setTimezone('Asia/Karachi');
        $user = User::find(auth('sanctum')->user()->id);

        // Validate if IP is required for check-out and if the current time is before office closing time
        if ($user->ip_required === 1) {
            if ($currentTime->gt($officeTime->close_time)) {
                return response()->json(['message' => 'Contact HR. You cannot check out after office closing time.', 'status' => 'error'], 400);
            }

            if (!$this->validateIp($request->ip())) {
                return response()->json(['message' => 'Your IP is not valid to mark attendance', 'status' => 'error'], 400);
            }
        }

        $attendanceDate = now()->format('Y-m-d');

        // Check if the user has completed their tasks for the day
        $tasksDone = Task::where('date', $attendanceDate)
                         ->where('user_id', $user->id)
                         ->count();
        if ($tasksDone == 0) {
            return response()->json(['message' => 'Enter your tasks before checking out.', 'status' => 'error'], 400);
        }

        // Retrieve the user's attendance record for the current date
        $existingAttendance = EmployeeAttendance::where('user_id', $user->id)
                                                ->whereDate('attendance_date', $attendanceDate)
                                                ->first();

        if (!$existingAttendance) {
            return response()->json(['message' => 'Please check in before checking out.', 'status' => 'error'], 400);
        }

        if ($existingAttendance->check_out) {
            return response()->json(['message' => 'You have already checked out for today.', 'status' => 'error'], 400);
        }

        // Mark the check-out time
        $existingAttendance->check_out = $currentTime->toTimeString();
        $existingAttendance->save();

        return response()->json(['message' => 'Check-out marked successfully', 'status' => 'success'],200);
    }


    private function validateIp($userIp)
    {

        $ipRange = IpRange::all(); // Get the first IP range (assuming only one range for now)

        if ($ipRange) {
            foreach ($ipRange as $key => $storedIP) :
                # code...

                // Convert IP addresses to numeric values
                $userIpNumeric = str_replace(['.', ':'], "", $userIp);

                $ipRangeFromNumeric = str_replace(['.', ':'], "", $storedIP->network_ip);

                // Compare IPv6 addresses
                if ($userIpNumeric == $ipRangeFromNumeric) {

                    return true;
                }

            endforeach;
        }

        return false;
    }
}
