@if ($errors->any())
<div class="alert alert-danger" >
    <ol>
        @foreach ($errors->getMessages() as $key => $val)
            <li>{{ $key . " : " . $val[0] }} </li>
        @endforeach
    </ol>
</div>
@endif
@include('layouts.partials.site.head')
    <div id="preloader">
        <div class="preloader bg--color-1--b" data-preloader="1">
            <div class="preloader--inner"></div>
        </div>
    </div>
    <div class="wrapper">
        <div class="login--section pd--100-0 bg--overlay" data-bg-img="{{ asset('assets/img/bg.jpg') }}">
            <div class="container">
                <div class="login--form">
                    <div class="title">
                        <h1 class="h1">تسجيل الدخول</h1>
                        <p>تسجيل الدخول إلى الحساب عن طريق ملء النموذج أدناه</p>
                    </div>
                    <form action="{{ route('login.store') }}" method="post" style="direction: rtl; text-align: right">
                        @csrf
                        <div class="form-group">
                            <label>
                                <span style="text-align: center">اسم المستخدم أو عنوان البريد الإلكتروني
                                </span>
                                <input type="email" name="email" id="email" class="form-control" required
                                    onkeyup="if (!window.__cfRLUnblockHandlers) return false; myFn2('email')"
                                    data-cf-modified-="" />
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                <span style="text-align: center">كلمة المرور</span>
                                <input type="password" name="password" id="password" class="form-control" required
                                    onkeyup="if (!window.__cfRLUnblockHandlers) return false; myFn2('password')"
                                    data-cf-modified-="" />
                            </label>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-primary">
                            تسجيل الدخول
                        </button>
                        <p class="help-block clearfix">
                            <a href="#" class="btn-link pull-left">هل نسيت إسم المستخدم أو كلمة السر؟</a>
                            <a href="{{ route('register.store') }}" class="btn-link pull-right">إنشاء حساب</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.sticky.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.hoverIntent.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.marquee.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/isotope.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/resizesensor.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/theia-sticky-sidebar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.zoom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.barrating.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/retina.min.js') }}" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK9f7sXWmqQ1E-ufRXV3VpXOn_ifKsDuc" type="text/javascript"></script>
    <script src="{{ asset('assets/js/main.js') }}" type="text/javascript"></script>
    <script src="/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js" data-cf-settings="|49" defer></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"9120635dabb7b37f","version":"2025.1.0","r":1,"token":"602890b0b80540f5a9da77dde812b1ae","serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}}}' crossorigin="anonymous"></script>
</body>

</html>
