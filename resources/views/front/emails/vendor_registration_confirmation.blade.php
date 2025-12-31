<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Confirmation</title>
</head>
<body>
    <tr><td>Dear {{ $name }},</td></tr>
    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Thank you for registering as a vendor on {{ env('APP_NAME') }}.</td></tr>
    <tr><td>Please click the link below to confirm your email address:</td></tr>
    <tr><td><a href="{{ route('vendor.confirmation', ['code' => $code]) }}">Confirm Email Address</a></td></tr>
    <tr><td>&nbsp;<br>
    <tr><td>Best regards,</td></tr>
    <tr><td>{{ env('APP_NAME') }} Team</td></tr>
</body>
</html>