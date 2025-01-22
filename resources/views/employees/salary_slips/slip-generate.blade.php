<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- font-awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Salery slip</title>
    <style>
      .watermark-text {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            font-weight: 900;
            opacity: 0.5;
            z-index: +99999;
            color: #d6c2c277;
        }
    </style>
</head>
<body>

    <main role="main" class="main-content bg-white">


        <div class="container mt-5 mb-5">
            <section class="salary pt-5 pb-5">
                <div class="container">
                    <div class="row">
                        <div class="watermark-text col-12 text-center">Medtronix Systems</div>
                        <div class="col-12">
                            <div style="background: rgb(247, 247, 247); " class="card-header d-flex justify-content-between px-4 align-items-center border">
                                <h3>SALARY SLIP</h3>
                                <img style="width: 200px;" src="{{ url('assets\images\Medtronix\logo-horizontal.png') }}" alt="not-show">

                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 justify-content-between">
                        <div class="col-5">
                            <div class="row ">
                                <div class="col-6">
                                    <h6>Employee Name :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary">{{ $salarySlip->employee->name }}</h6>

                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-6">
                                    <h6>Designation :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary">{{ $salarySlip->employee->designation }}</h6>

                                </div>
                            </div>

                        </div>
                        <div class="col-5">
                            <div class="row ">
                                <div class="col-6">
                                    <h6>Salary Date :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary text-uppercase"> {{ $salarySlip->salary_month }}/{{ $salarySlip->salary_year }}</h6>

                                </div>

                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2 justify-content-between">
                        <div class="col-5">
                            <div class="row ">
                                <div class="col-6">
                                    <h6>Working Days:</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary"> {{ $workingDays }}</h6>

                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-6">
                                    <h6>Total Presents :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary">{{ $presentCount }}</h6>

                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-6">
                                    <h6>Work from Home :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary text-uppercase">{{ $workFromHomeCount }}</h6>

                                </div>

                            </div>



                        </div>
                        <div class="col-5">
                            <div class="row ">
                                <div class="col-6">
                                    <h6>Total Absents :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary text-uppercase">{{ $absentCount }}</h6>

                                </div>

                            </div>
                            <div class="row ">
                                <div class="col-6">
                                    <h6>Total Leaves :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary text-uppercase"> {{ $leaveCount }}</h6>

                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="row mt-5 justify-content-between">
                        <!-- left -->
                        <div class="col-5">
                            <div class="card-header mb-2 border" style="background: rgb(247, 247, 247);">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="text-uppercase">Earnings</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="text-uppercase pl-4">Amount</h5>

                                    </div>
                                </div>

                            </div>
                            <div class="row ">
                                <div class="col-6">
                                    <h6 class="pl-3">Basic Pay :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary pl-5">{{ $salarySlip->basic_salary }}</h6>

                                </div>

                                <div class="col-6">
                                    <h6 class="pl-3">Transport Allowance :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary  pl-5">{{ $salarySlip->transport_allowance }}</h6>

                                </div>

                            </div>
                            <div class="row">

                                @php
                                $decodedOtherallowance = json_decode($salarySlip->other_allowance, true);
                                $other_allowance=0;
                                @endphp

                                @if($decodedOtherallowance)
                                @foreach ($decodedOtherallowance as $key => $amount)
                                @if(!empty($key))
                                @php
                                    $other_allowance+=(int)$amount;
                                @endphp
                                <div class="col-6">
                                    <h6 class="pl-3">{{ ucfirst($key) }} :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="pl-5 text-secondary">{{ number_format($amount, 2)  }}</h6>
                                </div>
                                @endif
                                @endforeach
                                @else
                                No other Allowance
                                @endif
                            </div>


                        </div>
                        <!-- right -->
                        <div class="col-5">
                            <div class="card-header border mb-2" style="background: rgb(247, 247, 247);">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="text-uppercase">Deductions</h5>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="text-uppercase pl-4">Amount</h5>

                                    </div>
                                </div>

                            </div>
                            <div class="row ">
                                <div class="col-6">
                                    <h6 class="pl-3">Absent Deduction :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary pl-5">{{ $salarySlip->absent_deduction }}</h6>

                                </div>
                                <div class="col-6">
                                    <h6 class="pl-3">Income Tax :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-secondary pl-5">{{ $salarySlip->income_tax }}</h6>

                                </div>


                                @php
                                $decodedOtherDeduction = json_decode($salarySlip->other_deduction, true);
                                $other_deduction=0;
                                @endphp

                                @if($decodedOtherDeduction)
                                @foreach ($decodedOtherDeduction as $key => $amount)
                                @if(!empty($key))
                                @php
                                    $other_deduction+=(int)$amount;
                                @endphp
                                <div class="col-6">
                                    <h6 class="pl-3">{{ucfirst( $key )}} :</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="pl-5 text-secondary">{{ number_format($amount, 2)  }}</h6>

                                </div>
                                @endif
                                @endforeach
                                @else
                                No other deduction
                                @endif



                            </div>

                        </div>

                    </div>

                    <div class="row align-items-center  pt-5">
                        <div class="col-3">
                            <h5>Total Earning</h5>
                        </div>
                        <div class="col-4">
                            <h5 class="pr-4" style="border-bottom: 1px solid rgb(158, 153, 153);"> {{ number_format(floatval($salarySlip->basic_salary) + floatval($salarySlip->transport_allowance) + floatval($other_allowance), 2) }}</h5>
                        </div>

                    </div>
                    <div class="row align-items-center  pt-2">
                        <div class="col-3">
                            <h5>Total Deductions</h5>
                        </div>
                        <div class="col-4">
                            <h5 class="pr-4" style="border-bottom: 1px solid rgb(158, 153, 153);">{{ number_format(floatval($salarySlip->income_tax) + floatval($salarySlip->absent_deduction) + floatval($other_deduction), 2) }}</h5>
                        </div>

                    </div>
                    <div class="row align-items-center  pt-2">
                        <div class="col-3">
                            <h5>Net Salary</h5>
                        </div>
                        <div class="col-4">
                            <h5 class="pr-4" style="border-bottom: 1px solid rgb(158, 153, 153);"> {{ number_format(floatval($salarySlip->total_salary), 2) }}</h5>
                        </div>

                    </div>
                    <div class="row mt-5 justify-content-between">
                        <!-- left -->
                        <div class="col-12">
                            <div class="card-header mb-2 border" style="background: rgb(247, 247, 247);">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="text-uppercase">Remarks</h5>
                                    </div>

                                </div>

                            </div>
                            <div class="row ">
                                <div class="col-12">
                                    <h6 class="pl-3">{{ $salarySlip->remarks }}</h6>
                                </div>


                            </div>



                        </div>

                    </div>

                    <div class="row mt-5 justify-content-between">
                        <div class="col-4 my-4">
                            <div class="card">
                                <div class="card-header border py-5" style="background: rgb(247, 247, 247);">


                                </div>
                                <div class="card-body text-center">
                                    <h5>Employee Signature</h5>

                                </div>
                            </div>
                        </div>
                        <div class="col-4 my-4">
                            <div class="card">
                                <div class="card-header border py-5" style="background: rgb(247, 247, 247);">


                                </div>
                                <div class="card-body text-center">
                                    <h5>Directed Signature</h5>

                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <section class="border" style=" padding: 30px 0px; background: rgb(247, 247, 247);">
                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <ul style=" list-style-type:none; ">
                                <li class=""><i class="fa fa-phone pr-2 mb-3 " aria-hidden="true"></i>
                                    040-2038224</li>
                                <li class=""><i class="fa fa-comment pr-1" aria-hidden="true"></i> +92 344 3228863
                                </li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <ul style=" list-style-type:none; ">
                                <li class=" mb-3"><i class="fa fa-phone pr-2" aria-hidden="true"></i>
                                    arslan.medtronix.us @gmail.com</li>
                                <li class=" d-flex "><i class="fa fa-map-marker pr-2 mt-1" aria-hidden="true"></i>
                                    <p>Hali Road Opposite National saving bank,Goal chakar
                                        Sahiwal Punjab Pakistan</p>
                                </li>

                            </ul>
                        </div>
                        <div class="col-4 text-center">
                            <img style="width: 90px;" src="{{ url('assets/images/Medtronix/logo-footer.png') }}" alt="">
                        </div>
                        <div class="col-12">
                            <div class="border">

                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <p class="pt-3 pb-3">
                                www.medtronix.world
                            </p>
                        </div>
                    </div>
                </div>

            </section>
        </div>

    </main>

</body>
</html>
