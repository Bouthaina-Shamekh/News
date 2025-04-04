$(document).ready(function() {
    $(".header--search-btn").click(function(event) {
        event.preventDefault(); // Prevent form submission

        $(".header--search-form").addClass("active");
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
        if(currentText == "Arabic"){
            $(this).text("English");
            $("#changeDirection").prop("disabled", false);
            $('html').attr('dir', 'rtl');
        }else{
            $(this).text("Arabic");
            $("#changeDirection").prop("disabled", true);
            $('html').attr('dir', 'ltr');
        }
    });
});


$(document).ready(function () {
    // Switch active tab on click
    $('.list--widget-nav .nav a').click(function (e) {
        e.preventDefault();
        $('.nav li').removeClass('active');
        $(this).parent('li').addClass('active');

        var target = $(this).attr('data-bs-target');
        $('.tab-pane').removeClass('fade show active');
        $(target).addClass('show active');
    });
});