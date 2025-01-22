@extends('layouts.dashboard')

@push('js')
<script>
    $(document).ready(function() {
            // Bind an event handler to the change event of the input fields
            $('input[name="basic_salary"], input[name="transport_allowance"], input[name="income_tax"], input[name="absent_deduction"], input[name="other_deduction_amount[]"], input[name="other_allowance_amount[]"]')
                .on('input', function() {
                    // Get values from input fields
                    getTotal();
                });

            $('#add_allowances').click(function() {
                let randId = Math.round(Math.random() * 10000000);
                $('#add_allowances_div').append(`<div id='allow_${randId}' class="row form-group">
                                        <div class="col-6 pr-0">
                                            <input type="text" placeholder="Enter Text" name="other_allowance_name[]"
                                                class="form-control">
                                        </div>
                                        <div class="col-4 p-0">
                                            <input type="number" placeholder="Enter Amount" value='0' onchange="getTotal()" name="other_allowance_amount[]"
                                                class="form-control">
                                        </div>
                                        <div class="col-2 p-0">
                                            <button onclick='del_allow("${randId}")' type="button" class="btn btn-danger btn-sm float-right del-allowance-row">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>`);

            });
            $('#add_deductions').click(function() {
                let randId = Math.round(Math.random() * 10000000);
                $('#add_deduction_div').append(`<div id='ded_${randId}' class="row form-group">
                        <div class="col-6 pr-0">
                            <input type="text" placeholder="Enter Text" name="other_deduction_name[]"
                                class="form-control">
                        </div>
                        <div class="col-4 p-0">
                            <input type="number" placeholder="Enter Amount" value='0' onchange="getTotal()" name="other_deduction_amount[]"
                                class="form-control">
                        </div>
                        <div class="col-2 p-0">
                            <button onclick='del_deduct("${randId}")'  type="button" class="btn btn-danger btn-sm float-right">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>`);

            });

            $('.del-allowance-row').click(function() {
                let maxDataId = $(this).data('id');


            });

        });

        function del_allow(id) {

            $('#allow_' + id).fadeOut().remove();
        }

        function del_deduct(id) {
            $('#ded_' + id).fadeOut().remove();
        }

        function getTotal() {
            var basicSalary = parseFloat($('#basic_salary').val()) || 0;
            var transport = parseFloat($('#transport').val()) || 0;
            var incomeTax = parseFloat($('#income_tax').val()) || 0;
            var absentDeduction = parseFloat($('#absent_deduction').val()) || 0;
            let otherDeduction = 0;
            let otherAllowance = 0;

            $('input[name="other_allowance_amount[]"]').each(function(index) {
                otherAllowance += parseFloat($(this).val()) || 0;

            });
            $('input[name="other_deduction_amount[]"]').each(function(index) {
                otherDeduction += parseFloat($(this).val()) || 0;

            });
            // Calculate total salary
            var totalSalary = basicSalary + transport - incomeTax - absentDeduction - otherDeduction +
                otherAllowance;

            // Update the total_salary input field
            $('#total_salary').val(totalSalary.toFixed(2));
        }
</script>
@endpush

