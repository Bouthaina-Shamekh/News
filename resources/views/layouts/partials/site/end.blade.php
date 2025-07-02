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
<!-- Include CSS & JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('assets-new/js/script.js') }}"></script>
<script>
    const siteName = "مارينا بوست";
    const siteURL = "{{ config('app.url', 'https://marenapost.com/') }}";
    document.addEventListener('copy', function(e)  {
        const selection = window.getSelection().toString();

        if (!selection) return; // إذا ما في نص محدد ما نكمل

        const textToAdd = `\n\n📌 تم النسخ من: ${siteName} - ${siteURL}`;

        const modifiedText = selection + textToAdd;

        e.preventDefault(); // نوقف السلوك الافتراضي
        e.clipboardData.setData('text/plain', modifiedText);
    });

    document.addEventListener('cut', function(e) {
        const selection = window.getSelection().toString();

        if (!selection) return;

        const textToAdd = `\n\n📌 تم النسخ من: ${siteName} - ${siteURL}`;

        const modifiedText = selection + textToAdd;

        e.preventDefault();
        e.clipboardData.setData('text/plain', modifiedText);
    });
</script>
@stack('scripts')
</body>

</html>
