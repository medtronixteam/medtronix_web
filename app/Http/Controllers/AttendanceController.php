<?php

namespace App\Http\Controllers;

use App\Http\Controllers\NotificationController;
use App\Models\Attendance;
use App\Models\EmployeeAttendance;
use App\Models\IpRange;
use App\Models\OfficeTime;
use App\Models\Setting;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index()
    {
        $userData = User::where('role', 'employee')->where('show_in_attendence', 1)->get();
        // return $userData;
        return view("admin.attendance", compact("userData"));
    }
    public function create()
    {
        $employees = User::where('role', 'employee')->get();
        return view("employees.attendances.create", compact("employees"));
    }
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',

            'other' => 'nullable|string|max:255',
        ]);
        $attendance = Attendance::where('employee_id', $request->input('employee_id'))->where('month', $request->input('month'))->where('year', $request->input('year'))->get();

        //  return $attendance;
        if ($attendance->count() > 0) {
            flashy()->success('Attendance for this month is already created !', '#');
            return redirect()->back();
        }

        Attendance::create($request->all());

        flashy()->success('ðŸ˜Ž Attendance Created SuccessFully !', '#');
        return redirect()->route('attendances.index')->with('success', 'Attendance created successfully');
    }

    public function list(Request $request)
    {
        if ($request->date) {
            $date = $request->date;
        } else {
            $date = date('Y-m-d');
        }

        // Fetch attendances and order them by check-in time
        $attendances = EmployeeAttendance::where('attendance_date', $date)
            ->orderBy('check_in')
            ->get();

        return view("employees.attendances.index", compact("attendances", "date"));
    }

    public function listAttendance(Request $request)
    {
        $attendance = EmployeeAttendance::where('attendance_date', $request->input('attendance_date'));
        $userData = User::whereNot('role', 'admin')->where('show_in_attendence', 1)->where('is_disabled','no')->latest('name')->get();
        $currentTime = Carbon::now()->timezone('Asia/Karachi')->format('H:i');
        $dataArray = [];
        if ($attendance->count() == 0) {

            foreach ($userData as $user):

                $dataArray[] = ['id' => $user->id, 'name' => $user->name, 'check_id' => $currentTime, 'check_out' => '', 'status' => $user->status, 'extra_hours' => 0, 'remarks' => ''];
            endforeach;
        } else {

            $attendanceData = $attendance->get();
            foreach ($attendanceData as $user):
                $time = Carbon::parse($user->check_in)->format('H:i');

                $dataArray[] = ['id' => $user->user_id, 'name' => $user->employee->name, 'check_in' => $user->check_in, 'check_out' => $user->check_out, 'status' => $user->status, 'extra_hours' => $user->extra_hours, 'remarks' => ($user->remarks == null) ? "" : $user->remarks];
            endforeach;
        }

        return response()->json($dataArray);
    }
    public function storeAttendance(Request $request)
    {

        $attendance = EmployeeAttendance::where('attendance_date', $request->input('attendance_date'));
        if ($attendance->count() == 0) {
            foreach ($request->input('status') as $key => $value) {
                EmployeeAttendance::create([
                    'attendance_date' => $request->input('attendance_date'),
                    'status' => $request->status[$key],
                    'check_in' => $request->check_in[$key],
                    'check_out' => $request->check_out[$key],
                    'user_id' => $request->user_id[$key],
                    'remarks' => $request->remarks[$key],
                    'extra_hours' => $request->extra_hours[$key],
                ]);
            }

            $response = ['message' => 'Attendance Has been Created', 'status' => 'success'];
        } else {
            $attendance->delete();
            foreach ($request->input('status') as $key => $value) {
                EmployeeAttendance::create([
                    'attendance_date' => $request->input('attendance_date'),
                    'status' => $request->status[$key],
                    'check_in' => $request->check_in[$key],
                    'check_out' => $request->check_out[$key],
                    'user_id' => $request->user_id[$key],
                    'remarks' => $request->remarks[$key],
                    'extra_hours' => $request->extra_hours[$key],
                ]);
            }
            $response = ['message' => 'Attendance Has been Updated', 'status' => 'success'];
        }
        return response()->json($response);
    }
    public function attendancesUser($id, Request $request)
    {
        // Get the current date
        $currentDate = Carbon::now();
        // Initialize variables for month and year
        $month = null;
        $year = null;
        if (isset($request['month'])) {
            // Assuming $monthString contains the value "2024-03"
            $monthString = $request->input('month');

            // Parse the month string using Carbon
            $date = Carbon::createFromFormat('Y-m-d', $monthString . '-01');
            // Get the month and year
            $month = $date->format('m'); // Retrieves the month in numeric format (e.g., "03")
            $year = $date->format('Y');
        }

        // If month is not provided in the request, set it to the current month
        $month = $month ?: $currentDate->format('m');

        // If year is not provided in the request, set it to the current year
        $year = $year ?: $currentDate->format('Y');

        // Retrieve the count of present and absent statuses for the specified user, year, and month
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

        // Retrieve the count of different statuses for the specified user, year, and month
        $leaveCount = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
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

        // Retrieve the attendance data for the specified user, year, and month
        $monthData = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->orderBy('attendance_date', 'asc')
            ->get();

        // Initialize variables for total check-in and check-out times
        $totalCheckIn = 0;
        $totalCheckOut = 0;
        $presentDays = 0;

        foreach ($monthData as $day) {
            if ($day['status'] === 'present') {
                if ($day['check_in'] != null && $day['check_out'] != null) {
                    // Add check-in time to total
                    $totalCheckIn += strtotime($day['check_in']);

                    // Add check-out time to total
                    $totalCheckOut += strtotime($day['check_out']);
                    // Increment the count of present days
                }

                $presentDays++;
            }
        }

        // Calculate total hours worked (in seconds)
        $totalHoursWorkedInSeconds = $totalCheckOut - $totalCheckIn;

        // Convert total hours worked to hours and minutes
        $totalHoursWorkedHours = floor($totalHoursWorkedInSeconds / 3600);
        $totalHoursWorkedMinutes = floor(($totalHoursWorkedInSeconds % 3600) / 60);

        // Format the total hours worked
        $formattedTotalHours = sprintf("%02d:%02d", $totalHoursWorkedHours, $totalHoursWorkedMinutes);

        // total extra_hours count
        $totalExtraHours = $monthData->sum('extra_hours');
        $presentDaysCount = $presentDays;

        // Retrieve all settings
        $settings = Setting::all();

        // Calculate the total count of settings
        $settingsCount = $settings->count();

        // Calculate the total value of settings
        $totalLeave = Setting::where('name', 'yearly_leaves')->first()->value;
        $leftLeave = (int) $totalLeave - $leaveCount;
        // Retrieve the yearly leaves from settings
        $yearlyLeavesSetting = Setting::where('name', 'yearly_leaves')->first();
        $yearlyLeaves = $yearlyLeavesSetting ? $yearlyLeavesSetting->value : 0;

        return view('employees.attendances.user_attendance', compact('monthData', 'year', 'month', 'presentCount', 'absentCount', 'leaveCount', 'workFromHomeCount', 'holidayCount', 'remotelyCount', 'halfLeaves', 'totalExtraHours', 'formattedTotalHours', 'presentDaysCount', 'leftLeave', 'yearlyLeaves'));
    }

    public function employeeviewAttendance(Request $request)
    {
        // Get the authenticated employee's ID
        $id = auth()->user()->id;

        // Get the current date
        $currentDate = Carbon::now();

        // Initialize variables for month and year
        $month = null;
        $year = null;

        if ($request->has('month')) {
            // Parse the month string using Carbon
            $date = Carbon::createFromFormat('Y-m', $request->input('month'));

            // Get the month and year
            $month = $date->format('m'); // Retrieves the month in numeric format (e.g., "03")
            $year = $date->format('Y');
        }

        // If month is not provided in the request, set it to the current month
        $month = $month ?: $currentDate->format('m');

        // If year is not provided in the request, set it to the current year
        $year = $year ?: $currentDate->format('Y');

        // Retrieve the count of present and absent statuses for the specified user, year, and month
        $presentCount = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'present')
            ->count();

        // Retrieve other counts (absent, leave, work from home, etc.) similarly

        // Retrieve the attendance data for the specified user, year, and month
        $monthData = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->orderBy('attendance_date', 'asc')
            ->get();

        // Calculate other metrics (total hours worked, extra hours, etc.) similarly

        // Pass the retrieved data to the view
        return view('employees.attendances.employee_attendance', compact('monthData', 'presentCount'));
    }

    public function viewAttendance(Request $request)
    {

        // Get the authenticated employee's ID
        $id = auth()->user()->id;

        // Get the current date
        $currentDate = Carbon::now();
        // Initialize variables for month and year
        $month = null;
        $year = null;
        if (isset($request['month'])) {

            // Assuming $monthString contains the value "2024-03"
            $monthString = $request->input('month');

            // Parse the month string using Carbon
            $date = Carbon::createFromFormat('Y-m-d', $monthString . '-01');
            // Get the month and year
            $month = $date->format('m'); // Retrieves the month in numeric format (e.g., "03")
            $year = $date->format('Y');
        }

        // Get the current date

        // If month is not provided in the request, set it to the current month
        $month = $month ?: $currentDate->format('m');

        // If year is not provided in the request, set it to the current year
        $year = $year ?: $currentDate->format('Y');

        // Retrieve the count of present and absent statuses for the specified user, year, and month
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

        // Retrieve the count of different statuses for the specified user, year, and month
        $leaveCount = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
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

        // Retrieve the attendance data for the specified user, year, and month
        $monthData = EmployeeAttendance::where('user_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->orderBy('attendance_date', 'asc')
            ->get();

        // Initialize variables for total check-in and check-out times
        // Initialize variables for total check-in and check-out times
        $totalCheckIn = 0;
        $totalCheckOut = 0;
        $presentDays = 0;
        $totol_working_in_hours = $totol_working_in_Mins = 0;

        foreach ($monthData as $day) {
            if ($day['status'] === 'present') {

                if ($day['check_in'] != null && $day['check_out'] != null) {

                    $checkIn = Carbon::parse($day['check_in']);
                    $checkOut = Carbon::parse($day['check_out']);

                    // Check if checkout is the next day
                    if ($checkOut->lt($checkIn)) {
                        $checkOut->addDay();
                    }

                    $difference = $checkOut->diff($checkIn);

                    $totol_working_in_hours += $difference->h * 60 + $difference->i;
                    // $totol_working_in_Mins+= $difference->i;
                    // Add check-in time to total
                    //$totalCheckIn += strtotime($day['check_in']);

                    // Add check-out time to total
                    //$totalCheckOut += strtotime($day['check_out']);
                    // Increment the count of present days
                }

                $presentDays++;
            }
        }
        // return $totol_working_in_hours;
        $hours = intdiv($totol_working_in_hours, 60);
        $minutes = $totol_working_in_hours % 60;
        $formattedTotalHours = $hours . ":" . $minutes;
        // Calculate total hours worked (in seconds)
        $totalHoursWorkedInSeconds = $totalCheckOut - $totalCheckIn;
        // total extra_hours count
        $totalExtraHours = $monthData->sum('extra_hours');
        $presentDaysCount = $presentDays;

        // Retrieve the yearly leaves from settings
        $yearlyLeavesSetting = Setting::where('name', 'yearly_leaves')->first();
        $yearlyLeaves = $yearlyLeavesSetting ? $yearlyLeavesSetting->value : 0;

        // Calculate yearly leaves available
        $yearlyLeavesAvailable = $yearlyLeaves - ($leaveCount);
        // return $monthData;
        return view('employeeui.attendance', compact('monthData', 'year', 'month', 'presentCount', 'absentCount', 'leaveCount', 'workFromHomeCount', 'holidayCount', 'remotelyCount', 'halfLeaves', 'totalExtraHours', 'formattedTotalHours', 'presentDaysCount', 'yearlyLeavesAvailable'));
    }
    public function checkIn(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            return response()->json(['success' => true, 'message' => reset($messages)[0]]);

        }
        $officeTime = OfficeTime::first();

        $currentTime = Carbon::now()->setTimezone('Asia/Karachi');
        $user = User::find(auth()->id());

        if ($currentTime->lt($officeTime->min_reporting_time)) {
            return response()->json(['success' => false, 'message' => 'Contact HR. You cannot check in before office reporting time. ' . $officeTime->min_reporting_time]);
        }

        //push the notificaiton if user checkin late then Max reporting time...

        //check if ip required
        if ($user->ip_required == 1) {
            if ($currentTime->gt($officeTime->max_reporting_time)) {

                return response()->json(['success' => false, 'message' => 'You cannot check in after Office Reporting Time.' . $officeTime->max_reporting_time]);

            }
            //check if user is in office
            // $areaCenter = ['lat' =>  Setting::where('name', 'latitude')->first(), 'lng' =>Setting::where('name', 'longitude')->first()];
            //$areaRadius = Setting::where('name', 'radius')->first(); // in meters

            $areaCenter = ['lat' => 30.66813, 'lng' => 73.10720];
            $areaRadius = 2000; // in meters

            $userLatLng = ['lat' => $request->latitude, 'lng' => $request->longitude];
            $distance = $this->computeDistance($areaCenter, $userLatLng);

            if ($distance > $areaRadius) {
                return response()->json(['success' => false, 'message' => 'You are outside the allowed area.']);
            }

        }

        $attendanceDate = now()->format('Y-m-d');
        $existingAttendance = EmployeeAttendance::where('user_id', auth()->id())
            ->whereDate('attendance_date', $attendanceDate)
            ->first();

        if ($existingAttendance) {
            if ($existingAttendance->status === 'present') {
                return response()->json(['success' => false, 'message' => 'You have already checked in.']);
            } else {
                $existingAttendance->status = 'present';
                $existingAttendance->check_in = $currentTime->toTimeString();
                $existingAttendance->save();
                return response()->json(['success' => true, 'message' => 'Check-In Updated Successfully!']);
            }
        }
        if ($currentTime->gt($officeTime->max_reporting_time)) {
            $userArray[] = auth()->id();
            NotificationController::pushNotification('checkinLate', $userArray);

        }

        $attendance = new EmployeeAttendance();
        $attendance->attendance_date = $attendanceDate;
        $attendance->check_in = $currentTime->toTimeString();
        $attendance->user_id = auth()->id();
        $attendance->status = 'present';
        $attendance->save();

        $otherUsers = User::where('id', '!=', auth()->id())->where('role', 'employee')->get();
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

        return response()->json(['success' => true, 'checkInTime' => $currentTime->toTimeString(), 'message' => 'Check-In Marked Successfully!']);
    }

    // Helper function to compute distance between two points
    private function computeDistance($point1, $point2)
    {
        $earthRadius = 6371000; // in meters

        $latFrom = deg2rad($point1['lat']);
        $lngFrom = deg2rad($point1['lng']);
        $latTo = deg2rad($point2['lat']);
        $lngTo = deg2rad($point2['lng']);

        $latDelta = $latTo - $latFrom;
        $lngDelta = $lngTo - $lngFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lngDelta / 2), 2)));

        return $angle * $earthRadius;
    }

    public function attendanceMarked(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            $response = [
                'message' => reset($messages)[0],
                'status' => 'error', 'code' => 500,
            ];
        } else {
            $setting = Setting::where('name', 'qr_code')->first();

            // if ($setting->value != $request->code) {
            //     $response = [
            //         'message' => 'Please Scan the Correct QR Code',
            //         'status' => 'error', 'code' => 500,
            //     ];
            //     return response()->json($response);
            // }
            $attendanceDate = now()->format('Y-m-d');
            $existingAttendanceCheck = EmployeeAttendance::whereDate('attendance_date', $attendanceDate)->count();


            $currentTime = Carbon::now()->setTimezone('Asia/Karachi');
            // Fetch the user from the database
            $user = User::find(auth()->id());
            $officeTime = OfficeTime::first();


         if ($user->ip_required == 1) {
            if ($currentTime->lt($officeTime->min_reporting_time)) {

                $response = [
                    'message' => 'Contact Hr. You cannot check in before Office Reporting TIme.',
                    'status' => 'error', 'code' => 500,
                ];
                return response()->json($response);
            }

        }

    $areaCenter = ['lat' => 30.66810561944062, 'lng' => 73.10721245681762];
    $areaRadius = 1000; // in meters

    $userLatLng = ['lat' => $request->latitude, 'lng' => $request->longitude];
    $distance = $this->computeDistance($areaCenter, $userLatLng);

    // if ($distance > $areaRadius && !$this->validateIp($request->ip())) {

    //     return response()->json(['success' => false, 'message' => 'Your IP and Location is not valid to mark attendance']);

    // }


            if ($existingAttendanceCheck>0) {
                $existingAttendance =EmployeeAttendance::where('user_id', auth()->id())
                ->whereDate('attendance_date', $attendanceDate)->first();

                // User has already checked in for today
                if ($existingAttendance->status == 'absent') {
                    if ($currentTime->gt($officeTime->max_reporting_time)) {
                        return response()->json(['status' => 'error', 'code' => 500, 'message' => 'You cannot check in after Office Reporting Time. '.$officeTime->max_reporting_time]);

                    }
                    // Update existing attendance to mark present
                    $existingAttendance->status = 'present';
                    $existingAttendance->check_in = Carbon::now()->setTimezone('Asia/Karachi')->toTimeString();
                    $existingAttendance->save();
                    $response = [
                        'message' => 'Check-In Marked Successfully......!',
                        'status' => 'success', 'code' => 200,
                    ];
                    return response()->json($response);
                }else {
                    $checkTasksDone = Task::where('date', $attendanceDate)->where('user_id', auth()->id())->count();

                        if ($checkTasksDone == 0) {
                            return response()->json([
                            'message' => 'Enter your tasks before checking out.',
                            'status' => 'error',
                            'code' => 500,
                        ]);


                    }

                    if ($currentTime->gt($officeTime->close_time)) {

                       return response()->json([
                        'message' => 'Contact Hr. You cannot check out after office closing time.',
                        'status' => 'error',
                        'code' => 500,
                    ]);


                    }
                    $existingAttendance->check_out = Carbon::now()->setTimezone('Asia/Karachi')->toTimeString();
                    $existingAttendance->save();

                    return response()->json([
                        'message' => 'Check-Out Marked Successfully!',
                        'status' => 'success',
                        'code' => 200,
                    ]);

                }
            }
            // if ($currentTime->gt($officeTime->max_reporting_time)) {
            //     $userArray[] = auth()->id();
            //     NotificationController::pushNotification('checkinLate', $userArray);

            // }
            // if ($currentTime->gt($officeTime->max_reporting_time)) {

            if ($currentTime->gt($officeTime->max_reporting_time)) {
                return response()->json(['status' => 'error', 'code' => 500, 'message' => 'You cannot check in after Office Reporting Time. '.$officeTime->max_reporting_time]);

            }

            $currentTime = Carbon::now()->setTimezone('Asia/Karachi')->toTimeString();

            // Create a new attendance record for check-in
            EmployeeAttendance::create([
                'status' => 'present',
                'attendance_date'=>$attendanceDate,
                'check_in'=>$currentTime,
                'user_id'=> auth()->id(),

            ]);

            // Mark other users as absent if they haven't marked attendance for today
            $otherUsers = User::where('id', '!=', auth()->id())->where('role', 'employee')->get();
            foreach ($otherUsers as $otherUser) {
                $otherUserAttendance = EmployeeAttendance::where('user_id', $otherUser->id)
                    ->whereDate('attendance_date', $attendanceDate);
                if ($otherUserAttendance->count()==0) {
                    EmployeeAttendance::create([
                        'status' => 'absent',
                        'attendance_date'=>$attendanceDate,
                        'check_in'=>null,
                        'user_id'=>$otherUser->id,

                    ]);
                }
            }

            $response = [
                'message' => 'Check in Marked Successfully ! ',
                'status' => 'success', 'code' => 200,
            ];
        }
        return response()->json($response);
    }
    public function checkOut(Request $request)
    {
        $officeTime = OfficeTime::first();

        $currentTime = Carbon::now()->setTimezone('Asia/Karachi');

        // Check if the current time is before the office close time

        $attendanceDate = now()->format('Y-m-d');
        $user = User::find(auth()->id());

        // Check if IP validation is required based on the user's ip_required field

        $checkinToday = EmployeeAttendance::where('user_id', auth()->id())
            ->whereDate('attendance_date', $attendanceDate)
            ->count();
        if ($checkinToday == 0) {
            return response()->json(['success' => false, 'message' => 'Mark Check in First.']);

        }
        $checkTasksDone = Task::where('date', $attendanceDate)->where('user_id', auth()->id())->count();

        if ($checkTasksDone == 0) {
            return response()->json(['success' => false, 'message' => 'Enter your tasks before checking out.']);

        }
        if ($user->ip_required == 1) {
            if ($currentTime->gt($officeTime->close_time)) {

                return response()->json(['success' => false, 'message' => 'Contact Hr. You cannot check out after office closing time.']);

            }

        }
        if (!$this->validateIp($request->ip())) {

            $response = [
                'message' => 'Your IP is not valid to mark attendance. Please Connect with Medtronix Ai Team Or Medtronix Training Wifi.',
                'status' => 'error', 'code' => 500,
            ];
            return response()->json($response);
        }
        // Check if the user has already marked attendance for the current date
        $existingAttendance = EmployeeAttendance::where('user_id', auth()->id())
            ->whereDate('attendance_date', $attendanceDate)
            ->first();

        if (!$existingAttendance) {
            // User has not checked in yet, redirect back with error message


            return response()->json(['success' => false, 'message' => 'Please check in before checking out']);


        } else {
            // Check if the user has already checked out for today
            if ($existingAttendance->check_out != null) {
                // User has already checked out for today, redirect back with error message

                return response()->json(['success' => true, 'message' => 'You have already checked out for today.']);

            }
        }

        $currentTime = Carbon::now()->setTimezone('Asia/Karachi')->toTimeString();

        // Update the existing attendance record with check-out time
        $existingAttendance->check_out = $currentTime;
        $existingAttendance->save();


        return response()->json(['success' => true, 'message' => 'Check-Out Marked Successfully!']);
    }

    private function validateIp($userIp)
    {

        $ipRange = IpRange::all(); // Get the first IP range (assuming only one range for now)

        if ($ipRange) {
            foreach ($ipRange as $key => $storedIP):
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
