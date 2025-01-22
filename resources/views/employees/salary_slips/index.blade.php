



@extends('layouts.dashboard')
@section('content')

<main role="main" class="main-content">
    <h3 class="text-white p-4 bg-primary">List of SalarySlips</h3>
    <div class="card p-4 ">

        <div class="table-responsive">
            <table class="table table-striped ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Salary Month</th>
                        <th>Basic Salary</th>
                        <th>Transport Allowances</th>
                        <th>Income Tax</th>
                        {{-- Add other columns as needed --}}
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salarySlips as $salarySlip)
                    @if (isset( $salarySlip->employee->name ))


                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $salarySlip->employee->name}}</td>

                        @php
                            $monthDate = \carbon\carbon::create()->month($salarySlip->salary_month)
                        @endphp
                        <td>{{ $monthDate->format('F') }}</td>

                        <td>{{ $salarySlip->basic_salary }}</td>
                        <td>{{ $salarySlip->transport_allowance }}</td>
                        <td>{{ $salarySlip->income_tax }}</td>
                        <td>{{ $salarySlip->total_salary }}</td>

                        {{-- <td>{{ $salarySlip->other_deduction }}</td> --}}

                        {{-- Add other columns as needed --}}
                        <td>
                            <a type="button" style="cursor: pointer" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu">

                                {{-- <a class="dropdown-item"
                                    href="{{ route('salary_slips.show', $salarySlip->id) }}">Show</a> --}}
                                <a target="_blank" class="dropdown-item"
                                    href="{{ route('salary_slips.generate', $salarySlip->id) }}">Print </a>
                                <a class="dropdown-item"
                                    href="{{ route('salary_slips.edit', $salarySlip->id) }}">Edit</a>
                                <form method="POST" action="{{ route('salary_slips.destroy') }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <input type="text" value="{{ $salarySlip->id }}" name="salarySlip_id" hidden>
                                    <button type="submit" class="dropdown-item text-danger"
                                        onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                </form>
                            </div>
                            {{-- Add links to show, edit, or delete --}}
                            {{-- Add a form for delete if needed --}}
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-12">
                     {!! $salarySlips->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>

    </div>

</main>

@endsection
