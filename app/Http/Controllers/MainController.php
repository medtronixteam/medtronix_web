<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Project;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MainController extends Controller
{
    public function home()
    {
        $projects = Project::limit(3)->get();
        $reviews = Review::all();

        return view('frontend.index', compact('projects', 'reviews'));
    }
    public function applyNow()
    {

        return view('frontend.apply-now');
    }

    public function ui()
    {
        return view('layouts.ui');
    }

    public function more_project()
    {
        $projects = Project::all();

        return view('frontend.more_project', compact('projects'));
    }

    public function project_detail($id)
    {
        $detail = Project::find($id);

        return view('frontend.project_detail', compact('detail'));
    }

    public function about_us()
    {
        return view('frontend.about-us');
    }

    public function courses()
    {
        return view('frontend.courses');
    }

    public function portfolio()
    {
        $projects = Project::limit(3)->get();

        return view('frontend.portfolio', compact('projects'));
    }

    public function contact_us()
    {
        return view('frontend.contact');
    }

    public function message_save(Request $request)
    {
        $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'company'=>'-',
            'phone_no'=>'0',
        ]);

        return back()->with('success', 'Message has been Sent');
    }

    public function web_development()
    {
        return view('frontend.services.web-development');
    }
    public function artificial_intelligence()
    {
        return view('frontend.services.artificial-intelligence');
    }
    public function app_development()
    {
        return view('frontend.services.app-development');
    }
    public function ui_ux_design()
    {
        return view('frontend.services.ui-ux-design');
    }
    public function desktop_app()
    {
        return view('frontend.services.desktop-app');
    }
    public function courses_web_development()
    {
        return view('frontend.courses.web-dev');
    }
    public function course_app_development()
    {
        return view('frontend.courses.app-development');
    }
    public function python()
    {
        return view('frontend.courses.python');
    }
    public function wordpress()
    {
        return view('frontend.courses.wordpress');
    }
    public function seo()
    {
        return view('frontend.courses.seo');
    }
    public function course_ui_ux_design()
    {
        return view('frontend.courses.ui-ux');
    }
    public function graphics()
    {
        return view('frontend.courses.graphics');
    }
    public function freelancing()
    {
        return view('frontend.courses.freelancing');
    }
    public function message_view($id)
    {
        $view = Message::find($id);
        return view('user-message.message-view',compact('view'));
    }
    public function message_delete($id)
    {
        $delete = Message::find($id)->delete();
        return redirect()->back();
    }
    public function email_attendence(){
        return view('emails.attendance');
    }
}
