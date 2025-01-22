<?php

namespace App\Http\Controllers;

use App\Models\SalarySlip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Carbon;
use App\Models\EmployeeAttendance;

class SalarySlipController extends Controller
{
    public function generatePdf($id)
    {
        $salarySlip = SalarySlip::with('employee')->findOrFail($id);

        // Render the view to HTML content
        // return PDF::html('<h1>Hello world!!</h1>');
        $html = '<h1>Hello world!!</h1>';
        $pdfContent = Browsershot::html($html)
            ->setNodeBinary('.nvm/versions/node/v14.18.2/bin/node')
            ->setNpmBinary('.nvm/versions/node/v14.18.2/bin/npm')
            ->pdf();

        return $pdfContent;

        // Generate the PDF using the HTML content
        // $pdf = PDF::view('salary-slip', compact('salarySlip'));

        // Download the PDF file with a specific filename
        // return $pdf->download('salary_slip_' . $id . '.pdf');

        // $html = view('salary-slip', compact('salarySlip'))->render();

    }
    public function index()
    {
        // Retrieve all salary slips
        $salarySlips = SalarySlip::latest()->paginate(10);

        // return $salarySlips;
        return view('employees.salary_slips.index', compact('salarySlips'));
    }

    public function create($id)
    {

        $employData = User::find($id);
        $employeesAll = User::where('role', 'employee')->get();

        return view('employees.salary_slips.create', compact('employeesAll', 'employData'));
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'salary_year' => 'required',
            'basic_salary' => 'required',
            'salary_month' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            $response = ['message' => reset($messages)[0],
                'status' => 'error'];
            return response()->json($response);

        }

        // Check if a salary slip already exists for the specified month and year
        $existingSalarySlip = SalarySlip::where('employee_id', $request->input('employee_id'))
            ->where('salary_month', $request->input('salary_month'))
            ->where('salary_year', $request->input('salary_year'))
            ->exists();

        if ($existingSalarySlip) {

            $response = ['message' => 'A salary slip already exists for this month and year',
                'status' => 'error'];
            return response()->json($response);
        }
        // Convert the "Other Allowances" array into an associative array
        $otherAllowances = array_combine(
            $request->input('other_allowance_name'),
            $request->input('other_allowance_amount')
        );

        // Convert the "Other Deductions" array into an associative array
        $otherDeductions = array_combine(
            $request->input('other_deduction_name'),
            $request->input('other_deduction_amount')
        );

        $monthSalary = str_replace(' ', '', $request->input('total_salary'));
        $salary = SalarySlip::create([
            'employee_id' => $request->input('employee_id'),
            'salary_month' => $request->input('salary_month'),
            'salary_year' => $request->input('salary_year'),
            'total_salary' => $monthSalary,
            'basic_salary' => $request->input('basic_salary'),
            'transport_allowance' => $request->input('transport_allowance'),
            'other_allowance' => json_encode($otherAllowances),
            'other_deduction' => json_encode($otherDeductions),
            'income_tax' => $request->input('income_tax'),
            'absent_deduction' => $request->input('absent_deduction'),
            'remarks' => $request->input('remarks'),
            'created_by' => auth()->id(),

        ]);