@section('content')
<main role="main" class="main-content">

    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <h3 class="pb-4">Employee Info</h3>
                <h5>Name : <span class="text-info">{{ $salarySlip->employee->name }}</span></h5>
                <h5>Email : <span class="text-info">{{ $salarySlip->employee->email }}</span></h5>
                <h5>Phone : <span class="text-info">{{ $salarySlip->employee->phone }}</span></h5>
            </div>
        </div>
    </div>
    <div class="card p-4 my-4">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('salary_slips.update') }}" id="salary_form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>Create Salary Slip</h3>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="salary_slip_id" id="salary_slip_id" class="form-control"
                                value="{{ $salarySlip->id}}" hidden>
                            <input type="text" name="employee_name" id="employee_name" class="form-control"
                                value="{{ $employData->name }}" readonly>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="salary_month">Salary Month</label>
                                <select name="salary_month" id="salary_month" class="form-control" required>
                                    @for ($month = 1; $month <= 12; $month++) @php $monthDate=\Carbon\Carbon::create()->
                                        month($month);
                                        @endphp
                                        <option value="{{ $month }}" {{ ($salarySlip->salary_month==$month ) ?
                                            'selected' : '' }}>
                                            {{ $monthDate->format('F') }}
                                        </option>
                                        @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="basic_salary">Basic Salary</label>
                                <input type="number" name="basic_salary" id="basic_salary"
                                    value="{{ $salarySlip->basic_salary }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="transport_allowance">Transport Allowance</label>
                                <input type="number" name="transport_allowance" id="transport"
                                    value="{{ $salarySlip->transport_allowance }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Other Allowances</label>
                                <button id="add_allowances" value="0" type="button"
                                    class="btn btn-dark btn-sm float-right">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>

                            <div id="add_allowances_div">
                                @php
                                $otherAllowances = json_decode($salarySlip->other_allowance, true);
                                @endphp

                                @foreach ($otherAllowances as $key => $value)
                                @php
                                $randId = uniqid();
                                @endphp
                                <div id="allow_{{ $randId }}" class="row form-group">
                                    <div class="col-6 pr-0">
                                        <input type="text" placeholder="Enter Text" name="other_allowance_name[]"
                                            class="form-control" value="{{ $key }}">
                                    </div>
                                    <div class="col-4 p-0">
                                        <input type="number" placeholder="Enter Amount" value="{{ $value }}"
                                            onchange="getTotal()" name="other_allowance_amount[]" class="form-control">
                                    </div>
                                    <div class="col-2 p-0">
                                        <button onclick="del_allow('{{ $randId }}')" type="button"
                                            class="btn btn-danger btn-sm float-right del-allowance-row">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach


                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="salary_year">Salary Year</label>
                                <input type="number" name="salary_year" id="salary_year"
                                    value="{{ $salarySlip->salary_year }}" class="form-control" readonly required>
                            </div>

                            <div class="form-group">
                                <label for="income_tax">Income Tax</label>
                                <input type="number" name="income_tax" id="income_tax"
                                    value="{{ $salarySlip->income_tax }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="absent_deduction">Absent Deduction</label>
                                <input type="number" name="absent_deduction" id="absent_deduction"
                                    value="{{ $salarySlip->absent_deduction }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Other Deductions</label>
                                <button id="add_deductions" type="button" class="btn btn-dark btn-sm float-right">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>

                            <div id="add_deduction_div">
                                @php
                                $otherDeductions = json_decode($salarySlip->other_deduction, true);
                                @endphp

                                @foreach ($otherDeductions as $key => $value)
                                @php
                                $randId = uniqid();
                                @endphp
                                <div id="ded_{{ $randId }}" class="row form-group">
                                    <div class="col-6 pr-0">
                                        <input type="text" placeholder="Enter Text" name="other_deduction_name[]"
                                            class="form-control" value="{{ $key }}">
                                    </div>
                                    <div class="col-4 p-0">
                                        <input type="number" placeholder="Enter Amount" value="{{ $value }}"
                                            onchange="getTotal()" name="other_deduction_amount[]" class="form-control">
                                    </div>
                                    <div class="col-2 p-0">
                                        <button onclick="del_deduct('{{ $randId }}')" type="button"
                                            class="btn btn-danger btn-sm float-right del-deduction-row">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach


                            </div>

                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-sm-6">
                            <label for="total_salary">Remarks</label>
                            <textarea name="remarks" class="form-control" id="" rows="2"></textarea>
                        </div>
                        <div class="col-sm-6">
                            <label for="total_salary">Net Salary</label>
                            <input type="text" id="total_salary" name="total_salary"
                                value="{{ $salarySlip->total_salary }}" class="form-control" readonly>
                        </div>
                    </div>
                    <input type="hidden" name="print" value="0">
                    <button type="button" id="print_salary_btn" class="btn btn-dark mx-2">Update and Print</button>
                    <button type="submit" id="salary_btn" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>



</main>
@endsection
@push('js')
<script>
    $("#print_salary_btn").on('click', function() {
            $('input[name="print"]').val(1);
            $('#salary_form').submit();
        });

        $("#salary_form").on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var form = $('#salary_form');
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#salary_btn,#print_salary_btn').prop("disabled", true);

                },
                success: function(response) {

                    Toast.fire({
                        icon: response.status,
                        title: response.message
                    });
                    if (response.status == 'success') {
                        if (response.print != 0) {
                            window.open(window.location.origin + "/salary_slip/" + response.print,
                                '_blank');
                        }
                    }



                    $('#salary_btn,#print_salary_btn').prop("disabled", false);

                }
            }); //ajax call
        }); //main
</script>
@endpush
