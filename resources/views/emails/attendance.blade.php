this is you otp {{$data['otp']}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
    <style>
        /* General reset */
        body, table, td, a {
            text-size-adjust: 100%;
            text-decoration: none;
            margin: 0;
            padding: 0;
        }
        table {
            border-collapse: collapse !important;
            width: 100%;
        }
        body {
            width: 100% !important;
            height: 100% !important;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 10px;
            background-color: #ffffff;
        }
        /* Responsive styles */
        @media screen and (max-width: 600px) {
            .card-wrapper {
                display: block !important;
            }
            .card {
                width: 100% !important;
                display: block !important;
            }
        }
        .card-wrapper {
            display: table;
            width: 100%;
        }
        .card {
            display: table-cell;
            width: 40%;
            border-radius: 8px;
            margin-bottom: 10px;
            padding: 15px;
             border:5px solid white;
            color: #ffffff;
            vertical-align: top;
            box-sizing: border-box;
        }
        /* Colorful Card Styles */
        .card-teal { background-color: #4ECDC4; } /* Present */
        .card-red { background-color: #FF6B6B; } /* Absent */
        .card-header {
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 5px;
            border-bottom: 1px solid black;
        }
        .card-black{
            background-color: black;
        }
        .card-content {
            font-size: 14px;
            color: #ffffff;
            line-height: 1.5;
        }
        .card-content span {
            display: block;
            margin-top: 5px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #999999;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <table role="presentation" class="container">
        <tr>
            <td style="text-align: center; padding: 10px;">
                <h2 style="color: #333;">{{$date}} Attendance Report</h2>
            </td>
        </tr>

        <!-- Card Rows Start -->
        @foreach ($present as $record)
            <!-- Group cards in rows of two -->
            @if ($loop->index % 2 == 0)
                <tr class="card-wrapper">
            @endif

                @php
                    if($record->status=="present"){
                        $card="card-teal";
                    }elseif ($record->status=="absent") {
                        $card="card-red";
                    }else {
                        $card="card-black";
                    }
                @endphp
                <td class="card {{$card}}">
                    <div class="card-header">{{ $record->employee->name }}</div>
                    <div class="card-content">
                        <span>Status: {{ ucfirst($record->status) }}</span>
                        <span>Check-in: {{ $record->check_in ?? 'N/A' }}</span>
                        <span>Check-out: {{ $record->check_out ?? 'N/A' }}</span>
                        <span>Remarks: {{ $record->remarks }}</span>
                    </div>
                </td>
            @if ($loop->index % 2 == 1 || $loop->last)
                </tr>
            @endif
        @endforeach

        <!-- Footer -->
        <tr>
            <td class="footer" colspan="2">
                © 2024 Medtronix Systems | Attendance Report
            </td>
        </tr>
    </table>
</body>
</html>
