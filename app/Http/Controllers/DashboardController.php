<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Message;
use App\Models\Waitlist;
use App\Models\Project;
use App\Models\Request as UserRequest;
use App\Models\SalarySlip;
use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard()
    {
        $role = auth()->user()->role;

        if ($role == "employee" || $role == "team_lead") { if(Cookie::has('screen_width') && Cookie::get('screen_width')=="mobile"){
            return redirect()->route('mobile.dashboard');
        }
            return redirect()->route('employee.dashboard');
        } elseif ($role == "finance" || $role == "social_manager" || $role == "seo") {
            if(Cookie::has('screen_width') && Cookie::get('screen_width')=="mobile"){
                return redirect()->route('mobile.dashboard');
            }
            return redirect()->route('employee.dashboard');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }


    public function adminDashboard()
    {
        $today = Carbon::today();

        $currentMonth = now()->month;

        $upcomingEvents = User::where('role', 'employee')
            ->where(function ($query) use ($currentMonth) {
                $query->whereMonth('dob', $currentMonth)
                    ->orWhereMonth('doj', $currentMonth);
            })
            ->get();

        $totalEmployee = User::whereNot('role', 'admin')->count();
        $message = Message::all()->count();
        $wait = Waitlist::all()->count();

        $presentAttendanceCount = EmployeeAttendance::whereDate('attendance_date', $today)
            ->where('status', 'present')
            ->count();
        $absentAttendanceCount = EmployeeAttendance::whereDate('attendance_date', $today)
            ->where('status', 'absent')
            ->count();
        $totalRequest = UserRequest::whereDate('created_at', $today)->count();

        $todayPendingTaskCount = Task::where(function ($query) {
            $query->where('approved_by_hr', 0)
                ->orWhere('approved_by_team_lead', 0);
        })
            ->whereDate('created_at', $today)
            ->count();
            $todayAppointment = Appointment::whereDate('created_at', $today)->count();


        $notifications = Notification::whereDate('type_of', 'system')->limit(5)->latest()->get();
        return view('admin.dashboard', compact('upcomingEvents', 'totalEmployee','message','wait', 'presentAttendanceCount', 'absentAttendanceCount', 'notifications', 'totalRequest', 'todayPendingTaskCount','todayAppointment'));
    }
    public function home()
    {
        $projects = Project::all();
        $employees = User::all();
        return view("index", compact("projects", "employees"));
    }
    public function user()
    {
        $user = Auth::user(); // Retrieve the authenticated user

        return view('profile.index', ['user' => $user]);
    }



    public function profile_settings()
    {
        $user = Auth::user(); // Retrieve the Authenticated user
        // return $user;
        return view('profile.settings', ['user' => $user])->with('success', 'User data updated successfully');
    }

    public function create()
    {
        return view('employees.create');
    }

    public function index()
    {
        $employees = User::whereNot('role', 'admin')->where('is_disabled', 'no')->get();


        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->year;

        foreach ($employees as $employee) {
            $existingSalarySlip = SalarySlip::where('employee_id', $employee->id)
                ->where('salary_month', $currentMonth)
                ->where('salary_year', $currentYear)
                ->exists();

            // Add  new field 'has_salary_slip' to each employee
            $employee->has_salary_slip = $existingSalarySlip;
        }
        return view('employees.index', compact('employees'));
    }

    public function employee_website_list()
    {
        $employees = User::where('role', 'employee')->get();
        return view('employees.show-in-website', compact('employees'));
    }
    public function update_employee_website(Request $request)
    {
        $member = User::find($request->member_id);
        $member->show_in_website = $request->ShowInWebsite;
        $member->save();
    }
    public function employee_attendence_list()
    {
        $employees = User::where('role', 'employee')->get();
        return view('employees.show-in-attendence', compact('employees'));
    }

    public function update_employee_attendence(Request $request)
    {
        $member = User::find($request->member_id);
        $member->show_in_attendence = $request->ShowInAttendence;
        $member->save();
    }

    public function show($id)
    {
        $user = User::find($id);

        // Check if the user exists then
        if ($user) {

            $requests = UserRequest::orderBy('id', 'desc')->where('user_id', $user->id)->latest()->get();

            return view('profile.index', compact('user','requests'));
        } else {
            return redirect()->route('employees.index')->with('error', 'User not found');
        }
    }
    // public function profilelist()
    // {
    //     $requests = UserRequest::orderBy('id', 'desc')->where('user_id', $user->id)->sortByDesc('created_at')->get();
    //     $user = auth()->user();
    //     return view('profile.index', compact('requests', 'User'));
    // }


    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|unique:users',
            'address' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about' => 'nullable|string',
            'user_skills' => 'nullable|string',
            'designation' => 'nullable|string',
            'dob' => 'nullable|date',
            'doj' => 'nullable|date',
            'github' => 'nullable|string',
            'skype' => 'nullable|string',
            'facebook' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
            'whatsapp_number' => 'nullable|string',
            'cnic' => 'nullable|string',
            'order' => 'nullable',
            'basic_salary' => 'nullable|integer',
            'current_salary' => 'nullable|integer',
            'show_in_attendence' => 'required',
            'show_in_website' => 'required',
            'ip_required' => 'required',
            'role' => 'required',
            'password' => 'required',


        ]);

        $validatedData['password'] = Hash::make($request->password);



        // Handle the profile picture
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picturePath = $picture->store('profile_pictures', 'public'); // Store the image in the 'public' disk
            $validatedData['picture'] = $picturePath;
        }

        // return $validatedData;

        // Create and save the employee
        $employee = User::create($validatedData);

        flashy()->success('Employee Created Successfully', '#');
        // Redirect or return a response
        return redirect()->route('employees.create')->with('success', 'Employee created successfully!');
    }

    public function edit(User $employee)
    {
        $user = $employee;
        return view('employees.edit', compact('user'));
    }

    public function update(Request $request, User $employee)
    {
        // Validate the input data
        //  $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users',
        //     'phone' => 'required|string|unique:users',
        //     'whatsapp_number' => 'nullable|string',
        //     'address' => 'nullable|string',
        //     'cnic' => 'nullable|string',
        //     'about' => 'nullable|string',
        //     'user_skills' => 'nullable|string',
        // ]);

        if (!$employee) {
            flashy()->error('Employee  not found', '#');
            return redirect()->back()->with('error', 'Employee not found');
        }

        $attributes = $request->only(['name', 'email','phone', 'whatsapp_number', 'address', 'cnic', 'about', 'user_skills', 'order', 'designation', 'dob', 'doj', 'basic_salary', 'current_salary', 'show_in_attendence', 'show_in_website', 'role', 'ip_required']); // Add other fields as needed

        $employee->update($attributes);
        flashy()->success('Employee Data updated SuccessFully !', '#');
        return redirect()->back()->with('success', 'Data updated successfully!');
    }

    public function updateProfilePicture(Request $request, User $employee)
    {
        $validatedData = $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete the previous profile picture if it exists
            if ($employee->picture) {
                Storage::delete('public/' . $employee->picture);
            }

            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public'); // Save in the storage/app/public/profile_pictures directory

            $employee->picture = $path;
            $employee->save();
        }


        flashy()->success('Employee profile updated SuccessFully !', '#');
        return redirect()->back()->with('success', 'Data updated successfully!');
        // return redirect()->route('employees.index')->with('success', 'Data updated successfully!');
    }




    public function destroy(User $employee)
    {
        $employee->delete();
        SalarySlip::where('employee_id', $employee->id)->delete();

        flashy()->mutedDark('❌ Data Deleted SuccessFully !', '#');
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully!');
    }


    public function profile_settings_picture(Request $request)
    {
        $employee = Auth::user();

        $validatedData = $request->validate([
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        if ($request->hasFile('picture')) {
            // Delete the previous profile picture if it exists
            if ($employee->picture) {
                Storage::delete('public/' . $employee->picture);
            }

            $file = $request->file('picture');
            $path = $file->store('profile_pictures', 'public'); // Save in the storage/app/public/profile_pictures directory

            $employee->picture = $path;
            $employee->save();
        }


        flashy()->primary('😎 Data updated successfully!', '#');
        return redirect()->back()->with('success', 'Data updated successfully!');
    }

    public function profile_settings_info(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'user_skills' => $request->input('user_skills'),
            'about' => $request->input('about'),
            'designation' => $request->input('designation'),
        ]);

        flashy()->success('😎 Data updated SuccessFully !', '#');
        return redirect()->route('profile.settings')->with('success', 'User data updated successfully');
    }

    public function profile_settings_links(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'github' => $request->input('github'),
            'skype' => $request->input('skype'),
            'instagram' => $request->input('instagram'),
            'facebook' => $request->input('facebook'),
            'linkedin' => $request->input('linkedin'),
            'twitter' => $request->input('twitter'),
        ]);

        flashy()->success('Social Links updated SuccessFully !', '#');
        return redirect()->route('profile.settings')->with('success', 'User data updated successfully');
    }
    public function emp_reset_password(Request $request)
    {



        $validatedData = $request->validate([
            "password" => ['required', 'min:3'],
        ]);

        if ($validatedData) {
            if ($request->password == $request->password_confirm) {
                $User = User::find($request->employee_id);

                if ($User) {

                    $User->update(['password' => Hash::make($validatedData["password"])]);
                    flashy()->success('Password has been Updated!', '#');
                } else {

                    flashy()->error('Invalid User Id', '#');
                }
                return back()->with('error', 'Password has been not Updated!');
            } else {
                flashy()->info('Password is not matching with confirm password', '#');
                return back()->with('error', 'Password is not matching with confirm password');
            }
        }
        flashy()->error('Password has been not Updated!', '#');
        return back()->with('error', 'Password has been not Updated!');
    }


    public function toggleEmployee(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Toggle the user's status
        $user->is_disabled = $request->action === 'disable' ? 'yes' : 'no';
        $user->save();

        $message = $request->action === 'disable' ? 'Employee disabled successfully' : 'Employee enabled successfully';
        flashy()->success($message);

        return redirect()->back();
    }
    public function disableduser()
    {
        $employees = User::whereNot('role', 'admin')->get();
        return view('employees.disable-user', ['employees' => $employees]);
    }

}
