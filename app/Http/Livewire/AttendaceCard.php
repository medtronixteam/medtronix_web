<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\Auth;


class AttendaceCard extends Component
{
    public $time;
    public $attendance_date;

    public function mount()
    {
        $this->attendance_date = now()->format('Y-m-d');
    }

  public function updateCheckin()
    {
        $userId = Auth::id();

        EmployeeAttendance::create([
            'attendance_date' => now()->format('Y-m-d'),
            'check_in' => now(),
            'user_id' => $userId,
        ]);

        $this->emit('attendanceUpdated');
    }

    public function updateCheckout()
    {
        $userId = Auth::id();

        $attendance = EmployeeAttendance::where('attendance_date', now()->format('Y-m-d'))
                                        ->where('user_id', $userId)
                                        ->latest()
                                        ->first();

        if ($attendance) {
            $attendance->update(['check_out' => now()]);
        } else {
            EmployeeAttendance::create([
                'attendance_date' => now()->format('Y-m-d'),
                'check_out' => now(),
                'user_id' => $userId,
            ]);
        }

        $this->emit('attendanceUpdated');
    }

    public function render()
    {
        return view('livewire.attendace-card');
    }
    public function updateAttendance() {
        $attendance = EmployeeAttendance::where('attendance_date',  );
        if ($attendance->count() == 0) {
            foreach ($request->input('status') as $key => $value) {
                EmployeeAttendance::create([
                    'attendance_date' => $request->input('attendance_date'),
                    'status' => $request->status[$key],
                    'check_in' => $request->check_in[$key],
                    'check_out' => $request->check_out[$key],
                    'user_id' => $request->user_id[$key],
                    'remarks' => $request->remarks[$key],
                    'extra_hours' => $request->extra_hours[$key],
                ]);
            }

            $response = ['message' => 'Attendance Has been Created', 'status' => 'success'];

        } else {
            $attendance->delete();
            foreach ($request->input('status') as $key => $value) {
                EmployeeAttendance::create([
                    'attendance_date' => $request->input('attendance_date'),
                    'status' => $request->status[$key],
                    'check_in' => $request->check_in[$key],
                    'check_out' => $request->check_out[$key],
                    'user_id' => $request->user_id[$key],
                    'remarks' => $request->remarks[$key],
                    'extra_hours' => $request->extra_hours[$key],
                ]);
            }
            $response = ['message' => 'Attendance Has been Updated', 'status' => 'success'];
        }
        return response()->json($response);

    }
}
