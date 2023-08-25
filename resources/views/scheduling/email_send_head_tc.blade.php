<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>S2-Care</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    table tr td {
        font-size: 16px; font-family: Arial, sans-serif;
    }
    .button {
            background-color: #275A65;
            /* Green */
            border: none;
            color: white;
            padding: 15px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 10%;
        }
    .button2 {background-color: #265a65} /* Blue */

    .brand-logo {
        vertical-align: sub;
    }

    .brand-text {
        display: inline;
        padding-left: 10px;
        font-weight: 500;
        letter-spacing: 1px;
        color: #FFFFFF;
    }

    .font1 {
        padding: 5px;
        color: #153643;
        font-family: Arial, sans-serif; font-size: 20px;
        line-height: 20px;
    }

    h2, .h2 {
        font-size: 1.74rem;
    }
</style>
</head>
<body style="margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 10px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="900" style="border: 1px solid #cccccc; border-collapse: collapse;">
                    <tr>
                        <td align="left" style="text-align: center; background-color: #265a65; padding: 20px 0 20px 10px; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif; border-bottom: 3px solid #DBDDDE">
                            <img class="brand-logo" src="https://s2care.gps.id/app-assets/images/logo/stack-logo-light.png" alt="">
                            <h2 class="brand-text">S2-Care</h2>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="text-aiign: center;">
                                <tr>
                                    <td colspan="3" style="color: #153643; font-family: Arial, sans-serif; font-size: 24px; text-align:center; padding-bottom: 20px;">
                                        <b>{{ $schedule['schedule_no'] }} Closing schedule doesn't update</b>
                                    </td>
                                </tr>
                                @foreach ($schedule['schedule_order'] as $value)
                                    <tr>
                                        <td class="font1" style="width:45%">{{ $value['schedule_type']['name'] }}</td>
                                        <td class="font1">:</td>
                                        <td class="font1">
                                            @foreach ($value['schedule_vehicle'] as $item)
                                                <span>- {{ $item['vehicle_name'] }} - {{ $item['plat_number']}}</span><br>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" style="text-align: center; padding-top: 20px">
                                        <a class="button" href='{{ env("APP_URL_WEB") . "/scheduling/notUpdated/".encrypt($schedule['nID']) }}' target="_blank">DETAIL</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #cccccc; border-top: 3px solid #DBDDDE" align="center">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="padding: 15px;">
                                        <span style="display: block; font-weight: bold; font-size: 16px; padding-bottom: 3px;"><a href="https://www.rajagps.co.id/" target="_blank" style="color: #265a65 !important;">PT. SUPERSPRING</a></span>
                                        <span style="display: block; font-weight: bold; font-size: 14px; padding-bottom: 3px;">Jalan Cideng Timur No 81, Jakarta Pusat 10160</span>
                                        <span style="display: block; font-weight: bold; font-size: 14px; padding-bottom: 3px;">Call Center 24 Jam : <span style="color:#265a65;">(021) 2206 2222</span></span>
                                        <span style="display: block; font-weight: bold; font-size: 14px; padding-bottom: 3px;">Email : <span style="color:#265a65;">info@gps.id</span></span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
