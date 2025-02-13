$(document).ready(function () {
    let currentStep = 1;
    const totalSteps = 8;

    function showStep(step) {
        // إظهار وإخفاء محتوى الخطوات
        $(".step-content").addClass("hidden");
        $(`.step-content[data-step="${step}"]`).removeClass("hidden");

        // تحديث مظهر شريط التقدم
        $(".progress-bar .progress-step").each(function (index) {
            if (index + 1 < step) {
                // الخطوات التي تم تجاوزها
                $(this)
                    .removeClass("bg-white border border-[#B2B2B2] text-[#B2B2B2]")
                    .addClass("bg-second text-white completed");
                
                // تغيير لون الخط بعد الخطوات المكتملة
                $(this).next(".progress-line").addClass("done");
            } else if (index + 1 === step) {
                // الخطوة الحالية
                $(this)
                    .removeClass("bg-white border border-[#B2B2B2] text-[#B2B2B2]")
                    .addClass("bg-second text-white p-2 relative after:absolute after:inset-0 after:-z-10 after:rounded-full after:border-2 after:border-second after:scale-125");
            } else {
                // الخطوات القادمة
                $(this)
                    .removeClass("bg-second text-white completed p-2 relative after:absolute after:inset-0 after:-z-10 after:rounded-full after:border-2 after:border-second after:scale-125")
                    .addClass("bg-white border border-[#B2B2B2] text-[#B2B2B2]");
                // إزالة اللون من الخط بعد الخطوات القادمة
                $(this).next(".progress-line").removeClass("done").addClass("");
            }
        });


        // تحديث الأزرار
        $("#prevBtn").prop("hidden", step === 1);
        $("#prevBtn").prop("disabled", step === 1);
        $("#nextBtnText").text(step === totalSteps ? "Submit" : "Next");
    }

    $("#nextBtn").on("click", function () {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        } else {
            // alert("Form submitted!"); // يمكنك استبدالها بمنطق إرسال البيانات
            window.location.href = "./our_comment.html";
        }
    });

    $("#prevBtn").on("click", function () {
        if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
        }
    });

    showStep(currentStep); // تهيئة الخطوة الأولى


    function convertToRtl(enabled) {
        if (enabled) {
            $('html').attr('dir', 'rtl');
            // $('.content-second').addClass('md:pl-8').removeClass('md:pr-8');
            // index
    
            // hero
            
        } else {
            $('html').attr('dir', 'ltr');
            // $('.content-second').removeClass('md:pl-8').addClass('md:pr-8');
        }
    }
    
    // true is rtl
    let lang = langApp;
    convertToRtl(!lang);
});