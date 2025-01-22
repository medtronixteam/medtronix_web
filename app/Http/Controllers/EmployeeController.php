<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Events\CheckNotify;
use App\Models\Setting;

class EmployeeController extends Controller
{
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
        if(Setting::where('name','qr_code')->whereDate('updated_at',$attendanceDate)->count()==0){
            Setting::updateOrCreate(
                ['name' => 'qr_code'],

                [
                    'value' =>"https://www.medtronix.world?dump=".md5('medtronix')."&timestamp=". md5(Carbon::now()),

                ] );
        }



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
    return view('employeeui.dashboard', compact('checkInTime', 'checkOutTime', 'currentIp', 'notifications','task'));
}

public function employeeProfile(Request $request){
     // Retrieve the user's ID from the authenticated user
     $userId = $request->user()->id;

     // Retrieve the user's data based on their ID
     $user = User::findOrFail($userId);

     // Pass the user's data to the view
     return view('employeeui.profile', compact('user'));

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
    if (!Hash::check($validatedData['old_password'], $user->password)) {
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

public function updatePicture(Request $request){
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




}
