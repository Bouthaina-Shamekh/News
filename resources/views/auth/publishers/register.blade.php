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
@push('styles')
<style>
    label {
        direction: rtl;
        text-align: right !important;
    }
</style>
@endpush
    <div id="preloader">
        <div class="preloader bg--color-1--b" data-preloader="1">
            <div class="preloader--inner"></div>
        </div>
    </div>
    <div class="wrapper">
        <div class="login--section pd--100-0 bg--overlay" data-bg-img="{{asset('assets/img/bg.jpg')}}">
            <div class="container">
                <div class="login--form">
                    <div class="title">
                        <h1 class="h1">تسجيل</h1>
                        <p>قم بالتسجيل للوصول إلى حسابك عن طريق ملء النموذج أدناه</p>
                    </div>
                    <form method="post" action="{{ route('register.store') }}" enctype="multipart/form-data"
                        style="direction: rtl; text-align: right">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <p style="color: red; float: left">*</p>
                                        هاتف
                                    </label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder=""
                                        required
                                        data-cf-modified-="" />
                                </div>
                                <div class="form-group">
                                    <label>
                                        <p style="color: red; float: left">*</p>
                                        البريد الإلكتروني
                                    </label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder=""
                                        required
                                        data-cf-modified-="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <p style="color: red; float: left">*</p>
                                        اسم المستخدم
                                    </label>
                                    <input type="text" class="form-control" name="id" style="display: none" value="0"
                                        placeholder="" style="display: none" />
                                    <input type="text" class="form-control" name="name" id="name" placeholder=""
                                        value=""
                                        data-cf-modified-="" required/>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <p style="color: red; float: left">*</p>
                                        تاريخ الميلاد
                                    </label>
                                    <input type="date" class="form-control" name="barth_date" id="barth_date"
                                        placeholder="تاريخ الاضافة" required data-cf-modified-="" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <p style="color: red; float: left">*</p>
                                        كلمة المرور
                                    </label>
                                    <input type="password" class="form-control" name="password" id="psw" placeholder=""
                                        onkeyup="if (!window.__cfRLUnblockHandlers) return false; cpass('');myFn2('psw')"
                                        required data-cf-modified-="" required />
                                </div>

                                <div class="form-group">
                                    <label>
                                        <p style="color: red; float: left">*</p>
                                        العنوان
                                    </label>
                                    <textarea rows="5" cols="5" class="form-control" name="address" id="address"
                                        required
                                        placeholder="" data-cf-modified-=""></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <p style="color: red; float: left">*</p>
                                        تأكيد كلمة المرور
                                    </label>
                                    <input type="password" class="form-control" name="confirm_password" id="cpsw"
                                        placeholder=""
                                        required data-cf-modified-="" required />
                                </div>
                                <div class="form-group">
                                    <label>عن الناشر</label>
                                    <textarea rows="5" cols="5" class="form-control" name="about" id="about" required
                                        placeholder="" data-cf-modified-=""></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        مرفقات
                                    </label>

                                    <input type="file" class="form-control" name="attachments" placeholder="" accept="image/*,application/pdf,application/msword,
  application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <p style="color: red; float: left">*</p>
                                        صورة شخصية
                                    </label>

                                    <input type="file" required class="form-control" name="pic" placeholder="" accept="image/*"
                                        />
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <p style="color: red" id="valid"></p>

                            <button type="submit" id="submit" class="btn btn-lg btn-block btn-primary">
                                تسجيل
                            </button>
                        </div>
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
