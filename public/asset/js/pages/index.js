
// <!-- Hero -->
$(document).ready(function () {
    // استهداف جميع عناصر الفقرات داخل القسم
    const $paragraphs = $('#hero-texts .hero-paragraph');
    const totalParagraphs = $paragraphs.length;
    let currentIndex = 0;
    const $progressBar = $('#progress-bar');
    
    // وظيفة لتحديث الفقرة الظاهرة وشريط التقدم
    function updateParagraph(index) {
        $paragraphs.hide().eq(index).fadeIn(); // إخفاء جميع الفقرات وإظهار الحالية
        $progressBar.css('width', `${((index + 1) / totalParagraphs) * 100}%`); // تحديث عرض شريط التقدم
    }
    
    // الانتقال إلى الفقرة التالية
    function nextParagraph() {
        currentIndex = (currentIndex + 1) % totalParagraphs;
        updateParagraph(currentIndex);
    }
    
    // الانتقال إلى الفقرة السابقة
    function prevParagraph() {
        currentIndex = (currentIndex - 1 + totalParagraphs) % totalParagraphs;
        updateParagraph(currentIndex);
    }

    // ربط الأزرار بوظائف التنقل
    $('#next-btn').on('click', nextParagraph);
    $('#prev-btn').on('click', prevParagraph);

    // التبديل التلقائي كل 3 ثوانٍ
    setInterval(nextParagraph, 3000);

    // إظهار الفقرة الأولى عند بدء التشغيل
    updateParagraph(currentIndex);
});


// <!-- About -->

// دالة العد التدريجي
function animateCounter(element) {
    const target = parseInt(element.getAttribute("data-target")); // قيمة الهدف
    const duration = 2; // مدة العد
    const increment = target / (duration * 60); // زيادة تدريجية (60 إطار في الثانية)

    let count = 0; // بدء العد
    const updateCounter = () => {
        count += increment; // زيادة تدريجية
        if (count >= target) {
            count = target; // توقف عند الهدف
            gsap.ticker.remove(updateCounter); // إيقاف التحديث
        }
        element.textContent = Math.floor(count); // تحديث النص
    };

    gsap.ticker.add(updateCounter); // تحديث عند كل إطار
}
// تفعيل العد عند وصول العنصر
document.querySelectorAll('.counter').forEach(counter => {
    ScrollTrigger.create({
        trigger: counter,
        start: "top 85%", // يبدأ عند وصول العنصر إلى الشاشة
        onEnter: () => animateCounter(counter), // يبدأ العد عند الوصول
    });
});


// <!-- Files -->

$(document).ready(function () {
    // استهداف الحاوية التي تحتوي على العناصر
    const $itemsContainer = $('#files_view');
    const $items = $itemsContainer.children();
    const itemsPerPage = 6; // عدد العناصر في كل صفحة
    const totalItems = $items.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    let currentPage = 0;

    // عناصر التحكم
    const $progressBar = $('#progress-bar-files');
    const $prevBtn = $('#prev-btn-files');
    const $nextBtn = $('#next-btn-files');

    // تحديث العرض وشريط التقدم
    function updateDisplay() {
        // إخفاء كل العناصر
        $items.hide();

        // إظهار العناصر التي تخص الصفحة الحالية
        const startIndex = currentPage * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, totalItems);
        $items.slice(startIndex, endIndex).fadeIn();

        // تحديث شريط التقدم
        const progressWidth = ((currentPage + 1) / totalPages) * 100;
        $progressBar.css('width', `${progressWidth}%`);
    }

    // الانتقال إلى الصفحة التالية
    function nextPage() {
        if (currentPage < totalPages - 1) {
            currentPage++;
            updateDisplay();
        }
    }

    // الانتقال إلى الصفحة السابقة
    function prevPage() {
        if (currentPage > 0) {
            currentPage--;
            updateDisplay();
        }
    }

    // ربط الأزرار بوظائف التنقل
    $nextBtn.on('click', nextPage);
    $prevBtn.on('click', prevPage);

    // عرض الصفحة الأولى عند بدء التشغيل
    updateDisplay();
});



// <!-- works -->

