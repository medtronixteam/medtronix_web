<?php

// app/Http/Controllers/RequestController.php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Request as UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    public function list()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch only the requests belonging to the current user
        $requests = UserRequest::where('user_id', $user->id)->get();

        return view('employeeui.request', compact('requests'));
    }

    public function requestView($encodedId)
    {
        $id = base64_decode($encodedId);

        // Now you can use the $id as needed
        $request = Request::find($id);
        // return $request;

        return view('employeeui.request-view', compact('request'));
    }


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
        return redirect()->route('employee.request');
    }

    public function adminlist()
    {
        $requests = UserRequest::orderBy('id', 'desc')->get();
        return view('admin.request.list', compact('requests'));
    }
    public function jobRequest()
    {
        $requests = JobApplication::latest()->get();
        return view('admin.request.job_requests', compact('requests'));
    }

    public function show($id)
    {
        $request = UserRequest::findOrFail($id);
        return view('admin.request.view', compact('request'));
    }

    public function approve($id)
    {
        $request = UserRequest::findOrFail($id);
        $request->status = 'approved';
        $request->save();
        flashy()->success('Request Approved successfully');
        return redirect()->back()->with('success', 'Request has been approved.');
    }

    public function reject($id)
    {
        $request = UserRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();
        flashy()->success('Request Rejected successfully');
        return redirect()->back()->with('success', 'Request has been rejected.');
    }
}
