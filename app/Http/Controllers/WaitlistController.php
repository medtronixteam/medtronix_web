<?php

namespace App\Http\Controllers;

use App\Mail\WaitRegisterMail;
use App\Mail\WaitAlertMail;
use App\Models\Waitlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Validator;

class WaitlistController extends Controller
{
    public function list()
    {

        $waitlist = Waitlist::latest()->get();
        $response = ['status' => "success", 'code' => 200, 'data' => $waitlist];
        return response($response, $response['code']);
    }
    public function webList()
    {

        $waitlist = Waitlist::latest()->get();
        return view('waitlist.list', compact('waitlist'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'country' => 'required',
            'company_name' => 'required|max:50',
            'industry' => 'required|max:50',
        ]);
        if ($validator->fails()) {

           $message = $validator->messages()->first();
            $response = [
                'message' => $message, 'status' => 'error', 'code' => 500,
            ];
        } else {
            if (Waitlist::where('email', $request->email)->count() > 0) {
                $response = [
                    'message' => 'You email already registeed in waitlist',
                    'status' => 'error',
                    'code' => 200,
                ];
                return response($response, $response['code']);
            }

            $dataToSave=[
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
                'country' => $request->country,
                'company_name' => $request->company_name,
                'industry' => $request->industry,
            ];
           // Mail::mailer('secondary')->to($request->email)->send(new WaitRegisterMail($request->name));

        //    Mail::to("arslan50050@gmail.com")->send(new WaitAlertMail($dataToSave));
          //  Mail::to("medtronix123@gmail.com")->send(new WaitAlertMail($dataToSave));
            Waitlist::create($dataToSave);


            $response = [
                'message' => 'Great ! You have been registered in waitlist',
                'status' => 'success',
                'code' => 200,
            ];
        }
        return response($response, $response['code']);

    }
}