const swiper = new Swiper('.slider-wrapper', {
    loop: true,
    grabCursor: true,
    spaceBetween: 30,

    // Pagination bullets
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: true
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // Responsive breakpoints
    breakpoints: {
        0: {
            slidesPerView: 1
        },
        768: {
            slidesPerView: 2
        },
        1024: {
            slidesPerView: 3
        },
        1200: {
            slidesPerView: 4
        }
    }
});


// <!-- out team -->

const content = document.querySelector('.scroll-wrapper');
const overlay = document.createElement('div');

// إضافة الشريط الشفاف كطبقة فوق المحتوى
overlay.classList.add('scroll-overlay');
document.querySelector('.scroll-wrapper').appendChild(overlay);

let isScrolling = false;
let startX;
let scrollLeft;

// أحداث الفأرة للتحكم بالتمرير
overlay.addEventListener('mousedown', (e) => {
    isScrolling = true;
    startX = e.pageX - overlay.offsetLeft;
    scrollLeft = content.scrollLeft;
});

overlay.addEventListener('mouseleave', () => {
    isScrolling = false;
});

overlay.addEventListener('mouseup', () => {
    isScrolling = false;
});

overlay.addEventListener('mousemove', (e) => {
    if (!isScrolling) return;
    const x = e.pageX - overlay.offsetLeft;
    const walk = (x - startX) * 2; // تعديل سرعة التمرير
    content.scrollLeft = scrollLeft - walk;
});


// التعديل على الحجم
$(document).ready(function() {
    // حدد القسم المستهدف
    let recCount = $(".scroll-wrapper .content .rec").length;
    let imgCount = $(".scroll-wrapper .content img").length;

    let widthContent = (recCount * 270) + ((recCount - 1) * 200);
    $(".scroll-wrapper .content").width(widthContent);           
});


