
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Verification</title>
</head>

<body>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:475px; margin: auto;">
        <tbody>
            <tr>
                <td align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td style="font-size:1px;line-height:1px" height="30">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-size: cover;box-shadow: 0px 8px 15px #00000029;border-radius: 8px;    border: 1px solid #e5e5e5;">
                        <tbody>

                            <tr>
                                <td style="padding-top: 40px; padding-bottom: 20px;" align="center" valign="middle">
                                    <a href="https://wokacreations.com/ " style="text-decoration:none" target="_blank">

                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 51px 20px 15px 20px; text-align: center;" align="center" valign="top">
                                    <h2 style="color:#09005D;font-family:Arial,Poppins,Helvetica,sans-serif;font-size:28px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:36px;text-transform:none;padding:0;margin:0">
                                        @if($user_data->language == 'EN')
                                            Dear {{$user_data->name}}
                                        @else
                                            Lieber {{$user_data->name}}
                                        @endif
                                    </h2>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 0 20px; text-align: center;" align="center" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr style="display: flex;justify-content: center;">
                                                <td style="padding-bottom: 20px;" align="center" valign="top">
                                                    <p style="color:#09005D;font-family:Arial,Poppins,Helvetica,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:18.4px;text-transform:none;text-align:center;padding:0;margin:0">
                                                        {{$body}}@if($user_data->language == 'EN')
                                                            Please <a href="{{ route('verify_email', ['id' => $user_data->id]) }}">click here</a> to verify your email.
                                                        @else
                                                            Bitte <a href="{{ route('verify_email', ['id' => $user_data->id]) }}">klicken Sie hier</a>, um Ihre E-Mail-Adresse zu bestätigen.
                                                        @endif
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr style="display: flex;justify-content: center;">
                                                <td style="padding-bottom: 20px;" align="center" valign="top">
                                                    <p style="color:#09005D;font-family:Arial,Poppins,Helvetica,sans-serif;font-size:14px;font-weight:400;font-style:normal;letter-spacing:normal;line-height:18.4px;text-transform:none;text-align:center;padding:0;margin:0">
                                                    @if($user_data->language == 'EN')
                                                        Thanks
                                                    @else
                                                        Vielen Dank
                                                    @endif<br />
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size:1px;line-height:1px" height="50">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td style="font-size:1px;line-height:1px" height="50">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>