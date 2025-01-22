<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\EmployeeAttendance;
use App\Models\Setting;

class AttendanceApiController extends Controller
{
    public function viewAttendance(Request $request)
{
    // Get the authenticated employee's ID
    $id = auth('sanctum')->user()->id;

    // Get the current date
    $currentDate = Carbon::now();
    // Initialize variables for month and year
    $month = null;
    $year = null;

    if ($request->has('month')) {
        // Assuming $monthString contains the value "2024-03"
        $monthString = $request->input('month');

        // Parse the month string using Carbon
        $date = Carbon::createFromFormat('Y-m', $monthString);
        // Get the month and year
        $month = $date->format('m');
        $year = $date->format('Y');
    }

    // Set default values for month and year
    $month = $month ?: $currentDate->format('m');
    $year = $year ?: $currentDate->format('Y');

    // Retrieve counts of different statuses
    $counts = [
        'presentCount' => EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'present')
            ->count(),

        'absentCount' => EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'absent')
            ->count(),

        'leaveCount' => EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'leave')
            ->count(),

        'workFromHomeCount' => EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'work_from_home')
            ->count(),

        'holidayCount' => EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'holiday')
            ->count(),

        'remotelyCount' => EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'remotely')
            ->count(),

        'halfLeaves' => EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'half_leave')
            ->count(),
    ];

    // Retrieve the attendance data
    $monthData = EmployeeAttendance::where('user_id', $id)
        ->whereYear('attendance_date', $year)
        ->whereMonth('attendance_date', $month)
        ->orderBy('attendance_date', 'asc')
        ->get();

    // Initialize total hours variables
    $totalWorkingHours = 0;
    $presentDays = 0;

    foreach ($monthData as $day) {
        if ($day->status === 'present') {
            if ($day->check_in && $day->check_out) {
                $checkIn = Carbon::parse($day->check_in);
                $checkOut = Carbon::parse($day->check_out);

                // Adjust if checkout is the next day
                if ($checkOut->lt($checkIn)) {
                    $checkOut->addDay();
                }

                $difference = $checkOut->diff($checkIn);
                $totalWorkingHours += $difference->h * 60 + $difference->i;
            }
            $presentDays++;
        }
    }

    // Calculate total hours and minutes
    $hours = intdiv($totalWorkingHours, 60);
    $minutes = $totalWorkingHours % 60;
    $formattedTotalHours = sprintf('%d:%02d', $hours, $minutes);

    // Calculate total extra hours
    $totalExtraHours = $monthData->sum('extra_hours');

    // Retrieve yearly leaves from settings
    $yearlyLeavesSetting = Setting::where('name', 'yearly_leaves')->first();
    $yearlyLeaves = $yearlyLeavesSetting ? $yearlyLeavesSetting->value : 0;

    // Calculate available yearly leaves
    $yearlyLeavesAvailable = $yearlyLeaves - $counts['leaveCount'];

    // Return the data as JSON
    return response()->json([

        'year' => $year,
        'month' => $month,
        'counts' => $counts,
        'formattedTotalHours' => $formattedTotalHours,
        'presentDaysCount' => $presentDays,
        'yearlyLeavesAvailable' => $yearlyLeavesAvailable,
        'monthData' => $monthData,
    ]);
}
}
