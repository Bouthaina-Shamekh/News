// top__content , img__content ,bottom__content ,right__content
sr.reveal(`.top__content`);
sr.reveal(`.img__content`, { origin: 'left' });
sr.reveal(`.right__content`, { origin: 'right' , interval: 150});
sr.reveal(`.bottom__content`, { origin: 'bottom' });


$(document).ready(function () {
    function convertToRtl(enabled) {
        if (enabled) {
            $('html').attr('dir', 'rtl');
            $('.content').addClass('text-right');
            
        } else {
            $('html').attr('dir', 'ltr');
            $('.content').removeClass('text-right');
        }
    }
    
    // true is rtl
    let lang = langApp;


    convertToRtl(!lang);
})