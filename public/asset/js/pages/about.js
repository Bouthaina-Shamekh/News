function animateCounter(element) {
    const target = parseInt(element.getAttribute("data-target"));
    let count = 0;
    const interval = setInterval(() => {
        count += Math.ceil(target / 100); // زيادة تدريجية
        if (count >= target) {
            count = target;
            clearInterval(interval);
        }
        element.textContent = count;
    }, 50); // سرعة العد
}

ScrollReveal().reveal('.counter', {
    beforeReveal: function (el) {
        animateCounter(el);
    }
});

sr.reveal(`.top__section_second`);
sr.reveal(`.left__section__second`, { origin: 'left' });
sr.reveal(`.img__section__second`, { origin: 'bottom' });

function convertToRtl(enabled) {
    if (enabled) {
        $('html').attr('dir', 'rtl');
        $('.content').addClass('text-right');
        $('.content-second').addClass('md:text-right').removeClass('md:text-left');
        $('.content-second').addClass('md:pl-8').removeClass('md:pr-8');
        // index

        // hero
        
    } else {
        $('html').attr('dir', 'ltr');
        $('.content').removeClass('text-right');
        $('.content-second').removeClass('md:text-right').addClass('md:text-left');
        $('.content-second').removeClass('md:pl-8').addClass('md:pr-8');
    }
}

// true is rtl
let lang = langApp;
convertToRtl(!lang);