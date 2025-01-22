@extends('layouts.dashboard')

@push('js')

<script>
    $(document).ready(function () {
        // Bind an event handler to the change event of the input fields
        $('input[name="basic_salary"], input[name="transport"], input[name="income_tax"], input[name="absent_deduction"], input[name="other_deduction"], input[name="other_allowance"]').on('input', function () {
            // Get values from input fields
            var basicSalary = parseFloat($('#basic_salary').val()) || 0;
            var transport = parseFloat($('#transport').val()) || 0;
            var incomeTax = parseFloat($('#income_tax').val()) || 0;
            var absentDeduction = parseFloat($('#absent_deduction').val()) || 0;
            var otherDeduction = parseFloat($('#other_deduction').val()) || 0;
            var otherAllowance = parseFloat($('input[name="other_allowance"]').val()) || 0;

            // Calculate total salary
            var totalSalary = basicSalary + transport - incomeTax - absentDeduction - otherDeduction + otherAllowance;

            // Update the total_salary input field
            $('#total_salary').val(totalSalary.toFixed(2));
        });
    });
</script>

@endpush

@section('content')
<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <h2 class="pb-4">Employee Info</h2>
                <h5>Name : <span class="text-info">{{ $salarySlip->employee->name }}</span></h5>
                <h5>Email : <span class="text-info">{{ $salarySlip->employee->email }}</span></h5>
                <h5>Phone : <span class="text-info">{{ $salarySlip->employee->phone }}</span></h5>
            </div>
        </div>
    </div>
    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">

                <h1>Edit Salary Slip</h1>
                                
                <form method="POST" action="{{ route('salary_slips.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="text" name="employee_id" id="employee_id" value="{{ $salarySlip->created_by }}" hidden>
                    <input type="text" name="salarySlip_id" id="salarySlip_id" value="{{ $salarySlip->id }}" hidden>
            
                    <div class="row">
                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                <label for="salary_month">Salary Month</label>
                                <select name="salary_month" id="salary_month" class="form-control" required>
                                    @for ($month = 1; $month <= 12; $month++)
                                        @php
                                            $monthDate = \Carbon\Carbon::create()->month($month);
                                        @endphp
                                        <option value="{{ $month }}" {{ ($salarySlip->salary_month==$month ) ? 'selected' : '' }}>
                                            {{ $monthDate->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label for="basic_salary">Basic Salary</label>
                                <input type="number" name="basic_salary" id="basic_salary" value="{{ $salarySlip->basic_salary }}" class="form-control" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="transport_allowance">Transport Allowance</label>
                                <input type="number" name="transport_allowance" id="transport" value="{{ $salarySlip->transport_allowance }}" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            
                            <div class="form-group">
                                <label for="salary_year">Salary Year</label>
                                <input type="number" name="salary_year" id="salary_year" value="{{ $salarySlip->salary_year }}" class="form-control" disabled required>
                            </div>
                    

                            <div class="form-group">
                                <label for="income_tax">Income Tax</label>
                                <input type="number" name="income_tax" id="income_tax" value="{{ $salarySlip->income_tax }}" class="form-control" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="absent_deduction">Absent Deduction</label>
                                <input type="number" name="absent_deduction" id="absent_deduction" value="{{ $salarySlip->absent_deduction }}" class="form-control" required>
                            </div>
                    
                            <div class="form-group">
                                <label for="other_deduction">Other Deduction</label>
                                <input type="number" name="other_deduction" id="other_deduction" value="{{ $salarySlip->other_deduction }}" class="form-control" required>
                            </div>
                        </div>
                    </div>
        
                    <div class="form-group">
                        <label>Other Allowances</label>
                        <input type="number" name="other_allowance" class="form-control" value="{{ $salarySlip->other_allowance }}" placeholder="Amount" required>
                    </div>
                    <div class="form-group">
                        <label>Other Deductions</label>
                        <input type="number"  name="other_deduction" class="form-control" value="{{ $salarySlip->other_deduction }}" placeholder="Amount" required>
                    </div>
                    

                    <div class="form-group">
                        <label for="total_salary">Total Salary after Deductions</label>
                        <input type="text" id="total_salary" name="total_salary" value="{{ $salarySlip->total_salary }}" class="form-control" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Salary Slip</button>
                </form>


            </div>
        </div>
    </div>
    

</main>
@endsection
