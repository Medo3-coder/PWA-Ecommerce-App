<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .break-all {
            word-break: break-all;
        }
    </style>
</head>
<body>
    <h1>Hello!</h1>

    <p>You requested a password reset for your account. To reset your password, please click the button below:</p>

    <!-- Action Button -->
    <a href="{{ url('api/password-reset/'.$token) }}" class="button">
        Reset Password
    </a>

    <!-- Outro Lines -->
    <p>If you did not request a password reset, please ignore this email.</p>

    <!-- Salutation -->
    <p>Regards,<br>{{ config('app.name') }}</p>

    <!-- Subcopy -->
    <p>
        If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
        <br>
        <a href="{{ url('api/password-reset/'.$token) }}" class="break-all">
            {{ url('api/password-reset/'.$token) }}
        </a>
    </p>
</body>
</html>
