@include('layouts.partials.site.head')
<div class="wrapper">
    @include('layouts.partials.site.header')
    <div class="posts--filter-bar style--1 hidden-xs">
        <div class="container ">
            <ul class="nav ">
            </ul>
        </div>
    </div>
    <div class="news--ticker">
        <div class="main-content--section ">
            <div class="container">
                <div class="row " style=" ">
                    <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 ">
                        <div class="acme-news-ticker news-ticker-shell">
                            <div class="acme-news-ticker-label ">
                                {{-- تحديثات الأخبار --}}
                                {{ __('site.news updates') }}</div>
                            @php
                                $news = \App\Models\Nw::orderBy('id', 'desc')->where('statu_id', 2)->take(15)->get();
                                // $title = app()->getLocale() == 'ar' ? 'title_ar' : 'title_en';
                                $locale = app()->getLocale();
                                $title = 'title_' . $locale;
                                $tickerDirection = $locale === 'ar' ? 'right' : 'left';
                            @endphp
                            <div class="acme-news-ticker-box" data-news-ticker data-ticker-direction="{{ $tickerDirection }}" data-ticker-locale="{{ $locale }}">
                                <div class="my-news-ticker" data-news-ticker-track>
                                    <ul class="news-ticker-group" data-news-ticker-group>
                                    @foreach ($news as $new)
                                    <li>
                                        <a href="{{route('site.new', $new->id)}}">
                                            {{ $new->$title }}
                                        </a>
                                    </li>
                                    @endforeach
                                    </ul>
                                    <ul class="news-ticker-group" data-news-ticker-group aria-hidden="true">
                                    @foreach ($news as $new)
                                    <li>
                                        <a href="{{route('site.new', $new->id)}}" tabindex="-1">
                                            {{ $new->$title }}
                                        </a>
                                    </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $header ?? '' }}
    <div class="main-content--section">
        {{ $slot }}

        @include('layouts.partials.site.footer')
    </div>
</div>
@include('layouts.partials.site.end')