// <!-- client's feedback -->
$(document).ready(function () {
    const slider = $('#image-slider');
    const reviews = $(".review");
    function updateContent(clientId) {
        reviews.removeClass("active");
        $(`.review[data-client="${clientId}"]`).addClass("active");
    }

    slider.on('click', 'img', function () {
        const clicked = $(this); // العنصر الذي تم النقر عليه
        const currentActive = slider.find('.active'); // العنصر النشط حالياً
        const clientId = $(this).data('client');
        if (!clicked.hasClass('active')) {
            currentActive.removeClass('active').addClass('inactive'); // اجعل العنصر النشط الحالي غير نشط
            clicked.removeClass('inactive').addClass('active'); // اجعل العنصر الذي تم النقر عليه نشطاً

            const clickedIndex = clicked.index();
            const totalImages = slider.children().length;

            const centerIndex = 2; // الموقع الثالث (0-based index)
            const offset = clickedIndex - centerIndex;

            const reorderedImages = [];

            // إضافة تأثيرات الحركة قبل الترتيب
            slider.children().each(function (index) {
                if (index < clickedIndex) {
                    $(this).addClass('slide-left'); // إزاحة لليسار
                } else if (index > clickedIndex) {
                    $(this).addClass('slide-right'); // إزاحة لليمين
                }
            });

            setTimeout(() => {
                // إعادة ترتيب الصور
                for (let i = 0; i < totalImages; i++) {
                    const newIndex = (i - offset + totalImages) % totalImages;
                    reorderedImages[newIndex] = slider.children().eq(i);
                }

                slider.empty();
                reorderedImages.forEach(img => {
                    $(img).removeClass('slide-left slide-right').addClass('fade-in'); // تأثير الظهور
                    slider.append(img);
                });
                // الانتظار لمدة 5 ثوانٍ قبل إزالة تأثير الظهور
                setTimeout(() => {
                    reorderedImages.forEach(img => {
                        $(img).removeClass('fade-in'); // تأثير الظهور
                    });
                }, 3000); // 5000ms = 5 ثوانٍ
            }, 300); // الانتظار لإنهاء الحركة
        }
        updateContent(clientId);  // تحديث النصوص
    });
});
$(document).ready(function () {
    // كتابة النص العلوي
    let words = [];
    let i = 0;
    let j = 0;
    let currentWord = "";
    let isDeleting = false;

    function wirteWord(lang){
        // جلب الكلمات من HTML
        words = [];
        $("#word-list span." + lang).each(function () {
            words.push($(this).text());
        });
    }
    function type() {
        currentWord = words[i];
        if (isDeleting) {
            $("#typewriter_hero").text(currentWord.substring(0, j - 1));
            j--;
            if (j == 0) {
                isDeleting = false;
                i++;
                if (i == words.length) {
                    i = 0;
                }
            }
        } else {
            $("#typewriter_hero").text(currentWord.substring(0, j + 1));
            j++;
            if (j == currentWord.length) {
                isDeleting = true;
            }
        }
        setTimeout(type, 300);
    }
    wirteWord('en');
    type()
    function convertToRtl(enabled) {
        if (enabled) {
            $('html').attr('dir', 'rtl');
            // index
    
            // hero
            $('.img__hero img').css('transform', 'rotateY(180deg)');
            $('#hero-title').text('جرب فكرتك');
            $('#word-list span.ar').slideDown();
            $('#word-list span.en').slideUp();
            wirteWord('ar');
            type();
    
            // about
            $('.partial__about').removeClass('-left-[11rem]');
            $('.partial__about').addClass('-right-[17rem]');
            $('.partial__about').addClass('!rotate-180');
            $('.content').addClass('text-right');

    
            // Services
            $('.img__service:eq(1) img').css('transform', 'rotateY(180deg)');
            $('#services .part').css('transform', 'rotateY(180deg)');
            $('#services .part').removeClass('right-0');
            $('#services .part').addClass('left-0');
    
            // Files
            $('#files .partial__files').addClass('!rotate-180');
            $('#files .partial__files').removeClass('left-0');
            $('#files .partial__files').addClass('right-0');
            $('#files .div').removeClass('md:text-left');
            $('#files .div').addClass('md:text-right');
            $('#files .div .img-about').removeClass('md:pr-10');
            $('#files .div .img-about').addClass('md:pl-10');
            $('#files .div img').css('transform', 'rotateY(180deg)');
    
            // Other
            $('#partners').css('direction', 'ltr');
            $('#works').css('direction', 'ltr');
            $('#works h2').removeClass('md:text-left').addClass('md:text-right');
            $('#works .swiper-slide').removeClass('items-start').addClass('items-end');
            $('#teams').css('direction', 'ltr');
            $('#clients').css('direction', 'ltr');
        } else {
            $('html').attr('dir', 'ltr');
    
            // hero
            $('.img__hero img').css('transform', 'rotateY(0deg)');
            $('#hero-title').text('Test Your');
            $('#word-list span.ar').slideUp();
            $('#word-list span.en').slideDown();
            wirteWord('en');
            type();
    
            // about
            $('.partial__about').addClass('-left-[11rem]');
            $('.partial__about').removeClass('-right-[17rem]');
            $('.partial__about').removeClass('!rotate-180');
            $('.content').removeClass('text-right');
    
            // Services
            $('.img__service:eq(1) img').css('transform', 'rotateY(0deg)');
            $('#services .part').css('transform', 'rotateY(0deg)');
            $('#services .part').addClass('right-0');
            $('#services .part').removeClass('left-0');
    
            // Files
            $('#files .partial__files').removeClass('!rotate-180');
            $('#files .partial__files').addClass('left-0');
            $('#files .partial__files').removeClass('right-0');
            $('#files .div').addClass('md:text-left');
            $('#files .div').removeClass('md:text-right');
            $('#files .div .img-about').addClass('md:pr-10');
            $('#files .div .img-about').removeClass('md:pl-10');
            $('#files .div img').css('transform', 'rotateY(0deg)');
    
            // Other
            // $('#partners').css('direction', 'rtl');
            // $('#works').css('direction', 'rtl');
            $('#works h2').addClass('md:text-left').removeClass('md:text-right');
            $('#works .swiper-slide').addClass('items-start').removeClass('items-end');
            // $('#teams').css('direction', 'rtl');
            // $('#clients').css('direction', 'rtl');
        }
    }
    
    // true is rtl
    let lang = langApp;

    convertToRtl(!lang);
});

