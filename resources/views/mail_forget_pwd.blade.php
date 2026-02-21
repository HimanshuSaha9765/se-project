<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .otp {
            margin-top: 30px;
            text-align: center;
            font-size: 24px;
            color: #007bff;
        }

        .note {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>OTP Verification</h1>
        <p class="otp">Your OTP is: <strong>{{ $data2['otp'] }}</strong></p>
        <p class="note">Hi {{ $data2['name'] }}</p>
        <p class="note">Please use the above OTP to verify your account <a href="https://brightenergy.co.in/guest/verify_forget_pwd_otp/{{ $data2['email'] }}/{{ $data2['token'] }}">Click me</a> </p>
        {{-- <p class="note">Please use the above OTP to verify your account <a href="http://127.0.0.1:8000/guest/verify_forget_pwd_otp/{{ $data2['email'] }}/{{ $data2['token'] }}">Click me</a> </p> --}}
        <p class="note">The OTP is valid for 30 minutes. Please use forgot password facility again if the OTP has expired.</p>
        <p class="footer">Thank You 🙏🏻</p>
    </div>
</body>
</html>
