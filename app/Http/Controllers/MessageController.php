<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{


    public function storeMessage(Request $request)
    {
        // Validate incoming request data if needed
        $validator = validator($request->all(), [
            'name' => 'required|string',
            'company' => 'required|string',
            'email' => 'required|email',
            'phone_no' => 'required|string',
            'message' => 'required|string|min:10,max:255',
        ]);

        if ($validator->fails()) {

            return response()->json(['message' =>$validator->messages()->first(), 'status' => 'error']);
        }

        // Create a new message using the model
        $message = Message::create([
            'name' => $request->input('name'),
            'company' => $request->input('company'),
            'email' => $request->input('email'),
            'phone_no' => $request->input('phone_no'),
            'message' => $request->input('message'),
        ]);

        // Return a success response
        return response()->json(
            [
                'message' => 'Message sent successfully',
                'status' => 'success'
            ]
        );
    }
    public function showMessage()
    {
        $messages = Message::latest()->get();
        return view('user-message.all-messages', compact('messages'));
    }
}
