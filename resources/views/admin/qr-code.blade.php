<!-- resources/views/qrcode.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>QR Code</title>
</head>
<body>
    <div style="width:100%;display:flex;justify-content:center;align-items:center" >

    </div>

    <div style="width:100%;height:95vh;display:flex;justify-content:center;align-items:center" >
        <div>
            <img width="250" src="{{url('assets/images/Medtronix/LogoV3.2.jpg')}}" alt="" srcset="">

            <h1 style="">Scan QR Code</h1> <br>

    {!! $qrCode !!} <br>
    <h1 style="">www.medtronix.world</h1>

   </div>
   </div>
</body>
</html>
