$(document).ready(function () {
    function convertToRtl(enabled) {
        if (enabled) {
            $('html').attr('dir', 'rtl');
            $('.content').addClass('text-right');
            $('.content-second').addClass('md:text-right').removeClass('md:text-left');
            // $('.content-second').addClass('md:pl-8').removeClass('md:pr-8');
            // index
    
            // hero
            
        } else {
            $('html').attr('dir', 'ltr');
            $('.content').removeClass('text-right');
            $('.content-second').removeClass('md:text-right').addClass('md:text-left');
            // $('.content-second').removeClass('md:pl-8').addClass('md:pr-8');
        }
    }
    
    // false is rtl
    let lang = langApp;
    console.log(lang);
    convertToRtl(!lang);
})