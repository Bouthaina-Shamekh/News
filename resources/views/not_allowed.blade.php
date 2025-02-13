<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>No Access</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, Helvetica, sans-serif
        }
        .main {
            text-align: center
        }
        .main img {
            width: 200px;
        }

        .main a {
            background: #d71d1d;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
            display: inline-block;
            transition: all .3s ease
        }

        .main a:hover {
            background: #893535;
        }
    </style>
</head>
<body>

    <div class="main">
        <img src="{{ asset('assets-dashboard/images/lock.png') }}" alt="">
        <h2>You Don't have access to this page</h2>
        <a href="{{ url('/') }}">Go To Home</a>
    </div>

</body>
</html>
