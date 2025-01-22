<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

use App\Models\user;
use App\Models\OfficeTime;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class NotificationController extends Controller
{

    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        return view('notification.show', compact('notification'));
    }


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

        return view('employeeui.notifications', compact('notifications'));
    }


    public function list()
    {
        $notifications = Notification::latest()->get();
        return view('notification.all_lists', compact('notifications'));
    }
    public function manage()
    {
        $users = User::whereNot('role', 'admin')->get();
        return view('notification.manage', compact('users'));
    }



    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'heading' => 'required|string',
                'description' => 'required|string',
                'date' => 'required|date',
            ]);
            $users = User::where('role', 'employee')->pluck('id')->toArray();
            // Check if "All Employees" is selected
            if ($request->has('all_employee')) {
                $selectedUsers = $users;
            } else {
                $request->validate([
                    'users' => 'required|array', // Ensure users is an array if it exists
                ]);
                $users = $request->input('users');
            }

            $userIds = json_encode($users);

            // Create a new Notification instance
            $notification = new Notification([
                'heading' => $request->input('heading'),
                'description' => $request->input('description'),
                'date' => $request->input('date'),
                'type_of' => $request->input('type_of'),
                'label' => $request->input('label'),

                'users' => $userIds // Store user IDs as JSON string
            ]);

            // Save the notification to the database
            $notification->save();

            flashy()->success('Notification Created Successfully');

            // Redirect back with success message
            return redirect()->route('notifications.manage')->with('success', 'Notification added successfully.');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error creating notification: ' . $e->getMessage());

            // Flash an error message
            flashy()->error('An error occurred while creating the notification. Please try again.');

            // Redirect back to the form with old input
            return redirect()->back()->withInput();
        }
    }


    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        $users = User::where('role', 'employee')->get(); // Fetch only employees

        // Decode the JSON string from the users attribute
        $notificationUsers = json_decode($notification->users, true);

        // Check if users are associated with the notification
        $selectedUsers = $notificationUsers ? $notificationUsers : [];

        // Check if all users are selected
        $selectAllUsers = ($notification->show_to === 'all');

        return view('notification.edit', compact('notification', 'users', 'selectedUsers', 'selectAllUsers'));
    }

    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'users' => 'required|array', // Ensure users is an array
        ]);

        // Check if "All Employees" is selected
        if ($request->has('all_employee')) {
            // Fetch only employees
            $employees = User::where('role', 'employee')->pluck('id')->toArray();
            $selectedUsers = $employees; // All employees are selected
        } else {
            // Only selected users are chosen
            $selectedUsers = $request->users;
        }

        // Check if no users are selected
        if (empty($selectedUsers)) {
            flashy()->error('Please select at least one user.');
            return redirect()->back()->withInput();
        }

        try {
            // Update the notification's data
            $notification->update([
                'heading' => $request->heading,
                'description' => $request->description,
                'date' => $request->date,
                'users' => json_encode($selectedUsers), // Store selected users
            ]);

            flashy()->success('Notification Updated Successfully');

            return redirect()->route('notifications.list')->with('success', 'Notification updated successfully.');
        } catch (\Throwable $e) {
            // Log the error
            \Log::error('Error updating notification: ' . $e->getMessage());

            // Flash an error message
            flashy()->error('An error occurred while updating the notification. Please try again.');

            // Redirect back to the edit form with old input and errors
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while updating the notification. Please try again.']);
        }
    }





    public function destroy(Notification $notification)
    {
        $notification->delete();
        flashy()->success('Notification deleted Successfully');
        return redirect()->route('notifications.list')->with('success', 'Notification deleted successfully.');
    }


    public function showDashboard()
    {

        $notifications = Notification::orderBy('created_at', 'desc')->get();

        // Pass notifications data to the view
        return view('employee.dashboard', ['notifications' => $notifications]);
    }
    public function showDetails($id)
    {
        // Retrieve the notification details by ID
        $notification = Notification::findOrFail($id);

        // Render the notification details view with the notification data
        return view('employeeui.notificationdetails', ['notification' => $notification]);
    }


    public static function pushNotification($reason, $users)
    {
        if ($reason == "checkinLate") {
            $currentDate = Carbon::now();

            $officeTime = OfficeTime::first();
            $heading = "Mr/Ms " . auth()->user()->name . " You Marked the checking in Late";
            $presentCount = EmployeeAttendance::where('user_id', $users[0])
                ->whereYear('attendance_date',  $currentDate->format('Y'))
                ->whereMonth('attendance_date', $currentDate->format('m'))
                ->where('status', 'present')
                ->whereTime('check_in', '>', $officeTime->max_reporting_time)
                ->count();
            $description = "You marked the Attendance Late for " . $presentCount+1 . " days. Please check in on time. Otherwise your attendance will be marked as Absent or it may cause deduction of your salary . Thank you.";
            $type_of = "system";
            $label = "warning";
        }
        Notification::create([
            'heading' => $heading,
            'description' => $description,
            'date' => now(),
            'users' => json_encode($users),
            'type_of' => $type_of,
            'label' => $label,

        ]);
    }
}
