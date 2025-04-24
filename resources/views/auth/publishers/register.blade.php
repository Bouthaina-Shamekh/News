@include('layouts.partials.site.head')
<style>
    label {
        direction: rtl;
        text-align: right !important;
    }

    .invalid-feedback {
        color: red;
    }

</style>
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
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
        background-color: transparent;
        opacity: 1;
    }
</style>
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
                <form method="post" action="{{ route('register.store') }}" enctype="multipart/form-data" style="direction: rtl; text-align: right">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    <p style="color: red; float: left">*</p>
                                    هاتف
                                </label>
                                <input type="text" value="{{ old('phone') }}" class="form-control" name="phone" id="phone" placeholder="" required />
                            </div>
                            <div class="form-group">
                                <x-form.input name="email" label="{{ __('admin.Email') }}" :re="true" type="email" placeholder="{{ __('admin.enter publisher email') }}" required :value="old('email')" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    <p style="color: red; float: left">*</p>
                                    اسم المستخدم
                                </label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ old('name') }}" required />
                            </div>
                            <div class="form-group">
                                <label>
                                    <p style="color: red; float: left">*</p>
                                    تاريخ الميلاد
                                </label>
                                <input type="date" placeholder="mm/dd/yyyy" value="{{ old('barth_date') }}" class="form-control" name="barth_date" id="barth_date" placeholder="تاريخ الاضافة" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" dir="rtl">
                                <label for="psw">كلمة المرور</label>
                                <div class="password-container">
                                    <input type="password" id="psw" name="password" class="form-control" required>
                                    <span class="toggle-password" onclick="togglePassword(this, 'psw')"><i class="fa fa-eye"></i></span>
                                </div>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>
                                    <p style="color: red; float: left">*</p>
                                    العنوان
                                </label>
                                <textarea rows="5" cols="5" class="form-control" name="address" id="address" required placeholder="" data-cf-modified-="">{{ old('address') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" dir="rtl">
                                <label for="cpsw">تأكيد كلمة المرور</label>
                                <div class="password-container">
                                    <input type="password" id="cpsw" name="confirm_password" class="form-control" required>
                                    <span class="toggle-password" onclick="togglePassword(this, 'cpsw')"><i class="fa fa-eye"></i></span>
                                </div>
                                @error('confirm_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>عن الناشر</label>
                                <textarea rows="5" cols="5" class="form-control" name="about" id="about" placeholder="" data-cf-modified-="">{{ old('about') }}</textarea>
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
  application/vnd.openxmlformats-officedocument.wordprocessingml.document" value="{{ old('attachments') }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>
                                    <p style="color: red; float: left">*</p>
                                    صورة شخصية
                                </label>
                                <input type="file" value="{{ old('pic') }}" required class="form-control" name="pic" placeholder="" accept="image/*" />
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <p style="color: red" id="valid"></p>

                        <button type="submit" id="submit" class="btn btn-lg btn-block btn-primary">
                            تسجيل
                        </button>
                        <a href="{{ route('login') }}" class="btn-link pull-right">تسجيل دخول</a>
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

<script>
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

</script>
<!-- Include CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- Initialize -->
<script>
// تطبيق Flatpickr على كل الحقول من نوع date
document.addEventListener("DOMContentLoaded", function () {
  // اختار كل الحقول التي نوعها date أو تحتوي كلاس مخصص للتاريخ
  const dateInputs = document.querySelectorAll('input[type="date"], input.datepicker');

  dateInputs.forEach(function (input) {
    flatpickr(input, {
      dateFormat: "m/d/Y", // التنسيق الذي يظهر للمستخدم
      locale: "en",
      onChange: function(selectedDates, dateStr, instance) {
        // هنا يتم تحويل التاريخ من "mm/dd/yyyy" إلى "yyyy-mm-dd"
        const formattedDate = formatDateToISO(dateStr);
        input.value = formattedDate; // تعيين القيمة المعدلة للحقول
      }
    });
  });
});

// دالة لتنسيق التاريخ إلى الشكل الذي يعتمده السيرفر "yyyy-mm-dd"
function formatDateToISO(dateStr) {
  const [month, day, year] = dateStr.split('/');
  return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
}


</script>
</body>

</html>
