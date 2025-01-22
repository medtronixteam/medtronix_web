<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\ChatMessage;

class ChatMessageController extends Controller
{
    function receive(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            $response = [
                'message' => reset($messages)[0],
                'status' => 'error', 'code' => 500
            ];
        } else {
            $ChatMessage = ChatMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'is_admin' => 0,
            ]);

            $response = [
                'message' => "Message sent successfully",
                'status' => 'success', 'code' => 200
            ];
        }
        return response($response, $response['code']);
    }
    function messagesList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            $response = [
                'message' => reset($messages)[0],
                'status' => 'error', 'code' => 500
            ];
        } else {
            $ChatMessage = ChatMessage::select('email', 'name', 'message', 'created_at')->where('is_admin',1)->where('email', $request->email)->where('name', $request->name)->latest()->get();
            $response = [
                'message' => $ChatMessage,
                'status' => 'success', 'code' => 200
            ];
        }
        return response($response, $response['code']);
    }
}
