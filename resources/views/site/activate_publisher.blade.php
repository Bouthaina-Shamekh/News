


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Activate Publisher</title>
</head>
<body style="background: #eee; font-family: Arial, Helvetica, sans-serif">

    <div style="width: 600px; margin: 40px auto; background: #fff; border: 2px solid #d6d6d6; padding: 20px; font-family: Arial, sans-serif; direction: rtl; text-align: right;">
        <h2 style="color: #333;">مرحباً : {{ $publisher->name }}،</h2>

        <p>يسعدنا إبلاغك بأنه تم تفعيل حسابك بنجاح.</p>

        <p>للبدء في استخدام حسابك، يرجى الضغط على الزر أدناه للانتقال إلى لوحة التحكم الخاصة بك:</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('publisher.home') }}" style="background-color: #28a745; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-size: 16px;">
                الذهاب إلى لوحة التحكم
            </a>
        </div>

        <p>إذا لم تكن أنت من أنشأ هذا الحساب، يرجى تجاهل هذه الرسالة.</p>

        <br>
        <p>مع أطيب التحيات،</p>
        <p>فريق الدعم</p>
    </div>

</body>
</html>
