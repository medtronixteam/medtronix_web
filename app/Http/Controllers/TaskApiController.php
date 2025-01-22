<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as UserRequest;

class TaskApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'long_text' => 'required|string',
        ]);

        $user = auth('sanctum')->user();

        Task::updateOrCreate(
            [
                'date' => $request->input('date'),
                'user_id' => $user->id
            ],
            [
                'long_text' => $request->input('long_text'),
                'approved_by_hr' => 0, // pending
                'approved_by_team_lead' => 0, // pending
            ]
        );

        return response()->json(['message' => 'Your Task Message has been saved successfully', 'status' => 'success'],200);
    }
    public function storeRequest(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string',
        ]);

        $user = auth('sanctum')->user(); // Get the authenticated user's ID
        UserRequest::create([
            'user_id' => $user->id, // Store the user's ID along with the request
            'title' => $request->title,
            'details' => $request->details,
        ]);

        return response()->json(['message' => 'Employee Request added successfully', 'status' => 'success'],200);
    }

    public function list()
    {
        // Get the authenticated user using Sanctum
        $user = auth('sanctum')->user();

        // Fetch only the requests belonging to the current user
        $requests = UserRequest::where('user_id', $user->id)->get();

        // Return the requests as a JSON response
        return response()->json(['requests' => $requests], 200);
    }
}
