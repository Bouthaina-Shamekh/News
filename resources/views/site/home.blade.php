<x-site-layout>
    @php
        $title = 'title_' . app()->getLocale();
        $name = 'name_' . app()->getLocale();
    @endphp
    @push('styles')
        <style>
            .row:after, .row:before {
                display: table;
                content: none !important;
            }
        </style>
    @endpush
    <div class="container">
        <div class="row container2">
            <div class="col-xs-12 col-md-3">
                {{-- slider mobile --}}
                @if($sliders->count() > 0)
                <div class="main--content sleder-mob">
                    <div class="post--items pd--30-0">
                        <div class="row gutter--15">
                            <!--slider-->
                            <div class="col-md-12">
                                <div class="post--item post--layout-1 post--title-larger">
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            @for ($i = 0; $i < $sliders->count(); $i++)
                                                <li data-target="#myCarousel" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                                            @endfor
                                        </ol>
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" style="    background-color: #67000500;     color: white;">
                                            @foreach ($sliders as $index => $slider)
                                                <div class="item {{ $index == 0 ? 'active' : '' }}">
                                                    <a href="{{ route('site.new', $slider->slug) }}">
                                                        <img src="{{ asset('storage/' . $slider->img_view) }}" alt="{{ $slider->$title }}" class="slider_img">
                                                    </a>
                                                    <div style=" margin: 0%;height: 70px; margin-top: -76px;">
                                                        <h4 style="   direction: rtl;" class="h4-slider">{{ $slider->$title }}</h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Left and right controls -->
                                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!--slider side-->
                <div class="">
                    <div class="main--content section-right" data-sticky-content="true">
                        <!--مساحة اعلانيه جانبية-->
                        <!--sidebar-->
                        <div class="main--sidebar" data-sticky-content="true">
                            <div class="sticky-content-inner">
                                <div class="col-md-12 float-left"
                                    style="padding: 0; margin: 5px 0 20px; border-bottom: 1px solid #670005;">
                                    <div class="list--widget list--widget-1">
                                        <div class="list--widget-nav list--widget-nav-1" data-ajax="tab">
                                            <ul class="nav nav-justified flex space-x-4">
                                                <li>
                                                    <a href="#" id="nav-home-tab" data-bs-toggle="tab"
                                                        class="py-2 px-4 text-lg text-gray-600 hover:text-blue-500 cursor-pointer"
                                                        data-bs-target="#nav-home" role="tab"
                                                        aria-controls="nav-home" aria-selected="true">
                                                        {{-- أخبار عاجلة --}}
                                                        {{ __('site.emergency news') }}
                                                    </a>
                                                </li>
                                                <li class="active">
                                                    <a href="#" id="nav-profile-tab" data-bs-toggle="tab"
                                                        class="py-2 px-4 text-lg text-gray-600 hover:text-blue-500 cursor-pointer"
                                                        data-bs-target="#nav-profile" role="tab"
                                                        aria-controls="nav-profile" aria-selected="false">
                                                        {{-- أحدث الأخبار --}}
                                                        {{ __('site.latest news') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" id="nav-contact-tab" data-bs-toggle="tab"
                                                        class="py-2 px-4 text-lg text-gray-600 hover:text-blue-500 cursor-pointer"
                                                        data-bs-target="#nav-contact" role="tab"
                                                        aria-controls="nav-contact" aria-selected="false">
                                                        {{-- الأكثر مشاهدة --}}
                                                        {{ __('site.most viewed') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="post--items post--items-3" data-ajax-content="outer">
                                            <div class="tab-content mt-4" id="nav-tabContent">
                                                <div class="tab-pane fade" id="nav-home" role="tabpanel"
                                                    aria-labelledby="nav-home-tab">
                                                    <!-- Content for أخبار عاجلة -->
                                                    @php
                                                        $breaking_news = App\Models\Nw::where('new_place_id', 6)->where('statu_id', 2)->orderBy('id','desc')->get()->take(3);
                                                    @endphp
                                                    <ul class="nav" data-ajax-content="inner" id="nav_sider">
                                                        @foreach ($breaking_news as $newS)
                                                        <li>
                                                            <div class="post--item post--layout-3 post--side-2">
                                                                <div class="post--img" style="display: flex; align-items: center;">
                                                                    <a href="{{ route('site.new', $newS->slug)}}" class="thumb">
                                                                        <img src="{{ asset('storage/' . $newS->img_view) }}" alt="" style="object-fit: contain;" />
                                                                    </a>
                                                                    <div class="post--info" style="width: 60%;padding-right: 5px;">
                                                                        <ul class="nav meta">
                                                                            <li>
                                                                                <a href="{{ route('site.news',['c' => $newS->category_id]) }}" style="background-color: #454545; border-radius: 7px; color: #fff;">
                                                                                    {{ Illuminate\Support\Str::words($newS->category ? $newS->category->$name : '', 2, '..') }}
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="title">
                                                                            <h3 class="h4">
                                                                                <a href="{{ route('site.new', $newS->slug)}}" title="{{ $newS->$title }}" class="btn-link">
                                                                                    {{ Illuminate\Support\Str::words($newS->$title, 5, '..') }}
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="tab-pane show active" id="nav-profile"
                                                    role="tabpanel" aria-labelledby="nav-profile-tab">
                                                    <!-- Content for أحدث الأخبار -->
                                                    @php
                                                        $latest_news = App\Models\Nw::orderBy('id', 'desc')->where('statu_id', 2)->orderby('id','desc')->get()->take(3);
                                                    @endphp
                                                    <ul class="nav" data-ajax-content="inner" id="nav_sider">
                                                        @foreach ($latest_news as $newS)
                                                        <li>
                                                            <div class="post--item post--layout-3 post--side-2">
                                                                <div class="post--img" style="display: flex; align-items: center;">
                                                                    <a href="{{ route('site.new', $newS->slug)}}" class="thumb">
                                                                        <img src="{{ asset('storage/' . $newS->img_view) }}" alt="" style="object-fit: contain;" />
                                                                    </a>
                                                                    <div class="post--info" style="width: 60%;padding-right: 5px;">
                                                                        <ul class="nav meta">
                                                                            <li>
                                                                                <a href="{{ route('site.news',['c' => $newS->category_id]) }}" style="background-color: #454545; border-radius: 7px; color: #fff;">
                                                                                    {{ Illuminate\Support\Str::words($newS->category ? $newS->category->$name : '', 2, '..') }}
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="title">
                                                                            <h3 class="h4">
                                                                                <a href="{{ route('site.new', $newS->slug)}}" title="{{ $newS->$title }}" class="btn-link">
                                                                                    {{ Illuminate\Support\Str::words($newS->$title, 5, '..') }}
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                                    aria-labelledby="nav-contact-tab">
                                                    <!-- Content for الأكثر مشاهدة -->
                                                    @php
                                                        $most_viewed = App\Models\Nw::where('new_place_id', 3)->where('statu_id', 2)->orderby('id','desc')->get()->take(3);
                                                    @endphp
                                                    <ul class="nav" data-ajax-content="inner" id="nav_sider">
                                                        @foreach ($most_viewed as $newS)
                                                        <li>
                                                            <div class="post--item post--layout-3 post--side-2">
                                                                <div class="post--img" style="display: flex; align-items: center;">
                                                                    <a href="{{ route('site.new', $newS->slug)}}" class="thumb">
                                                                        <img src="{{ asset('storage/' . $newS->img_view) }}" alt="" style="object-fit: contain;" />
                                                                    </a>
                                                                    <div class="post--info" style="width: 60%;padding-right: 5px;">
                                                                        <ul class="nav meta">
                                                                            <li>
                                                                                <a href="{{ route('site.news',['c' => $newS->category_id]) }}" style="background-color: #454545; border-radius: 7px; color: #fff;">
                                                                                    {{ Illuminate\Support\Str::words($newS->category ? $newS->category->$name : '', 2, '..') }}
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="title">
                                                                            <h3 class="h4">
                                                                                <a href="{{ route('site.new', $newS->slug)}}" title="{{ $newS->$title }}" class="btn-link">
                                                                                    {{ Illuminate\Support\Str::words($newS->$title, 5, '..') }}
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12  text-center">
                                            <a href="{{route('site.news')}}" class="btn-link btn-link--secondary-more">{{__('site.More')}} <i class="fa flm fa-angle-double-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- sidebar ads 1 --}}
                            <div class="sticky-content-inner">
                                <hr>
                                @php
                                    $ads = App\Models\Ad::where('ad_place_id', 3)->get();
                                    foreach ($ads as $ad) {
                                        $now = Carbon\Carbon::now();
                                        $startDate = Carbon\Carbon::parse($ad->date);
                                        $endDate = Carbon\Carbon::parse($ad->end_date);

                                        if ($now->between($startDate, $endDate)) {
                                            $ad->status = 'active';
                                        } else {
                                            $ad->status = 'inactive';
                                        }
                                    }
                                @endphp
                                @forelse ($ads->where('status', 'active') as $index => $ad)
                                    <div class="widget">
                                        @if ($index != 1)
                                            <div class="widget--title">
                                            </div>
                                        @endif
                                        <div class="">
                                            <a href="{{ $ad->url }}" title="{{ $ad->title }}" target="_blank">
                                                <img src="{{ asset('storage/' . $ad->image) }}" style="height: 100%; width: -webkit-fill-available; " alt="{{ $ad->title }}">
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="widget">
                                        <h2 class="h4" style="    direction: rtl;">
                                            <i class="icon fa fa-bullhorn"></i>
                                            {{__('admin.Ad')}}
                                        </h2>
                                    </div>
                                @endforelse
                            </div>
                            <div class="sticky-content-inner">
                                <div class="col-md-12 float-left"
                                    style="padding: 28px 0 0; margin: 5px 0 20px; border-bottom: 1px solid #670005;">
                                    <div class="list--widget list--widget-1">
                                        <div class="list--widget-nav list--widget-nav-2" style="padding: 7px 2px 15px;" data-ajax="tab">
                                            <ul class="nav nav-justified flex space-x-4">
                                                <li>
                                                    <a href="#" id="nav-home-tab2" data-bs-toggle="tab"
                                                        class="py-2 px-4 text-lg text-gray-600 hover:text-blue-500 cursor-pointer"
                                                        data-bs-target="#nav-home2" role="tab"
                                                        aria-controls="nav-home2" aria-selected="true">
                                                        {{-- أخبار عاجلة --}}
                                                        {{ __('site.Miscellaneous Articles') }}
                                                    </a>
                                                </li>
                                                <li class="active">
                                                    <a href="#" id="nav-profile-tab2" data-bs-toggle="tab"
                                                        class="py-2 px-4 text-lg text-gray-600 hover:text-blue-500 cursor-pointer"
                                                        data-bs-target="#nav-profile2" role="tab"
                                                        aria-controls="nav-profile2" aria-selected="false">
                                                        {{-- أحدث الأخبار --}}
                                                        {{ __('site.articles') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" id="nav-contact-tab2" data-bs-toggle="tab"
                                                        class="py-2 px-4 text-lg text-gray-600 hover:text-blue-500 cursor-pointer"
                                                        data-bs-target="#nav-contact2" role="tab"
                                                        aria-controls="nav-contact2" aria-selected="false">
                                                        {{-- الأكثر مشاهدة --}}
                                                        {{ __('site.most viewed') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="post--items post--items-3" data-ajax-content="outer">
                                            <div class="tab-content mt-4" id="nav-tabContent2">
                                                <div class="tab-pane fade" id="nav-home2" role="tabpanel"
                                                    aria-labelledby="nav-home-tab">
                                                    <!-- Content for أخبار عاجلة -->
                                                    @php
                                                        $breaking_news = App\Models\Artical::where('place', 'war')->orderby('id','desc')->get()->take(3);
                                                    @endphp
                                                    <ul class="nav" data-ajax-content="inner" id="nav_sider">
                                                        @foreach ($breaking_news as $newS)
                                                        <li>
                                                            <div class="post--item post--layout-3 post--side-2">
                                                                <div class="post--img" style="display: flex; align-items: center;">
                                                                    <a href="{{ route('site.article', $newS->slug)}}" class="thumb">
                                                                        <img src="{{ asset('storage/' . $newS->img_view) }}" alt="" style="object-fit: contain;" />
                                                                    </a>
                                                                    <div class="post--info" style="width: 60%;padding-right: 5px;">
                                                                        <ul class="nav meta">
                                                                            <li>
                                                                                <a href="{{ route('site.articles',['c' => $newS->category_id]) }}" style="background-color: #454545; border-radius: 7px; color: #fff;">
                                                                                    {{ Illuminate\Support\Str::words($newS->category ? $newS->category->$name : '', 2, '..') }}
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="title">
                                                                            <h3 class="h4">
                                                                                <a href="{{ route('site.article', $newS->slug)}}" title="{{ $newS->$title }}" class="btn-link">
                                                                                    {{ Illuminate\Support\Str::words($newS->$title, 5, '..') }}
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="tab-pane show active" id="nav-profile2"
                                                    role="tabpanel" aria-labelledby="nav-profile-tab">
                                                    <!-- Content for أحدث الأخبار -->
                                                    @php
                                                        $latest_news = App\Models\Artical::orderby('id','desc')->get()->take(3);
                                                    @endphp
                                                    <ul class="nav" data-ajax-content="inner" id="nav_sider">
                                                        @foreach ($latest_news as $newS)
                                                        <li>
                                                            <div class="post--item post--layout-3 post--side-2">
                                                                <div class="post--img" style="display: flex; align-items: center;">
                                                                    <a href="{{ route('site.article', $newS->slug)}}" class="thumb">
                                                                        <img src="{{ asset('storage/' . $newS->img_view) }}" alt="" style="object-fit: contain;" />
                                                                    </a>
                                                                    <div class="post--info" style="width: 60%;padding-right: 5px;">
                                                                        <ul class="nav meta">
                                                                            <li>
                                                                                <a href="{{ route('site.articles',['c' => $newS->category_id]) }}" style="background-color: #454545; border-radius: 7px; color: #fff;">
                                                                                    {{ Illuminate\Support\Str::words($newS->category ? $newS->category->$name : '', 2, '..') }}
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="title">
                                                                            <h3 class="h4">
                                                                                <a href="{{ route('site.article', $newS->slug)}}" title="{{ $newS->$title }}" class="btn-link">
                                                                                    {{ Illuminate\Support\Str::words($newS->$title, 5, '..') }}
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="nav-contact2" role="tabpanel"
                                                    aria-labelledby="nav-contact-tab">
                                                    <!-- Content for الأكثر مشاهدة -->
                                                    @php
                                                        $most_viewed = App\Models\Artical::orderBy('visit', 'asc')->orderby('id','desc')->get()->take(3);
                                                    @endphp
                                                    <ul class="nav" data-ajax-content="inner" id="nav_sider">
                                                        @foreach ($most_viewed as $newS)
                                                        <li>
                                                            <div class="post--item post--layout-3 post--side-2">
                                                                <div class="post--img" style="display: flex; align-items: center;">
                                                                    <a href="{{ route('site.article', $newS->slug)}}" class="thumb">
                                                                        <img src="{{ asset('storage/' . $newS->img_view) }}" alt="" style="object-fit: contain;" />
                                                                    </a>
                                                                    <div class="post--info" style="width: 60%;padding-right: 5px;">
                                                                        <ul class="nav meta">
                                                                            <li>
                                                                                <a href="{{ route('site.articles',['c' => $newS->category_id]) }}" style="background-color: #454545; border-radius: 7px; color: #fff;">
                                                                                    {{ Illuminate\Support\Str::words($newS->category ? $newS->category->$name : '', 2, '..') }}
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="title">
                                                                            <h3 class="h4">
                                                                                <a href="{{ route('site.article', $newS->slug)}}" title="{{ $newS->$title }}" class="btn-link">
                                                                                    {{ Illuminate\Support\Str::words($newS->$title, 5, '..') }}
                                                                                </a>
                                                                            </h3>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <a href="{{route('site.articles')}}" class="btn-link btn-link--secondary-more">{{__('site.More')}} <i class="fa flm fa-angle-double-left"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- sidebar ads 2 --}}
                            <div class="sticky-content-inner">
                                <hr>
                                @php
                                    $ads = App\Models\Ad::where('ad_place_id', 4)->get();
                                    foreach ($ads as $ad) {
                                        $now = Carbon\Carbon::now();
                                        $startDate = Carbon\Carbon::parse($ad->date);
                                        $endDate = Carbon\Carbon::parse($ad->end_date);

                                        if ($now->between($startDate, $endDate)) {
                                            $ad->status = 'active';
                                        } else {
                                            $ad->status = 'inactive';
                                        }
                                    }
                                @endphp
                                @forelse ($ads->where('status', 'active') as $index => $ad)
                                    <div class="widget">
                                        @if ($index != 1)
                                            <div class="widget--title">
                                            </div>
                                        @endif
                                        <div class="">
                                            <a href="{{ $ad->url }}" title="{{ $ad->title }}" target="_blank">
                                                <img src="{{ asset('storage/' . $ad->image) }}" style="height: 100%; width: -webkit-fill-available; " alt="{{ $ad->title }}">
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="widget">
                                        <h2 class="h4" style="    direction: rtl;">
                                            <i class="icon fa fa-bullhorn"></i>
                                            {{__('admin.Ad')}}
                                        </h2>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-1"></div>
            </div>
            <div class="col-xs-12 col-md-6">
                @if($sliders->count() > 0)
                <div class="main--content sleder-lab">
                    <div class="post--items pd--30-0">
                        <div class="row gutter--15">
                            <!--slider-->
                            <div class="col-md-12">
                                <div class="post--item post--layout-1 post--title-larger">
                                    <div id="myCarouselDesktop" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            @for ($i = 0; $i < $sliders->count(); $i++)
                                                <li data-target="#myCarouselDesktop" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                                            @endfor
                                        </ol>
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" style="    background-color: #67000500;     color: white;">
                                            @foreach ($sliders as $index => $slider)
                                                <div class="item {{ $index == 0 ? 'active' : '' }}">
                                                    <a href="{{ route('site.new', $slider->slug) }}">
                                                        <img src="{{ asset('storage/' . $slider->img_view) }}" alt="{{ $slider->$title }}" class="slider_img">
                                                    </a>
                                                    <div style=" margin: 0%;height: 70px; margin-top: -76px;">
                                                        <h4 style="   direction: rtl;" class="h4-slider">{{ $slider->$title }}</h4>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Left and right controls -->
                                        <a class="left carousel-control" href="#myCarouselDesktop" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarouselDesktop" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- main-->
                <div class="row">
                    <div class="main--content col-md-12 col-sm-12" data-sticky-content="true" style="float: right;">
                        <div class="sticky-content-inner">
                            <div class="row">
                                <div class="col-md-12 ptop--30">
                                    <div class="post--items-title" data-ajax="tab">
                                        <a class="h2" style="direction: rtl; color: #670005;" href="{{ route('site.articles', ['c' => $categoryOne->id]) }}">
                                            {{ $categoryOne->$name }}
                                        </a>
                                    </div>
                                </div>
                                <div class="row gutter--15" data-ajax-content="inner" style="display: flex; flex-wrap: wrap;flex-direction: row-reverse; padding: 0 14px;">
                                    @foreach($articlesOne->take(7) as $article)
                                        @if($loop->first)
                                            {{-- أول عنصر (يأخذ نصف العرض أو أكثر) --}}
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="margin-bottom: 20px;">
                                                <div class="post--item post--layout-1">
                                                    <div class="post--img mrg-top-m-34">
                                                        <a href="{{ route('site.article', $article->slug ?? 0) }}" class="thumb">
                                                            <img src="{{ asset('storage/' . $article->img_view) }}" alt="{{ $article->$title }}" style="object-fit: cover;" class="imgss">
                                                        </a>
                                                        <div class="post--info">
                                                            <ul class="nav meta">
                                                                <li><a href="author?id=0"></a></li>
                                                            </ul>
                                                            <div class="title" style="height:80px;">
                                                                <h3 class="text h4">
                                                                    <a href="{{ route('site.article', $article->slug ?? 0) }}" class="btn-link text">{{ $article->$title }}</a>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- فاصل بسيط إن أردت
                                            <div class="col-xs-12">
                                                <hr class="divider">
                                            </div> --}}
                                        @else
                                            {{-- بقية العناصر --}}
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 home-sml-div">
                                                <div class="post--item post--layout-2">
                                                    <div class="post--img">

                                                        <a href="{{ route('site.article', $article->slug ?? 0) }}" class="thumb">

                                                            <img src="{{ asset('storage/' . $article->img_view) }}" alt="{{ $article->$title }}" class="home-sml-img">
                                                        </a>
                                                        <div class="post--info">
                                                            <ul class="nav meta">
                                                                <li><a href="author?id=0"></a></li>
                                                            </ul>
                                                            <div class="title" style="height: auto;margin-bottom: 7px;">
                                                                <h3 class="h4">
                                                                    <a href="{{ route('site.article', $article->slug ?? 0) }}" class="btn-link text">{{ $article->$title }}</a>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('site.articles', ['c' => $categoryOne->id]) }}" class="btn-link pull-left btn-link--secondary-more">{{ __('site.More') }} <i class="fa flm fa-angle-double-left"></i></a>
                                </div>
                            </div>
                            <!-- مساحة اعلانية  -->
                            <div class="col-md-12 ptop--30 ">
                                <div class="post--items-title" style="padding: 0;" data-ajax="tab">
                                    @php
                                        $ads5 = App\Models\Ad::where('ad_place_id', '1')->orderBy('id', 'desc')->first();
                                        if($ads5){
                                            $now = Carbon\Carbon::now();
                                            $startDate = Carbon\Carbon::parse($ads5->date);
                                            $endDate = Carbon\Carbon::parse($ads5->end_date);
                                            if ($now->between($startDate, $endDate)) {
                                                $ads5->status = 'active';
                                            } else {
                                                $ads5->status = 'inactive';
                                            }
                                        }
                                    @endphp
                                    @if($ads5 && $ads5->status == 'active')
                                    <a href="{{ $ads5->url }}" title="{{ $ads5->title }}" target="_blank">
                                        <img src="{{ asset('storage/' . $ads5->image) }}" alt="No Image For Ad"
                                            style="border: 1px solid gold;width: 100%;height:100px;">
                                    </a>
                                    @else
                                    <h2 class="h4" style="direction: rtl;">
                                        <i class="icon fa fa-bullhorn"></i>
                                        <span>{{__('admin.Ad')}}</span>
                                    </h2>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 ptop--30">
                                    <div class="post--items-title" data-ajax="tab">
                                        <a class="h2" style="direction: rtl; color: #670005;" href="{{ route('site.articles', ['c' => $categoryOne->id]) }}">
                                            {{ $categoryTwo->$name }}
                                        </a>
                                    </div>
                                </div>
                                <div class="row gutter--15" data-ajax-content="inner" style="display: flex; flex-wrap: wrap;flex-direction: row-reverse; padding: 0 14px;">
                                    @foreach($articlesTwo->take(7) as $article)
                                        @if($loop->first)
                                            {{-- أول عنصر (يأخذ نصف العرض أو أكثر) --}}
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="margin-bottom: 20px;">
                                                <div class="post--item post--layout-1">
                                                    <div class="post--img mrg-top-m-34">

                                                        <a href="{{ route('site.article', $article->slug ?? 0) }}" class="thumb">

                                                            <img src="{{ asset('storage/' . $article->img_view) }}" alt="{{ $article->$title }}" style="object-fit: cover;" class="imgss">
                                                        </a>
                                                        <div class="post--info">
                                                            <ul class="nav meta">
                                                                <li><a href="author?id=0"></a></li>
                                                            </ul>
                                                            <div class="title" style="height:80px;">
                                                                <h3 class="text h4">

                                                                    <a href="{{ route('site.article', $article->slug ?? 0) }}" class="btn-link text">{{ $article->$title }}</a>

                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- فاصل بسيط إن أردت
                                            <div class="col-xs-12">
                                                <hr class="divider">
                                            </div> --}}
                                        @else
                                            {{-- بقية العناصر --}}
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 home-sml-div">
                                                <div class="post--item post--layout-2">
                                                    <div class="post--img">

                                                        <a href="{{ route('site.article', $article->slug ?? 0) }}" class="thumb">

                                                            <img src="{{ asset('storage/' . $article->img_view) }}" alt="{{ $article->$title }}" class="home-sml-img">
                                                        </a>
                                                        <div class="post--info">
                                                            <ul class="nav meta">
                                                                <li><a href="author?id=0"></a></li>
                                                            </ul>

                                                            <div class="title" style="height: auto;margin-bottom: 7px;">
                                                                <h3 class="h4">
                                                                    <a href="{{ route('site.article', $article->slug ?? 0) }}" class="btn-link text">{{ $article->$title }}</a>

                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="col-md-12">
                                    <a href="{{ route('site.articles', ['c' => $categoryOne->id]) }}" class="btn-link pull-left btn-link--secondary-more">{{ __('site.More') }} <i class="fa flm fa-angle-double-left"></i></a>
                                </div>
                            </div>
                            <!-- مساحة اعلانية  -->
                            <div class="col-md-12 ptop--30 ">
                                <div class="post--items-title" style="padding: 0; margin: 20px 0;" data-ajax="tab">
                                    @php
                                        $ads6 = App\Models\Ad::where('ad_place_id', 2)->orderBy('id', 'desc')->first();
                                        if($ads6){
                                            $now = Carbon\Carbon::now();
                                            $startDate = Carbon\Carbon::parse($ads6->date);
                                            $endDate = Carbon\Carbon::parse($ads6->end_date);

                                            if ($now->between($startDate, $endDate)) {
                                                $ads6->status = 'active';
                                            } else {
                                                $ads6->status = 'inactive';
                                            }
                                        }
                                    @endphp
                                    @if($ads6 && $ads6->status == 'active')
                                    <a href="{{ $ads6->url }}" title="{{ $ads6->title }}" target="_blank">
                                        <img src="{{ asset('storage/' . $ads6->image) }}" alt="No Image For Ad"
                                            style="border: 1px solid gold;width: 100%;height:100px;">
                                    </a>
                                    @else
                                    <h2 class="h4" style="direction: rtl;">
                                        <i class="icon fa fa-bullhorn"></i>
                                        <span>{{__('admin.Ad')}}</span>
                                    </h2>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 ptop--30">
                                    <div class="post--items-title" data-ajax="tab">
                                        <a class="h2" style="direction: rtl; color: #670005;" href="{{ route('site.articles', ['c' => $categoryOne->id]) }}">
                                            {{ $categoryThree->$name }}
                                        </a>
                                    </div>
                                </div>

                                <div class="row gutter--15" data-ajax-content="inner" style="display: flex; flex-wrap: wrap;flex-direction: row-reverse; padding: 0 14px;">
                                    @foreach($articlesThree->take(7) as $article)
                                        @if($loop->first)
                                            {{-- أول عنصر (يأخذ نصف العرض أو أكثر) --}}
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6" style="margin-bottom: 20px;">
                                                <div class="post--item post--layout-1">
                                                    <div class="post--img mrg-top-m-34">

                                                        <a href="{{ route('site.article', $article->slug ?? 0) }}" class="thumb">

                                                            <img src="{{ asset('storage/' . $article->img_view) }}" alt="{{ $article->$title }}" style="object-fit: cover;" class="imgss">
                                                        </a>
                                                        <div class="post--info">
                                                            <ul class="nav meta">
                                                                <li><a href="author?id=0"></a></li>
                                                            </ul>
                                                            <div class="title" style="height:80px;">
                                                                <h3 class="text h4">

                                                                    <a href="{{ route('site.article', $article->slug ?? 0) }}" class="btn-link text">{{ $article->$title }}</a>

                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- فاصل بسيط إن أردت
                                            <div class="col-xs-12">
                                                <hr class="divider">
                                            </div> --}}
                                        @else
                                            {{-- بقية العناصر --}}
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 home-sml-div">
                                                <div class="post--item post--layout-2">
                                                    <div class="post--img">

                                                        <a href="{{ route('site.article', $article->slug ?? 0) }}" class="thumb">

                                                            <img src="{{ asset('storage/' . $article->img_view) }}" alt="{{ $article->$title }}" class="home-sml-img">
                                                        </a>
                                                        <div class="post--info">
                                                            <ul class="nav meta">
                                                                <li><a href="author?id=0"></a></li>
                                                            </ul>

                                                            <div class="title" style="height: a;margin-bottom: 7px;">
                                                                <h3 class="h4">
                                                                    <a href="{{ route('site.article', $article->slug ?? 0) }}" class="btn-link text">{{ $article->$title }}</a>

                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="col-md-12">
                                    <a href="{{ route('site.articles', ['c' => $categoryOne->id]) }}" class="btn-link pull-left btn-link--secondary-more">{{ __('site.More') }} <i class="fa flm fa-angle-double-left"></i></a>
                                </div>
                            </div>
                            {{-- <div class="row" style="display: flex;justify-content: space-between;align-items: center;flex-direction: row-reverse;">
                                <div class="col-md-4 col-xs-6 col-sm-5  col-lg-4 " style=" background-color: #670005; border: 1px solid #670005; border-radius: 19px;margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-3 col-sm-3  col-lg-3" style="background-image: url({{ asset('assets/img/rr37.png') }}); background-repeat: no-repeat;">
                                            <h5><a href="{{ route('site.news') }}" style="color: #fff;">&nbsp; </a></h5>
                                        </div>
                                        <div class="col-md-9 col-xs-9 col-sm-9  col-lg-9">
                                            <h5 style="text-align: left;" class="hid--r">
                                                <a href="{{ route('site.news') }}" style="color: #fff;">
                                                    {{ __('site.more_news') }}
                                                </a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-6 col-sm-5  col-lg-4 " style="  background-color: #670005; border: 1px solid #670005; border-radius: 19px;margin-bottom: 10px;">
                                    <div class="row">

                                        <div class="col-md-9 col-xs-9 col-sm-9  col-lg-9" style="">
                                            <h5 style="text-align: right;" class="hid--r">
                                                <a href="{{ route('site.articles') }}" style="color: #fff;">
                                                    {{ __('site.more_articles') }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="col-md-3 col-xs-3 col-sm-3  col-lg-3" style="background-image: url({{ asset('assets/img/l37.png') }}); background-repeat: no-repeat;background-position-x: right;">
                                            <h5><a href="{{ route('site.articles') }}" style="color: #fff;">&nbsp;</a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3 section-left">
                <!--main-->
                <div class="">
                    <div class="main--content " data-sticky-content="true">
                        <!--مساحة اعلانيه جانبية-->
                        <!--sidebar-->
                        <div class="main--sidebar float-left" data-sticky-content="true">
                            <div class="sticky-content-inner">
                                <!--اعلانات-->
                                @php
                                    $ads = App\Models\Ad::where('ad_place_id', 7)->get();
                                    foreach ($ads as $ad) {
                                        $now = Carbon\Carbon::now();
                                        $startDate = Carbon\Carbon::parse($ad->date);
                                        $endDate = Carbon\Carbon::parse($ad->end_date);

                                        if ($now->between($startDate, $endDate)) {
                                            $ad->status = 'active';
                                        } else {
                                            $ad->status = 'inactive';
                                        }
                                    }
                                @endphp
                                @forelse ($ads->where('status', 'active') as $index => $ad)
                                    <div class="widget">
                                        <div class="widget--title" style="display: {{ $index == 0 ? 'none' : 'block' }}">
                                        </div>

                                        <div class="">
                                            <a href="{{ $ad->url }}" title="{{ $ad->title }}" target="_blank">
                                                <img src="{{ asset('storage/' . $ad->image) }}" style="height: 100%; width: -webkit-fill-available; " alt="{{ $ad->title }}">
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="widget">
                                        <h2 class="h4" style="    direction: rtl;">
                                            <i class="icon fa fa-bullhorn"></i>
                                            {{__('admin.Ad')}}
                                        </h2>
                                    </div>
                                @endforelse
                                @php
                                    $ads = App\Models\Ad::where('ad_place_id', 5)->get();
                                    foreach ($ads as $ad) {
                                        $now = Carbon\Carbon::now();
                                        $startDate = Carbon\Carbon::parse($ad->date);
                                        $endDate = Carbon\Carbon::parse($ad->end_date);

                                        if ($now->between($startDate, $endDate)) {
                                            $ad->status = 'active';
                                        } else {
                                            $ad->status = 'inactive';
                                        }
                                    }
                                @endphp
                                @forelse ($ads->where('status', 'active') as $index => $ad)
                                    <div class="widget">
                                        <div class="widget--title" style="display: {{ $index == 0 ? 'none' : 'block' }}">
                                        </div>
                                        <div class="">
                                            <a href="{{ $ad->url }}" title="{{ $ad->title }}" target="_blank">
                                                <img src="{{ asset('storage/' . $ad->image) }}" style="height: 100%; width: -webkit-fill-available; " alt="{{ $ad->title }}">
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="widget">
                                        <h2 class="h4" style="    direction: rtl;">
                                            <i class="icon fa fa-bullhorn"></i>
                                            {{__('admin.Ad')}}
                                        </h2>
                                    </div>
                                @endforelse
                                <div class="widget">
                                    <div class="widget--title">
                                        <h2 class="h4" style="    direction: rtl;">
                                            {{-- حالة الطقس --}}
                                            {{__('site.weather')}}
                                        </h2>
                                        <i class="icon fa fa-cloud"></i>
                                    </div>
                                    <div class="">
                                        <a class="weatherwidget-io" href="https://forecast7.com/ar/31d9535d23/palestine/" data-label_1="PALESTINE" data-label_2="WEATHER" data-font='AlarabyTelevision' data-icons="Climacons Animated" data-theme="pure" data-basecolor="#f8f8f8" data-textcolor="#000000" data-suncolor="#a74a4a" >PALESTINE WEATHER</a>
                                        <script>

                                        </script>
                                    </div>
                                </div>
                                <div class="widget">
                                    <div class="widget--title">
                                        <h2 class="h4" style="direction: rtl;">
                                            {{-- أسعار العملات --}}
                                            {{ __('site.currency') }}
                                        </h2>
                                        <i class="icon fa fa-money"></i>
                                    </div>
                                    <div>
                                        <!-- TradingView Widget BEGIN -->
                                        <div class="tradingview-widget-container" style="border:1px solid #670005; padding: 10px; border-radius: 5px;">
                                            <div class="tradingview-widget-container__widget"></div>
                                            <div class="tradingview-widget-copyright" style="text-align: center; margin-top: 5px;">
                                                <a href="https://ar.tradingview.com/" rel="noopener nofollow" target="_blank">
                                                    <span class="blue-text">تتبع جميع الأسواق على TradingView</span>
                                                </a>
                                            </div>
                                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-forex-cross-rates.js" async>
                                            {
                                              "width": "100%",
                                              "height": 195,
                                              "currencies": [
                                                "EUR",
                                                "USD",
                                                "JPY",
                                                "GBP",
                                                "AUD",
                                                "TRY",
                                                "SEK",
                                                "ILS"
                                              ],
                                              "isTransparent": false,
                                              "colorTheme": "light",
                                              "locale": "ar_AE",
                                              "backgroundColor": "#ffffff"
                                            }
                                            </script>
                                        </div>
                                        <!-- TradingView Widget END -->
                                    </div>
                                </div
                                @php
                                    $ads = App\Models\Ad::where('ad_place_id', 6)->get();
                                    foreach ($ads as $ad) {
                                        $now = Carbon\Carbon::now();
                                        $startDate = Carbon\Carbon::parse($ad->date);
                                        $endDate = Carbon\Carbon::parse($ad->end_date);

                                        if ($now->between($startDate, $endDate)) {
                                            $ad->status = 'active';
                                        } else {
                                            $ad->status = 'inactive';
                                        }
                                    }
                                @endphp
                                @forelse ($ads->where('status', 'active') as $index => $ad)
                                    <div class="widget">
                                        <div class="widget--title" style="display: {{ $index == 0 ? 'none' : 'block' }}">
                                        </div>

                                        <div class="">
                                            <a href="{{ $ad->url }}" title="{{ $ad->title }}" target="_blank">
                                                <img src="{{ asset('storage/' . $ad->image) }}" style="height: 100%; width: -webkit-fill-available; " alt="{{ $ad->title }}">
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="widget">
                                        <h2 class="h4" style="    direction: rtl;">
                                            <i class="icon fa fa-bullhorn"></i>
                                            {{__('admin.Ad')}}
                                        </h2>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-site-layout>
