


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
</head>
<body style="background: #eee; font-family: Arial, Helvetica, sans-serif">

    <div style="width: 600px; margin: 40px auto; background: #fff; border: 2px solid #d6d6d6; padding: 20px">
        <h2>Dear Admin:</h2>
        <p>Hope this email find you will</p>
        <br>
        <p>There is new contact message with this information:</p>
        <p><b>Name:</b> <span style="color: rgb(48, 48, 48)">{{ $data['fristname'] }}</span></p>
        <p><b>Email:</b> <span style="color: rgb(48, 48, 48)"> {{ $data['email'] }}</span> </p>
        <p><b>Phone:</b> <span style="color: rgb(48, 48, 48)"> {{ $data['subject'] }}</span> </p>
        <p><b>Message:</b> <span style="color: rgb(48, 48, 48)"> {{ $data['msg'] }}</span> </p>

        <br>
        <p>Best Regards</p>
    </div>

</body>
</html>
