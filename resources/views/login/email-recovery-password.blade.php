<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>S2-Care</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto');
    </style>
    <style>
        /* A simple css reset */

        body,
        table,
        thead,
        tbody,
        tr,
        td,
        img {
            padding: 0;
            margin: 0;
            border: none;
            border-spacing: 0px;
            border-collapse: collapse;
            vertical-align: top;
        }

        body {
            font-family: 'Roboto', sans-serif;
            padding: 10px;
        }

        /* Add some padding for small screens */

        .wrapper {
            padding-left: 10px;
            padding-right: 10px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0;
            padding: 0;
            padding-bottom: 20px;
            line-height: 1.6;
            font-family: 'Roboto', sans-serif;
        }

        p,
        a,
        li {
            font-family: 'Roboto', sans-serif;
        }

        img {
            /* width: 100%; */
            display: block;
        }

        @media only screen and (max-width: 620px) {

            .wrapper .section {
                width: 100%;
            }

            .wrapper .column {
                width: 100%;
                display: block;
            }
        }

        .myLink:link,
        .myLink:visited {
            background-color: #4CAF50;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .myLink:hover,
        .myLink:active {
            background-color: #3e8e41;
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
        }
    </style>
</head>

<body>
    <table width="100%">
        <tbody>
            <tr>
                <td class="wrapper" width="1000" align="center">
                    <table class="section" cellpadding="0" cellspacing="0" width="1000">
                        <tr style="background-color: #265a65;">
                            <td class="column" width="250" valign="top">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td align="left" style="padding: 15px;">
                                                <img src="{{ config('url.logo') }}" alt="logo-ss" height="60">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="column">
                                <table>
                                    <tbody>
                                        <tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="section" cellpadding="0" cellspacing="0" width="1000">
                        <tr>
                            <td class="column" width="220" valign="top">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="column">
                                <table>
                                    <tbody>
                                        <tr>
                                            <tr>
                                                <td>
                                                    <td align="center" style="padding: 15px;">
                                                        <img src="{{ asset('/images/ForgotPassword.png') }}" alt="congratz" height="120">
                                                            <h2 style="padding-top: 15px;">Selamat, kata sandi anda telah diperbaharui.</h2>
                                                            <h2 style="padding-bottom: 0;">Username : {{ $user['username'] }}</h2>
                                                        <h2>Password : {{ $user['cpass'] }}</h2>
                                                        <p style="text-align:center;">Silakan masuk dengan menggunakan akun diatas.</p>
                                                        <a class="button" href="{{ env('S2CARE_WEB_URL') . '/dashboard' }}" target="_blank">LOGIN</a>
                                                    </td>
                                                </td>
                                            </tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table class="section" cellpadding="0" cellspacing="0" width="1000">
                        <tr style="background-color: #cccccc;">
                            <td class="column" width="250" valign="top">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td> &nbsp; </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="column">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td align="center" style="padding: 15px;">
                                                <h5 style="font-size: 16px; padding-bottom: 3px;"><a href="https://www.rajagps.co.id/" target="_blank" style="color: #265a65 !important;">PT. SUPERSPRING</a></h5>
                                                <h5 style="font-size: 14px; padding-bottom: 3px;">Jalan Cideng Timur No 81, Jakarta Pusat 10160</h5>
                                                <h5 style="font-size: 14px; padding-bottom: 3px;">Call Center 24 Jam : <span style="color:#265a65;">(021) 2206 2222</span></h5>
                                                <h5 style="font-size: 14px; padding-bottom: 3px;">Email : <span style="color:#265a65;">info@gps.id</span></h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
