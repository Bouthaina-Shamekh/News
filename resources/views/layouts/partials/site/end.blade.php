<div id="stickySocial" class="sticky--right">
    <ul class="nav">
        <li>
            <a href="https://www.facebook.com/marena.post.news?locale=ar_AR">
                <i class="fa fa-facebook"></i>
                <span> Facebook</span>
            </a>
        </li>
        <li>
            <a href="https://www.instagram.com/mrynbwst/?hl=ar">
                <i class="fa fa-instagram"></i>
                <span> Instagram</span>
            </a>
        </li>

        <li>
            <a href="https://www.youtube.com/@marenapost">
                <i class="fa fa-youtube-play"></i>
                <span>Youtube Play</span>
            </a>
        </li>
    </ul>
</div>
<div id="backToTop">
    <a href="#">
        <i class="fa fa-angle-double-up"></i>
    </a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script>
    @if(app()->getLocale() == 'en')
    $("#toLang").text("Arabic");
    $("#changeDirection").prop("disabled", true);
    $('html').attr('dir', 'rtl');
    @else
    $("#toLang").text("English");
    $("#changeDirection").prop("disabled", false);
    $('html').attr('dir', 'ltr');
    @endif
</script>
@stack('scripts')
</body>

</html>
