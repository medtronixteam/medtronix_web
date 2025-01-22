<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
        public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'long_text' => 'required|string',
        ]);

        Task::updateOrCreate(
            ['date' => $request->date, 'user_id' => Auth::user()->id],
            [
                'date' => $request->input('date'),
                'long_text' => $request->input('long_text'),
                'user_id' => Auth::user()->id,
                'approved_by_hr' => 0, // pending
                'approved_by_team_lead' => 0, // pending
            ]
        );

        flashy()->success('Your Task Message has been saved successfully');
        return redirect()->route('mobile.dashboard');
    }

    public function fetch_task_data(Request $request)
    {
        $task = Task::where('user_id', Auth::user()->id)->where('date', $request->taskDate)->first();

    // If there's no task for the given date, return an empty string
    $text = $task ? $task->long_text : '';

    return response()->json(['text' => $text]);
    }

    public function approveHR(Request $request, Task $task)
    {
        $request->validate([
            'approved_by_hr' => 'required|integer|in:0,1,2,3',
        ]);

        $task->update([
            'approved_by_hr' => $request->input('approved_by_hr'),
        ]);

        flashy()->success('HR approval status updated successfully');
        return redirect()->back();
    }

    public function approveTeamLeadRemarks(Request $request, Task $task)
    {
        $request->validate([
            'approved_by_team_lead' => 'required|integer|in:0,1,2,3',
            'remarks' => 'required|string',
            'percentage_completed' => 'required|integer|min:0|max:100',
        ]);

        $task->update([
            'approved_by_team_lead' => $request->input('approved_by_team_lead'),
            'remarks' => $request->input('remarks'),
            'percentage_completed' => $request->input('percentage_completed'),
        ]);

        flashy()->success('Team Lead approval status and remarks updated successfully');
        return redirect()->back();
    }

    public function work_history(Request $request)
    {
        $query = Task::orderBy('created_at', 'desc');

        if ($request->has('date')) {
            $date = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('date'));
           $query->whereDate('date', $date);
        }else{
           $query->whereDate('date', now()->format('Y-m-d'));
        }

        $tasks = $query->get();
        return view('work-history.index', compact('tasks'));
    }

     public function work_detail(Request $request, $id)
    {
        $workDetail = Task::where('user_id', $id);
        $teamLeader=Team::where('team_lead_id',auth()->id())->count();
        $showApproveBtn=$teamLeader==0?false:true;
        // if(!$showApproveBtn){
        //     flashy()->warning("Don't clever...You don't have team lead access");
        //     return redirect()->route('employee.team');
        // }

        if ($request->has('month')) {
            $month = \Carbon\Carbon::createFromFormat('Y-m', $request->input('month'));
            $workDetail = $workDetail->whereMonth('date', $month);
        }else{
            $workDetail = $workDetail->whereMonth('date', now()->format('Y-m'));
        }

        $workDetail = $workDetail->get();

        return view('work-history.work-detail', compact('workDetail', 'showApproveBtn'));
    }


    public function taskList(Request $request)
    {
        $query = Task::where('user_id', auth()->id());

        if ($request->has('month')) {
            $date = \Carbon\Carbon::createFromFormat('Y-m', $request->input('month'));
            $query->whereYear('date', $date->year)
                  ->whereMonth('date', $date->month);
        }

        $tasks = $query->orderBy('date', 'desc')->get();
        return view('employeeui.tasklist', compact('tasks'));
    }


}
