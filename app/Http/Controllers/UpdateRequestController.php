<?php

namespace App\Http\Controllers;
use App\Models\Request as UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class UpdateRequestController extends Controller
{
    public function requestView($encodedId)
    {
        $id = base64_decode($encodedId);

        // Now you can use the $id as needed
        $request = Request::find($id);
        // return $request;

        return view('employee.employee-request-view', compact('request'));
    }
}
