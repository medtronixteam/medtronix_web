<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
  <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
  <title></title>
<!--[if !mso]><!--><link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css2?family=Bitter:wght@600&display=swap" rel="stylesheet" type="text/css"><link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 8px;
        border: 1px solid #111;
    }

    td:first-child {
        font-weight:bold;
        }
</style>
</head>

<body >
    <table>
        <tr>
            <td colspan="2">
                <h3>New User Registed for waitlist</h3>
            </td>
        </tr>
        <tr>
            <td>Name</td>
            <td>{{$data['name']}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{$data['email']}}</td>
        </tr>
        <tr>
            <td>Country</td>
            <td>{{$data['country']}}</td>
        </tr>
        <tr>
            <td>Company name</td>
            <td>{{$data['company_name']}}</td>
        </tr>
        <tr>
            <td>Industry</td>
            <td>{{$data['industry']}}</td>
        </tr>
    </table>
</body>

</html>
