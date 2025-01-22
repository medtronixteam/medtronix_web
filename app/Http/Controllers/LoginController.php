<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function index()
{
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
}

public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Check if a user is already logged in from this device (optional logic)
    // $existingUser = User::where('device_id', $request->header('User-Agent'))->first();
    // if ($existingUser) {
    //     flashy()->error('Another user is already logged in from this device.', '#');
    //     return redirect()->route('login')->with('error', 'Another user is already logged in from this device.');
    // }

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        if ($user->is_disabled === 'yes') {
            flashy()->error('Your account is disabled. Please contact support for assistance.');
            Auth::logout(); // Logout the user
            return redirect()->route('login');
        }

        $request->session()->regenerate();
        flashy()->success('Login Successfully ...', '#');


        $screenWidth = (int)$request->screen_width;
        if ($screenWidth && $screenWidth > 768) {

            Cookie::queue('screen_width', 'desktop', 60 * 24 * 30);
            return redirect()->route('employee.dashboard');
        } else {     Cookie::queue('screen_width', 'mobile', 60 * 24 * 30);
            return redirect()->route('mobile.dashboard');
        }
    }

    flashy()->error('Invalid Username or Password ', '#');
    return redirect()->route('login')->with('error', 'Invalid Email or Password!');
}




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been log out!');
    }
    public function resetPassword($key)
    {
        return view('reset-password', ['key' => $key]);
    }
    public function resetPasswordCh(Request $request)
    {


        $validatedData = $request->validate([
            "password" => ['required', 'confirmed', 'min:3'],
        ]);

        if ($validatedData) {
            $User = User::find(auth()->id());

            if ($User) {

                $User->update(['password' => Hash::make($validatedData["password"])]);
                flashy()->success('Password has been Updated!', '#');
            } else {

                flashy()->error('Invalid User Id', '#');

            }
            return back()->with('error', 'Password has been not Updated!');
        }
        flashy()->error('Password has been not Updated!', '#');
        return back()->with('error', 'Password has been not Updated!');
    }


}
// $screenWidth = $request->cookie('screen_width');

// if ($screenWidth && $screenWidth > 768) {
//     return redirect()->route('employee.dashboard');
// } else {
//     return redirect()->route('mobile.dashboard');
// }
