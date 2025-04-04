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
                        <div class="acme-news-ticker ">
                            <div class="acme-news-ticker-label ">تحديثات الأخبار</div>
                            @php
                                $news = \App\Models\Nw::all();
                                $title = app()->getLocale() == 'ar' ? 'title_ar' : 'title_en';
                            @endphp
                            <div class="acme-news-ticker-box ">
                                <ul class="my-news-ticker " style=" text-align: right; ">
                                    @foreach ($news as $new)
                                    <li>
                                        <a href="{{route('site.new', $new->id)}}" style="text-align: right; ">
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
    {{ $header ?? '' }}
    <div class="main-content--section">
        {{ $slot }}

        @include('layouts.partials.site.footer')
    </div>
</div>
@include('layouts.partials.site.end')