        $response = ['message' => 'Salary slip Created successfully',
            'status' => 'success', 'print' => ($request->input('print')==1)?$salary->id:"0"];
        return response()->json($response);
    }

    // public function show($id)
    // {
    //     $salarySlip = SalarySlip::findOrFail($id);

    //     return view('employees.salary_slips.show', compact('salarySlip'));
    // }
    public function generate($id)
    {
        $salarySlip = SalarySlip::findOrFail($id);

        $month = $salarySlip->salary_month;
        $year = $salarySlip->salary_year;

         // Retrieve the count of present and absent statuses for the specified user, year, and month
         $presentCount = EmployeeAttendance::where('user_id', $salarySlip->employee_id)
         ->whereYear('attendance_date', $year)
         ->whereMonth('attendance_date', $month)
         ->where('status', 'present')
         ->count();

     $absentCount = EmployeeAttendance::where('user_id', $salarySlip->employee_id)
         ->whereYear('attendance_date', $year)
         ->whereMonth('attendance_date', $month)
         ->where('status', 'absent')
         ->count();

// Retrieve the count of different statuses for the specified user, year, and month
     $leaveCount = EmployeeAttendance::where('user_id', $salarySlip->employee_id)
         ->whereYear('attendance_date', $year)
         ->whereMonth('attendance_date', $month)
         ->where('status', 'leave')
         ->count();

     $workFromHomeCount = EmployeeAttendance::where('user_id', $salarySlip->employee_id)
         ->whereYear('attendance_date', $year)
         ->whereMonth('attendance_date', $month)
         ->where('status', 'work_from_home')
         ->count();

     $holidayCount = EmployeeAttendance::where('user_id', $salarySlip->employee_id)
         ->whereYear('attendance_date', $year)
         ->whereMonth('attendance_date', $month)
         ->where('status', 'holiday')
         ->count();

     $remotelyCount = EmployeeAttendance::where('user_id', $salarySlip->employee_id)
         ->whereYear('attendance_date', $year)
         ->whereMonth('attendance_date', $month)
         ->where('status', 'remotely')
         ->count();

     $halfLeaves = EmployeeAttendance::where('user_id', $salarySlip->employee_id)
         ->whereYear('attendance_date', $year)
         ->whereMonth('attendance_date', $month)
         ->where('status', 'half_leave')
         ->count();
    $workingDays = EmployeeAttendance::where('user_id', $salarySlip->employee_id)
         ->whereYear('attendance_date', $year)
         ->whereMonth('attendance_date', $month)
         ->count();




         return view('employees.salary_slips.slip-generate', compact('salarySlip','workingDays', 'presentCount', 'absentCount', 'leaveCount', 'workFromHomeCount',  'remotelyCount'));

    }

    public function edit($id)
    {
        $salarySlip = SalarySlip::findOrFail($id);
        $employeesAll = User::where('role', 'employee')->get();
        $employData = User::find($salarySlip->employee_id);
        // return $salarySlip;
        return view('employees.salary_slips.edit', compact('salarySlip','employeesAll','employData'));
    }

    public function update(Request $request)
    {
        // return $request;

        $validator = validator($request->all(), [
            'salary_year' => 'required',
            'basic_salary' => 'required',
            'salary_month' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = json_decode(json_encode($validator->messages()), true);
            $response = [
                'message' => reset($messages)[0],
                'status' => 'error'
            ];
            return response()->json($response);
        }

        // Find the salary slip by its ID
        $salarySlip = SalarySlip::find($request->input('salary_slip_id'));

        if (!$salarySlip) {
            $response = [
                'message' => 'Salary slip not found',
                'status' => 'error',
                'print'=> '0'
            ];
            return response()->json($response);
        }

        // Update the salary slip fields
        $salarySlip->salary_month = $request->input('salary_month');
        // $salarySlip->salary_year = $request->input('salary_year');
        $salarySlip->basic_salary = $request->input('basic_salary');
        $salarySlip->transport_allowance = $request->input('transport_allowance');
        $salarySlip->income_tax = $request->input('income_tax');
        $salarySlip->absent_deduction = $request->input('absent_deduction');
        $salarySlip->remarks = $request->input('remarks');

        // Convert the "Other Allowances" array into an associative array
        $otherAllowances = array_combine(
            $request->input('other_allowance_name'),
            $request->input('other_allowance_amount')
        );

        // Convert the "Other Deductions" array into an associative array
        $otherDeductions = array_combine(
            $request->input('other_deduction_name'),
            $request->input('other_deduction_amount')
        );

        $salarySlip->other_allowance = json_encode($otherAllowances);
        $salarySlip->other_deduction = json_encode($otherDeductions);

        // Update total salary
        $totalSalary = str_replace(' ', '', $request->input('total_salary'));
        $salarySlip->total_salary = $totalSalary;

        // Save the updated salary slip
        $salarySlip->save();

        $response = [
            'message' => 'Salary slip updated successfully',
            'status' => 'success',
            'print' => ($request->input('print')==1)?$salarySlip->id:"0"
        ];
        return response()->json($response);

        // flashy()->success('😉 salary slip updated successfully!', '#');
        // return redirect()->route('salary_slips.index')->with('success', 'Salary slip updated successfully.');

    }

    public function destroy(Request $request)
    {
        // Delete the salary slip
        SalarySlip::findOrFail($request->input('salarySlip_id'))->delete();

        flashy()->muteddark('😖 salary slip deleted successfully!', '#');
        return redirect()->route('salary_slips.index')->with('success', 'Salary slip deleted successfully.');
    }
}
