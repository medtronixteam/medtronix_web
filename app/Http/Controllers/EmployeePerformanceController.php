<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Models\Task;
use App\Models\Setting;
use Carbon\Carbon;
use Auth;

class EmployeePerformanceController extends Controller
{
    public function viewPerformance(Request $request)
    {
        $id = auth()->user()->id;
        $currentDate = Carbon::now();

           $month = $request->input('month') ? Carbon::createFromFormat('Y-m', $request->input('month'))->format('m') : $currentDate->format('m');
$year = $request->input('month') ? Carbon::createFromFormat('Y-m', $request->input('month'))->format('Y') : $currentDate->format('Y');

        $presentCount = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'present')
            ->count();

        $absentCount = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'absent')
            ->count();

        $leaveCount = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'leave')
            ->count();

        $workFromHomeCount = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'work_from_home')
            ->count();

        $holidayCount = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'holiday')
            ->count();

        $remotelyCount = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'remotely')
            ->count();

        $halfLeaves = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'half_leave')
            ->count();

        $monthData = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->orderBy('attendance_date', 'asc')
            ->get();

$totalPendingTasks = Task::where('user_id', $id)
    ->where('approved_by_hr', 0)
    ->where('approved_by_team_lead', 0)
    ->count();
        $lateCheckInCount = 0;
        $totalCheckIn = 0;
        $totalCheckOut = 0;
        $presentDays = 0;
        $totol_working_in_hours = $totol_working_in_Mins = 0;

     foreach ($monthData as $day) {
    if ($day['status'] === 'present') {
        if ($day['check_in'] != null) {
            $checkIn = Carbon::parse($day['check_in']);
            $officeOpenTime = Carbon::parse($day->attendance_date . ' 09:15:00');

            if ($checkIn->gt($officeOpenTime)) {
                // Increment late check-in count if check-in time is greater than 9:10 am
                $lateCheckInCount++;
            }
        }
        $presentDays++;
    }
}



        $hours = intdiv($totol_working_in_hours, 60);
        $minutes = $totol_working_in_hours % 60;
        $formattedTotalHours = $hours . ":" . $minutes;
        $totalExtraHours = $monthData->sum('extra_hours');
        $presentDaysCount = $presentDays;

        $yearlyLeavesSetting = Setting::where('name', 'yearly_leaves')->first();
        $yearlyLeaves = $yearlyLeavesSetting ? $yearlyLeavesSetting->value : 0;
        $yearlyLeavesAvailable = $yearlyLeaves - ($leaveCount);

// Update the existing code in the viewPerformance method of EmployeePerformanceController

$totalDaysWorked = Task::where('user_id', $id)
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->count();

$tasksPendingHR = Task::where('user_id', $id)
    ->where('approved_by_hr', 0)
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->count();

$tasksApprovedByHR = Task::where('user_id', $id)
    ->where('approved_by_hr', 1)
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->count();

$tasksRejectedByHR = Task::where('user_id', $id)
    ->where('approved_by_hr', 2)
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->count();

$tasksRevisedByHR = Task::where('user_id', $id)
    ->where('approved_by_hr', 3)
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->count();

$tasksPendingTeamLead = Task::where('user_id', $id)
    ->where('approved_by_team_lead', 0)
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->count();

$tasksApprovedByTeamLead = Task::where('user_id', $id)
    ->where('approved_by_team_lead', 1)
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->count();

$tasksRejectedByTeamLead = Task::where('user_id', $id)
    ->where('approved_by_team_lead', 2)
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->count();

$tasksRevisedByTeamLead = Task::where('user_id', $id)
    ->where('approved_by_team_lead', 3)
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->count();


       return view('employeeui.performance', compact('month', 'lateCheckInCount', 'totalPendingTasks', 'year', 'presentCount', 'absentCount', 'leaveCount', 'workFromHomeCount', 'holidayCount', 'remotelyCount', 'halfLeaves', 'totalExtraHours', 'formattedTotalHours', 'presentDaysCount', 'yearlyLeavesAvailable', 'totalDaysWorked', 'tasksPendingHR', 'tasksApprovedByHR', 'tasksRejectedByHR', 'tasksRevisedByHR', 'tasksPendingTeamLead', 'tasksApprovedByTeamLead', 'tasksRejectedByTeamLead', 'tasksRevisedByTeamLead'));

    }
}
