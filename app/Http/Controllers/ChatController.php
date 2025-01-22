<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    // ChatController.php

    public function fetchMessages(Request $request)
    {
        $email = $request->session()->get('user_email');

        if (!$email) {
            return response()->json(['message' => 'Email not found in session', 'status' => 'error', 'code' => 400]);
        }

        $messages = ChatMessage::where('email', $email)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }




    // function index()
    // {
    //     $chatUsersList = ChatMessage::select('email')->latest()->distinct()->get();
    //     return view('admin.chatHistory2', compact('chatUsersList'));
    // }
    // public function index()
    // {
    //     $chatUsersList = ChatMessage::select('email', 'name', \DB::raw('MAX(created_at) as created_at'))
    //                                 ->groupBy('email', 'name')
    //                                 ->orderBy('created_at', 'desc')
    //                                 ->get();
    //     return view('admin.chatHistory', compact('chatUsersList'));
    // }






    function receive(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            $response = ['message' => reset($messages)[0], 'status' => 'error', 'code' => 500];
        } else {
            $ChatMessage = ChatMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'is_admin' => 0,
            ]);
            $request->session()->put('user_email', $request->email);

            $response = ['message' => "Message sent successfully", 'status' => 'success', 'code' => 200];
        }
        return response()->json($response);
    }

    function messagesReplay(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            $response = ['message' => reset($messages)[0], 'status' => 'error', 'code' => 500];
        } else {
            $ChatMessage = ChatMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'is_admin' => 1,
            ]);

            $response = ['message' => "Message sent successfully", 'status' => 'success', 'code' => 200];
        }
        return response()->json($response);
    }

    function messagesList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            $response = ['message' => reset($messages)[0], 'status' => 'error', 'code' => 500];
        } else {
            $ChatMessage = ChatMessage::select('id', 'email', 'name', 'message', 'is_admin', 'created_at')
                ->where('email', $request->email)->latest()->get();
            $response = ['message' => $ChatMessage, 'status' => 'success', 'code' => 200];
        }
        return response()->json($response);
    }
}
