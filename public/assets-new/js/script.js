$(document).ready(function() {
    $(".header--search-btn").click(function(event) {
        // event.preventDefault(); // Prevent form submission

        $(".header--search-form").addClass("active");
        $('.btn-header-1').hide();
        $('.btn-header-2').show();
        // $(this).attr('type','submit');
    });

    // Remove 'active' class when clicking outside the form
    $(document).click(function(event) {
        if (!$(event.target).closest(".header--search-form").length) {
            $(".header--search-form").removeClass("active");
        }
    });
});



$(document).ready(function() {
    $(".dropdown-toggle").click(function(event) {
        event.preventDefault(); // Prevent default link behavior

        // Toggle 'open' class on parent <li>
        $(this).parent(".dropdown").toggleClass("open");
    });

    // Remove 'open' class when clicking outside
    $(document).click(function(event) {
        if (!$(event.target).closest(".dropdown").length) {
            $(".dropdown").removeClass("open");
        }
    });
});



$(document).ready(function() {
    $(".navbar-toggle").click(function(event) {
        event.preventDefault(); // Prevent default behavior

        // Toggle class on navbar-header when button is clicked
        $(".navbar-collapse").toggleClass("in");
    });


    // When clicking the close button, remove "open" class
    $(".close-menu").click(function() {
        $(".navbar-collapse").removeClass("in");
    });

});

// Click outside the menu to close it
$(document).click(function(event) {
    if (!$(event.target).closest(".navbar-collapse, .navbar-toggle").length) {
        $(".navbar-collapse").removeClass("in");
    }
});

$(document).ready(function() {
    $("#toLang").click(function() {
        let currentText = $(this).text();
        if(currentText == "العربية"){
            $(this).text("English");
            $("#changeDirection").prop("disabled", false);
            $('html').attr('dir', 'rtl');
        }else{
            $(this).text("العربية");
            $("#changeDirection").prop("disabled", true);
            $('html').attr('dir', 'ltr');
        }
    });
});


$(document).ready(function () {
    // Switch active tab on click
    $('.list--widget-nav-1 .nav a').click(function (e) {
        e.preventDefault();
        $('.list--widget-nav-1 .nav li').removeClass('active');
        $(this).parent('li').addClass('active');

        var target = $(this).attr('data-bs-target');
        $('#nav-tabContent .tab-pane').removeClass('fade show active');
        $(target).addClass('show active');
    });
    $('.list--widget-nav-2 .nav a').click(function (e) {
        e.preventDefault();
        $('.list--widget-nav-2 .nav li').removeClass('active');
        $(this).parent('li').addClass('active');

        var target = $(this).attr('data-bs-target');
        $('#nav-tabContent2 .tab-pane').removeClass('fade show active');
        $(target).addClass('show active');
    });
});

 // Function to update the date and time every second
function updateDateTime() {
    const now = new Date();
    const options = {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    };
    const formatted = now.toLocaleString('en-US', options);
    document.getElementById('datetime').innerText = formatted;
}

setInterval(updateDateTime, 1000);
updateDateTime(); // Run immediately

// end of date and time function

// Function to update the weatherwidget every second
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
// end of weather widget function


// تطبيق Flatpickr على جميع الحقول عند تحميل الصفحة
document.addEventListener("DOMContentLoaded", function () {
    const dateInputs = document.querySelectorAll('input[type="date"], input.datepicker, input.flatpickr-input');

    dateInputs.forEach(function (input) {
      flatpickr(input, {
        altInput: true, // إنشاء حقل عرض بديل للمستخدم
        altFormat: "m/d/Y", // عرض للمستخدم بصيغة mm/dd/yyyy (تصحيح الكومنت كمان)
        dateFormat: "Y-m-d", // القيمة المخزنة في input الأساسي hidden بصيغة yyyy-mm-dd
        locale: "en", // لغة التقويم
        allowInput: true, // عدم السماح بالكتابة اليدوية
        defaultDate: input.value ? input.value.replace(/\//g, "-") : null, // تأكد من تنسيق التاريخ عند الفتح
        onReady: function (selectedDates, dateStr, instance) {
          if (instance.altInput) {
            instance.altInput.setAttribute('required', 'true'); // إضافة required للحقل الظاهر
            instance.altInput.setAttribute('tabindex', '0'); // للتنقل الصحيح بلوحة المفاتيح
            instance.altInput.setAttribute('placeholder', 'mm/dd/yyyy'); // placeholder واضح
          }
        },
        onChange: function (selectedDates, dateStr, instance) {
          if (selectedDates.length > 0) {
            const dateObj = selectedDates[0];
            const year = dateObj.getFullYear();
            const month = String(dateObj.getMonth() + 1).padStart(2, '0');
            const day = String(dateObj.getDate()).padStart(2, '0');
            input.value = `${year}-${month}-${day}`; // تخزين التاريخ بشكل yyyy-mm-dd داخل input الأصلي
          } else {
            input.value = ''; // لو مسح المستخدم التاريخ
          }
        }
      });
    });
  });
