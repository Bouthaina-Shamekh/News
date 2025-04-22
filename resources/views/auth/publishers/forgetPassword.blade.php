@if ($errors->any())
<div class="alert alert-danger">
    <ol>
        @foreach ($errors->getMessages() as $key => $val)
        <li>{{ $key . " : " . $val[0] }} </li>
        @endforeach
    </ol>
</div>
@endif
<style>
    .password-container {
        position: relative;
    }

    .password-container input {
        width: 100%;
        padding-left: 35px;
        /* نترك مساحة للعين على اليسار */
        box-sizing: border-box;
        direction: rtl;
    }

    .toggle-password {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: #555;
        user-select: none;
    }

</style>
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
                    <h1 class="h1">نسيت كلمة المرور</h1>
                    <p>أدخل الإيميل الخاص بك حتى يرسل لك رابط تغيير كلمة المرور</p>
                </div>
                @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
                <form action="{{ route('publisher.forgot_password_store') }}" method="post" style="direction: rtl; text-align: right">
                    @csrf
                    <div class="form-group">
                        <label>
                            <span style="text-align: center">عنوان البريد الإلكتروني
                            </span>
                            <input type="email" name="email" id="email" class="form-control" required onkeyup="if (!window.__cfRLUnblockHandlers) return false; myFn2('email')" data-cf-modified-="" />
                        </label>
                    </div>
                    {{-- <div class="form-group" dir="rtl">
                        <label for="psw">كلمة المرور</label>
                        <div class="password-container">
                            <input type="password" id="psw" name="password" class="form-control" required>
                            <span class="toggle-password" onclick="togglePassword(this, 'psw')"><i class="fa fa-eye"></i></span>
                        </div>
                    </div> --}}
                    <button type="submit" class="btn btn-lg btn-block btn-primary">
                        ارسل
                    </button>
                    <p class="help-block clearfix">
                        <a href="{{ url(app()->getLocale() . '/publisher/register') }}" class="btn-link pull-right">إنشاء حساب</a>
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
{{-- <script>
    function togglePassword(el, inputId) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            el.innerHTML = '<i class="fa fa-eye-slash"></i> ';
        } else {
            input.type = 'password';
            el.innerHTML = '<i class="fa fa-eye"></i>';
        }
    }

</script> --}}
</body>

</html>
