@extends('layouts.dashboard') {{-- Assuming you have a layout file --}}

@section('content')

<main role="main" class="main-content ">


    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center lh-1 mb-2">

                    <h2 class="fw-bold">Salary Slip</h2> <span class="fw-normal">Payment slip for the month of {{ $salarySlip->salary_month }}/{{ $salarySlip->salary_year }}</span>
                </div>
                <div class="d-flex justify-content-end"> <span>Working Branch: Sahiwal</span> </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="fw-bolder mb-0">Employee Name:</h4>
                                <p class="fs-5">{{ $salarySlip->employee->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bolder mb-0">Designation:</h4>
                                <p class="fs-5">{{ $salarySlip->employee->designation }}</p>
                            </div>
                        </div>
                    </div>
                    <table class="mt-4 table table-bordered col-12">
                        <thead class="">
                            <tr>
                                <th scope="col">Earnings</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Deductions</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Basic Pay</th>
                                <td>{{ $salarySlip->basic_salary }}</td>
                                <td>Income Tax</td>
                                <td>{{ $salarySlip->income_tax }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Transport Allowance</th>
                                <td>{{ $salarySlip->transport_allowance }}</td>
                                <td>Absent Deduction:</td>
                                <td>{{ $salarySlip->absent_deduction }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Other Allowance:</th>
                                <td>
                                    @php
                                        $decodedOtherDeduction = json_decode($salarySlip->other_allowance, true);
                                    @endphp

                                    @if($decodedOtherDeduction)
                                        <ul  style=" list-style-type:none; ">
                                            @foreach ($decodedOtherDeduction as $key => $amount)
                                                <li> <span class="h6">{{ $key }}</span> : {{ $amount }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        No other Allowance
                                    @endif
                                </td>
                                {{-- <td>{{ $salarySlip->other_allowance }}</td> --}}
                                <td>Other Deduction:</td>
                                <td>
                                    @php
                                        $decodedOtherDeduction = json_decode($salarySlip->other_deduction, true);
                                    @endphp

                                    @if($decodedOtherDeduction)
                                        <ul  style=" list-style-type:none; ">
                                            @foreach ($decodedOtherDeduction as $key => $amount)
                                                <li> <span class="h6">{{ $key }}</span> : {{ $amount }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        No other deductions
                                    @endif
                                </td>




                                {{-- <td>{{ $salarySlip->other_deduction }}</td> --}}
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <!-- Total Earning -->
                            <!-- Total Earning -->
                            <tr class="border-top">
                                <th scope="row">Total Earning</th>
                                <td>{{ number_format(floatval($salarySlip->basic_salary) + floatval($salarySlip->transport_allowance) + floatval($salarySlip->other_allowance), 2) }}</td>
                                <td>Total Deductions</td>
                                <td>{{ number_format(floatval($salarySlip->income_tax) + floatval($salarySlip->absent_deduction) + floatval($salarySlip->other_deduction), 2) }}</td>
                            </tr>

                            <!-- Net Pay -->
                            <tr>
                                <th scope="row">Net Pay</th>
                                <td colspan="3">{{ number_format(floatval($salarySlip->total_salary), 2) }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-4"> <br> <span class="fw-bold">Net Pay : {{ $salarySlip->total_salary }}</span> </div>
                    <div class="border col-md-8">
                        <div class="d-flex flex-column"> <span>In Words</span> <span>Twenty Five thousand nine hundred seventy only</span> </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="d-flex flex-column mt-2"> <span class="fw-bolder">For Metronix systems</span> <span class="mt-4">Authorised Signatory</span> </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
