<footer class="footer--section">
    <div class="footer--widgets pd--30-0 bg--color-2">
        <div class="container">
            <div class="row AdjustRow">
                <div class="col-md-6 col-xs-6 col-xxs-12 ptop--30 pbottom--30 text_dir">
                    <div class="widget" style="direction: rtl;">
                        <div class="widget--title">
                            <h2 class="h4">
                                 {{-- معلومات عنا  --}}
                                 {{__('site.About')}}
                            </h2>
                            <i class="icon fa fa-exclamation"></i>
                        </div>
                        @php
                        $setting = \App\Models\Setting::get();
                        @endphp
                        <div class="about--widget">
                            <div class="content">
                                <p>
                                    @if(app()->getLocale() == 'ar')
                                        {!! $setting->where('key', 'about_ar')->first() ? $setting->where('key', 'about_ar')->first()->value : '' !!}
                                    @else
                                        {!! $setting->where('key', 'about_en')->first() ? $setting->where('key', 'about_en')->first()->value : '' !!}
                                    @endif
                                </p>
                            </div>
                            <div class="action">
                                <a href="{{route('site.about')}}" class="btn-link">
                                    {{-- اقرأ أكثر --}}
                                    {{__('site.read_more')}}
                                    <i class="fa flm fa-angle-double-right"></i>
                                </a>
                            </div>

                            <ul class="nav footer_nav">
                                <li>
                                    <i class="fa fa-map"></i>
                                    <span>
                                        فلسطين
                                    </span>
                                </li>
                                <li>
                                    <i class="fa fa-envelope-o"></i>

                                    <span class="__cf_email__"
                                        data-cfemail="a8c1c6cec7e8c5c9dacdc6c9d8c7dbdc86cbc7c5">{!! $setting->where('key', 'contact_email')->first() ? $setting->where('key', 'contact_email')->first()->value : '' !!}</span>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <span href="tel:{{ $setting->where('key', 'phone')->first() ? $setting->where('key', 'phone')->first()->value : '' }}">
                                        {{ $setting->where('key', 'phone')->first() ? $setting->where('key', 'phone')->first()->value : '' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6 col-xxs-12 ptop--30 pbottom--30 text_dir"
                    style="direction: rtl;">
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">
                                 {{-- روابط معلومات مفيدة  --}}
                                 {{__('site.useful_links')}}
                                </h2>
                            <i class="icon fa fa-expand"></i>
                        </div>
                        <div class="links--widget">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('site.about')}}" class="fa-angle-right">
                                        {{-- من نحن --}}
                                        {{__('site.about_me')}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('site.news')}}" class="fa-angle-right">
                                        {{-- اخبار --}}
                                        {{__('site.news')}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('site.news',['c' => 4])}}" class="fa-angle-right">
                                        {{-- العالم --}}
                                        {{__('site.world_news')}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('site.news',['c' => 6])}}" class="fa-angle-right">
                                        {{-- رياضة --}}
                                        {{__('site.sport_news')}}
                                    </a>
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
            <p class="text float--left" style="color:#fff;">&copy; 2022
                <a href="#" style="color:white;">مارينا بوست</a>. All Rights Reserved.
            </p>

            <ul class="nav links float--right" style="color:#fff;">
                <li>
                    <a href="{{route('site.about')}}">
                        {{-- السياسة و الخصوصية --}}
                        {{__('site.privacy')}}
                    </a>
                </li>
                <li>
                    <a href="{{route('site.index')}}">
                        {{-- الرئيسية --}}
                        {{__('site.Home')}}
                    </a>
                </li>

            </ul>
        </div>
    </div>
</footer>
