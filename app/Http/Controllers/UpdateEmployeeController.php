<?php

namespace App\Http\Controllers;

use App\Events\CheckNotify;
use App\Models\Attendance;
use App\Models\EmployeeAttendance;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use App\Models\Request as UserRequest;
use App\Http\Controllers\NotificationController;
use App\Models\IpRange;
use App\Models\OfficeTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request as HttpRequest;

class UpdateEmployeeController extends Controller
{
    public function storetask(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'long_text' => 'required|string',
        ]);

        Task::updateOrCreate(
            ['date' => $request->date, 'user_id' => Auth::user()->id],
            [
                'date' => $request->input('date'),
                'long_text' => $request->input('long_text'),
                'user_id' => Auth::user()->id,
                'approved_by_hr' => 0, // pending
                'approved_by_team_lead' => 0, // pending
            ]
        );

        flashy()->success('Your Task Message has been saved successfully');
        return redirect()->route('employee.dashboard');
    }
    public function dashboard(Request $request)
    {
        // Retrieve the current user's ID

        $userId = Auth::id();

        // Retrieve the current user object
        $user = Auth::user();
        $userIdString = (string) $userId;
        // Fetch notifications assigned to the current user
        $notifications = Notification::where(function ($query) use ($userIdString) {
            $query->whereJsonContains('users', intval($userIdString))
                ->orWhereJsonContains('users', $userIdString);
        })
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();
        // Get today's date
        $attendanceDate = now()->format('Y-m-d');


        // Check if the current user has attendance record for today
        $existingAttendance = EmployeeAttendance::where('user_id', $userId)
            ->whereDate('attendance_date', $attendanceDate)
            ->first();

        // Retrieve check-in and check-out times if attendance record exists
        $checkInTime = $existingAttendance ? $existingAttendance->check_in : null;
        $checkOutTime = $existingAttendance ? $existingAttendance->check_out : null;

        // Get the current IP address
        $currentIp = $request->ip();

        // Pass data to the dashboard view
        //event(new CheckNotify(['message'=>'hello world.......']));
        $task = Task::where('user_id', $user->id)->latest()->first();

        return view('employee.employee-dashboard', compact('checkInTime', 'checkOutTime', 'currentIp', 'notifications', 'task'));
    }


    public function employeeProfile(Request $request)
    {
        // Retrieve the user's ID from the authenticated user
        $userId = $request->user()->id;

        // Retrieve the user's data based on their ID
        $user = User::findOrFail($userId);

        // Pass the user's data to the view
        //  return view('employee.profile', compact('user'));
        return view('employee.employee-profile', compact('user'));

    }

    public function update(Request $request, User $employee)
    {

        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'whatsapp_number' => 'nullable|string',
            'address' => 'nullable|string',
            'cnic' => 'nullable|string',
            'about' => 'nullable|string',
        ]);

        // Update the employee data using query builder
        $employee->find(auth()->user()->id)->update($validatedData);

        // Flash success message and redirect back
        flashy()->success('Employee data updated successfully.');

        return redirect()->back()->with('success', 'Employee data updated successfully!');
    }

    public function updateLink(Request $request, User $employee)
    {

        // Validate the incoming data
        $validatedData = $request->validate([
            'github' => 'required|string',
            'skype' => 'nullable|string',
            'facebook' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
        ]);

        // Update the employee data using query builder
        $employee->find(auth()->user()->id)->update($validatedData);

        // Flash success message and redirect back
        flashy()->success('Employee Links updated successfully.');

        return redirect()->back()->with('success', 'Employee Link updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:4',
        ]);

        // Retrieve the authenticated user
        $user = auth()->user();

        // Verify if the old password matches the existing password
        if (! Hash::check($validatedData['old_password'], $user->password)) {
            flashy()->error('Old password is incorrect.');

            return redirect()->back()->with('error', 'Old password is incorrect.');
        }

        // Update the password
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        // Flash success message and redirect back
        flashy()->success('Password updated successfully.');

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function updatePicture(Request $request)
    {
        $validatedData = $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:3048', // Adjust the validation rules as needed
        ]);

        // Retrieve the authenticated user
        $user = auth()->user();

        if ($request->hasFile('profile_picture')) {
            // Delete the previous  picture if it exists
            if ($user->picture) {
                Storage::delete('public/'.$user->picture);
            }

            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public'); // Save in the storage/app/public/profile_pictures directory

            $user->picture = $path;
            $user->save();
        }

        flashy()->success('Employee profile updated successfully.');

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }


    // ===================== Employee Performance Controller
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


    //    return view('employee.performance', compact('month', 'lateCheckInCount', 'totalPendingTasks', 'year', 'presentCount', 'absentCount', 'leaveCount', 'workFromHomeCount', 'holidayCount', 'remotelyCount', 'halfLeaves', 'totalExtraHours', 'formattedTotalHours', 'presentDaysCount', 'yearlyLeavesAvailable', 'totalDaysWorked', 'tasksPendingHR', 'tasksApprovedByHR', 'tasksRejectedByHR', 'tasksRevisedByHR', 'tasksPendingTeamLead', 'tasksApprovedByTeamLead', 'tasksRejectedByTeamLead', 'tasksRevisedByTeamLead'));
       return view('employee.employee-performance', compact('month', 'lateCheckInCount', 'totalPendingTasks', 'year', 'presentCount', 'absentCount', 'leaveCount', 'workFromHomeCount', 'holidayCount', 'remotelyCount', 'halfLeaves', 'totalExtraHours', 'formattedTotalHours', 'presentDaysCount', 'yearlyLeavesAvailable', 'totalDaysWorked', 'tasksPendingHR', 'tasksApprovedByHR', 'tasksRejectedByHR', 'tasksRevisedByHR', 'tasksPendingTeamLead', 'tasksApprovedByTeamLead', 'tasksRejectedByTeamLead', 'tasksRevisedByTeamLead'));

    }
    // ===================== Employee Performance Controller  end




    // ================ Attendence Controller
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
        // return view('employee.attendance', compact('monthData', 'year', 'month', 'presentCount', 'absentCount', 'leaveCount', 'workFromHomeCount', 'holidayCount', 'remotelyCount', 'halfLeaves', 'totalExtraHours', 'formattedTotalHours', 'presentDaysCount', 'yearlyLeavesAvailable'));
        return view('employee.employee-attendance', compact('monthData', 'year', 'month', 'presentCount', 'absentCount', 'leaveCount', 'workFromHomeCount', 'holidayCount', 'remotelyCount', 'halfLeaves', 'totalExtraHours', 'formattedTotalHours', 'presentDaysCount', 'yearlyLeavesAvailable'));
    }

    // =============== Attendence Controller End


    // =============== Notification Controller

    public function index()
    {
        $userId = Auth::id();

        // Retrieve the current user object
        $userIdString = (string) $userId;

        // Fetch notifications assigned to the current user
        $notifications = Notification::where(function ($query) use ($userIdString) {
            $query->whereJsonContains('users', intval($userIdString))
                ->orWhereJsonContains('users', $userIdString);
        })
            ->orderBy('created_at', 'desc')
            ->get();

        // return view('employee.notifications', compact('notifications'));
        return view('employee.employee-notifications', compact('notifications'));
    }
    public function showDetails($id)
    {
        // Retrieve the notification details by ID
        $notification = Notification::findOrFail($id);

        // Render the notification details view with the notification data
        // return view('employee.notificationdetails', ['notification' => $notification]);
        return view('employee.employee-notificationDetail', ['notification' => $notification]);
    }

    // =============== Notification Controller end


    // =============== Request Controller
    public function list()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch only the requests belonging to the current user
        $requests = UserRequest::where('user_id', $user->id)->get();

        // return view('employee.request', compact('requests'));
        return view('employee.employee-request', compact('requests'));
    }

    public function requestView($encodedId)
    {
        $id = base64_decode($encodedId);

        // Now you can use the $id as needed
        $request = Request::find($id);
        // return $request;

        return view('employee.employee-request-view', compact('request'));
    }

    // =============== Request Controller end


    // =============== Task Controller
    public function taskList(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        if ($request->has('month')) {
            $date = \Carbon\Carbon::createFromFormat('Y-m', $request->input('month'));
            $query->whereYear('date', $date->year)
                  ->whereMonth('date', $date->month);
        }

        $tasks = $query->orderBy('date', 'desc')->get();
        // return view('employee.tasklist', compact('tasks'));
        return view('employee.employee-tasklist', compact('tasks'));
    }
    // public function scan_qr(Request $request){
    //     // Retrieve the current user's ID

    //     $userId = Auth::id();

    //     // Retrieve the current user object
    //     $user = Auth::user();
    //     $userIdString = (string) $userId;
    //     // Fetch notifications assigned to the current user
    //     $notifications = Notification::where(function ($query) use ($userIdString) {
    //         $query->whereJsonContains('users', intval($userIdString))
    //             ->orWhereJsonContains('users', $userIdString);
    //     })
    //         ->orderBy('updated_at', 'desc')
    //         ->take(5)
    //         ->get();
    //     // Get today's date
    //     $attendanceDate = now()->format('Y-m-d');
    //     if (Setting::where('name', 'qr_code')->whereDate('updated_at', $attendanceDate)->count() == 0) {
    //         Setting::updateOrCreate(
    //             ['name' => 'qr_code'],

    //             [
    //                 'value' => 'https://www.medtronix.world?dump='.md5('medtronix').'&timestamp='.md5(Carbon::now()),

    //             ]);
    //     }

    //     // Check if the current user has attendance record for today
    //     $existingAttendance = EmployeeAttendance::where('user_id', $userId)
    //         ->whereDate('attendance_date', $attendanceDate)
    //         ->first();

    //     // Retrieve check-in and check-out times if attendance record exists
    //     $checkInTime = $existingAttendance ? $existingAttendance->check_in : null;
    //     $checkOutTime = $existingAttendance ? $existingAttendance->check_out : null;

    //     // Get the current IP address
    //     $currentIp = $request->ip();

    //     // Pass data to the dashboard view
    //     //event(new CheckNotify(['message'=>'hello world.......']));
    //     $task = Task::where('user_id', $user->id)->latest()->first();
    //     return view('employee.employee-scan-qr', compact('checkInTime', 'checkOutTime', 'currentIp', 'notifications', 'task'));

    // }
    // =============== Task Controller end


    // =============== Team Controller


    public function myteam()
{

    $teamId=auth()->user()->team_id;
    $members=[];
    $teamCheck=false;
    $teamLead=$myTeamName=null;
    if($teamId!=null){
        $teamCheck=true;
         $team=Team::find($teamId);
        if($team){
             $teamLead=($team->teamLead!=null)?$team->teamLead->name:"Not Set";
            $members=User::where('team_id', $teamId)->get();
         $myTeamName=$team->name;
        }else{
            $teamCheck=false;
        }


    }
    // return view('employee.team', ['teamCheck'=>$teamCheck,'members'=>$members,'myTeamName'=>$myTeamName,'teamLead'=>$teamLead]);
    return view('employee.employee-team', ['teamCheck'=>$teamCheck,'members'=>$members,'myTeamName'=>$myTeamName,'teamLead'=>$teamLead]);
}

 // =============== Team Controller End


 public function store(HttpRequest $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        $user_id = Auth::id(); // Get the authenticated user's ID
        UserRequest::create([
            'user_id' => $user_id, // Store the user's ID along with the request
            'title' => $request->title,
            'details' => $request->details,
        ]);

        flashy()->success('✅Employee Request added successfully');
        return redirect()->route('mobile.request');
    }
}
