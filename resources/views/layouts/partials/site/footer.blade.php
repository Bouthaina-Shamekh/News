<footer class="footer--section">
    @php
        $settings = App\Models\Setting::get();
    @endphp
    <div class="footer--widgets pd--30-0 bg--color-2">
        <div class="container">
            <div class="row AdjustRow">
                <div class="col-md-6 col-xs-6 col-xxs-12 ptop--30 pbottom--30 text_dir">
                    <div class="widget" style="direction: rtl">
                        <div class="widget--title">
                            <h2 class="h4">معلومات عنا</h2>
                            <i class="icon fa fa-exclamation"></i>
                        </div>
                        <div class="about--widget">
                            <div class="content">
                                <p>
                                    {{ $settings->where('key',$title)->first() ? $settings->where('key',$title)->first()->value : '' }}
                                </p>
                            </div>
                            <div class="action">
                                <a href="about" class="btn-link">
                                    اقرأ أكثر <i class="fa flm fa-angle-double-right"></i>
                                </a>
                            </div>
                            <ul class="nav footer_nav">
                                <li>
                                    <i class="fa fa-map"></i>
                                    <span> فلسطين </span>
                                </li>
                                <li>
                                    <i class="fa fa-envelope-o"></i>
                                    <a
                                        href="/cdn-cgi/l/email-protection#e28b8c848da28f8390878c83928d9196cc818d8f">
                                        <span class="__cf_email__"
                                            data-cfemail="a8c1c6cec7e8c5c9dacdc6c9d8c7dbdc86cbc7c5">[email&#160;protected]</span>
                                    </a>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <a href="tel:<soon">soon</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6 col-xxs-12 ptop--30 pbottom--30 text_dir"
                    style="direction: rtl">
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">روابط معلومات مفيدة</h2>
                            <i class="icon fa fa-expand"></i>
                        </div>
                        <div class="links--widget">
                            <ul class="nav">
                                <li>
                                    <a href="about" class="fa-angle-right"> من نحن </a>
                                </li>
                                <li>
                                    <a href="news" class="fa-angle-right">اخبار </a>
                                </li>
                                <li>
                                    <a href="#" class="fa-angle-right"> العالم </a>
                                </li>
                                <li>
                                    <a href="#" class="fa-angle-right">رياضة</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer--copyright bg--color-3">
        <div class="social--bg bg--color-1"></div>
        <div class="container">
            <p class="text float--left" style="color: #fff">
                &copy; 2022 <a href="#" style="color: white">مارينا بوست</a>.
                All Rights Reserved.
            </p>

            <ul class="nav links float--right" style="color: #fff">
                <li>
                    <a href="termofservice">السياسة و الخصوصية </a>
                </li>
                <li>
                    <a href="home.html">الرئيسية</a>
                </li>
            </ul>
        </div>
    </div>
</footer>
