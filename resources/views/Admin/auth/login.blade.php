<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>لوحة التحكم | تسجيل الدخول</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
    <style>
        .toast-container {
            float: left !important;
        }

        html {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(#141e30, #243b55);
        }

        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 400px;
            padding: 40px;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, .5);
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
            border-radius: 10px;
        }

        .login-box h3 {
            margin: 0 0 30px;
            padding: 0;
            color: #fff;
            text-align: center;
        }

        .login-box .user-box {
            position: relative;
        }

        .login-box .user-box input {
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #fff;
            outline: none;
            background: transparent;
        }

        .login-box .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            padding: 10px 0;
            font-size: 16px;
            color: #fff;
            pointer-events: none;
            transition: .5s;
        }

        .login-box .user-box input:focus ~ label,
        .login-box .user-box input:valid ~ label {
            top: -20px;
            left: 0;
            color: #FFC05E;
            font-size: 12px;
        }

        .login-box form button {
            position: relative;
            display: inline-block;
            padding: 5px 20px;
            color: #FFC05E;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            background-color: transparent;
            border: 0px;
            transition: .5s;
            font-family: 'Cairo',sans-serif;
            margin-top: 40px;
            letter-spacing: 1px
        }

        .login-box button:hover {
            background: #FFC05E;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 1px #FFC05E, 0 0 1px #FFC05E, 0 0 20px #FFC05E, 0 0 100px #FFC05E;
        }

        .login-box button span {
            position: absolute;
            display: block;
        }

        .login-box button span:nth-child(1) {
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #FFC05E);
            animation: btn-anim1 1s linear infinite;
        }

        @keyframes btn-anim1 {
            0% {
                left: -100%;
            }
            50%, 100% {
                left: 100%;
            }
        }

        .login-box button span:nth-child(2) {
            top: -100%;
            right: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(180deg, transparent, #FFC05E);
            animation: btn-anim2 1s linear infinite;
            animation-delay: .25s
        }

        @keyframes btn-anim2 {
            0% {
                top: -100%;
            }
            50%, 100% {
                top: 100%;
            }
        }

        .login-box button span:nth-child(3) {
            bottom: 0;
            right: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(270deg, transparent, #FFC05E);
            animation: btn-anim3 1s linear infinite;
            animation-delay: .5s
        }

        @keyframes btn-anim3 {
            0% {
                right: -100%;
            }
            50%, 100% {
                right: 100%;
            }
        }

        .login-box button span:nth-child(4) {
            bottom: -100%;
            left: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(360deg, transparent, #FFC05E);
            animation: btn-anim4 1s linear infinite;
            animation-delay: .75s
        }

        @keyframes btn-anim4 {
            0% {
                bottom: -100%;
            }
            50%, 100% {
                bottom: 100%;
            }
        }
        .error{
            background-color: #dc3545!important;
            text-align: center;
            color: white;
            max-width: 50%;
            margin: auto;
            border-radius: 20px;
        }
        .error p{
            padding: 2px;
        }
    </style>
    <link href="{{asset('uploads/logo.png')}}" rel="icon">
</head>
@if (\Session::has('error'))
    <div class="error">
        <p>{!! \Session::get('error') !!}</p>
    </div>
@endif
<body>
<div class="login-box">
    <h3>
        <img src="{{asset('uploads/logo.png')}}" style="height: 110px; width:110px"><br>
    </h3>
    <form method="POST" action="{{route('do-log')}}">
        @csrf
        <div class="user-box">
            <input type="email" name="email" required autocomplete="off">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" autocomplete="off" required>
            <label>Password</label>
        </div>
        <button type="submit">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Login
        </button>
    </form>
</div>
</body>
</html>
