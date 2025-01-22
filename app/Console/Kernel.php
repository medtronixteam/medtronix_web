<?php

namespace App\Console;

use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Mail\CheckInMail;
use App\Mail\CheckOutMail;
use App\Mail\Attendance;
use Illuminate\Support\Facades\Log;


use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->call(function () {
         //   $Users=User::where('id',17)->where('show_in_attendence',1)->get();
            $Users=User::whereNot('role','admin')->where('show_in_attendence',1)->get();
            foreach ($Users as $key => $user) {
               $counter=EmployeeAttendance::where('user_id',$user->id)->where('attendance_date',date('Y-m-d'))->count();
               if($counter==0){
                $data=['name'=>$user->name];
                Mail::to($user->email)->send(new CheckInMail($data));
               }
            }
            Log::info('Cron job Run at 11:55');
        })->weekdays()->at('11:55')->timezone('Asia/Karachi');
        $schedule->call(function () {
           // $Users=User::where('id',17)->where('show_in_attendence',1)->get();
            $Users=User::whereNot('role','admin')->where('show_in_attendence',1)->get();
            foreach ($Users as $key => $user) {
               $counter=EmployeeAttendance::where('user_id',$user->id)->where('attendance_date',date('Y-m-d'));
               if($counter->count()>0 ){
                    $employee=$counter->first();
                if($employee->check_in && !$employee->check_out){
                    $data=['name'=>$user->name];
                   $employee->update([
                        'status' => 'absent',
                        'remarks' => $employee->check_in." Check in But Checkout Missing",
                    ]);
                    Mail::to($user->email)->send(new CheckOutMail($data));
                }

               }
            }
            Log::info('Cron job Run at 19:00');
        })->weekdays()->at('19:00')->timezone('Asia/Karachi');
        // $schedule->call(function () {
        //     $data=[];
        //     Log::info('Cron job Run of Every Minute');
        //     Mail::to('medtronix123@gmail.com')->send(new CheckOutMail($data));
        // })->everyMinute();

        $schedule->call(function () {

            $present=EmployeeAttendance::where('attendance_date',date('Y-m-d'))->get();
            $absent=EmployeeAttendance::where('status',"absent")->where('attendance_date',date('Y-m-d'))->get();
            $leave=EmployeeAttendance::where('status',"leave")->where('attendance_date',date('Y-m-d'))->get();
            $workHome=EmployeeAttendance::where('status',"work_from_home")->where('attendance_date',date('Y-m-d'))->get();
            //$data=['present'=>$present,'absent'=>$absent,'leave'=>$leave,];
            $date=date('d m-Y');
            Mail::to("arslan50050@gmail.com")->send(new Attendance($present,$absent,$leave,$workHome,$date));
            Mail::to("medtronix123@gmail.com")->send(new Attendance($present,$absent,$leave,$workHome,$date));
           // Mail::to("arslan50050@gmail.com")->send(new Attendance($present,$absent,$leave,$workHome,$date));
        })->weekdays()->at('11:00')->timezone('Asia/Karachi');
          $schedule->call(function () {

            $present=EmployeeAttendance::where('attendance_date',date('Y-m-d'))->get();
            $absent=EmployeeAttendance::where('status',"absent")->where('attendance_date',date('Y-m-d'))->get();
            $leave=EmployeeAttendance::where('status',"leave")->where('attendance_date',date('Y-m-d'))->get();
            $workHome=EmployeeAttendance::where('status',"work_from_home")->where('attendance_date',date('Y-m-d'))->get();
            //$data=['present'=>$present,'absent'=>$absent,'leave'=>$leave,];
            $date=date('d m-Y');
            Mail::to("arslan50050@gmail.com")->send(new Attendance($present,$absent,$leave,$workHome,$date));
            Mail::to("medtronix123@gmail.com")->send(new Attendance($present,$absent,$leave,$workHome,$date));

           // Mail::to("arslan50050@gmail.com")->send(new Attendance($present,$absent,$leave,$workHome,$date));
        }) ->weekdays()->at('11:00')->timezone('Asia/Karachi');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}



