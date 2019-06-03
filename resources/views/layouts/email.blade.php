<!DOCTYPE html>
<html>
<head>
    <title>LASER Airlines</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="background: #c6ecc6;padding:50px 25px;font: 14px/1.25em 'Helvetica Neue',Arial,Helvetica;">
@yield('markup')
<table style="width: 100%;" align="center">
    <tr>
        <td><img src="https://www.laser.com.ve/Content/img/logo-footer1.png" style="width: 200px;" alt="LASER Airlines"></td>
    </tr>
</table>
<br>
<table style="border-bottom:3px solid #b0bec5;width: 100%;background: #fff;border-radius: 5px;" align="center">
    <tbody>
    <tr>
        <td valign="top">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                <tr>
                    <td width="100%" valign="top" style="width: 100%;padding:0px 15px 20px 15px;min-height: 400px">
                        @yield('main')
                    </td>
                </tr>
                <tr>
                    <td valign="bottom" style="text-align: center;padding:10px 0 30px 0;">
                        <img src="https://www.laser.com.ve/Content/img/logo-footer1.png" style="width: 125px;" alt="LASER Airlines">
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>