<x-site-layout>
    @php
        $title = 'title_' . app()->getLocale();
    @endphp
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
                                                    <a href="{{ route('site.new', $slider->id) }}">
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
                                                    <ul class="nav" id="nav_sider">
                                                        @php
                                                        $breaking_news = App\Models\Nw::where('new_place_id', 6)->get()->take(3);
                                                        @endphp
                                                        <!-- Example content for أحدث الأخبار -->
                                                        @foreach ($breaking_news as $new)
                                                        <li>
                                                            <div class="post--item post--layout-3">
                                                                <div class="post--img">
                                                                    <div class="post--img-1">
                                                                        <div class="post--info">
                                                                            <ul class="nav meta text-center">
                                                                                <li><a href="#">{{ isset($new->publisher) ? $new->publisher->name : "" }}</a>
                                                                                </li>
                                                                                <li><a href="#">{{ $new->created_at->format('Y-m-d') }}</a>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="title">
                                                                                <h5 class="text-right" style="padding-right: 8px;">
                                                                                    <a href="{{ route('site.new', $new->id) }}" class="btn-link">
                                                                                        {{ \Illuminate\Support\Str::words($new->$title, 8, '...') }}
                                                                                    </a>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="post--img-2">
                                                                        <a href="{{ route('site.new', $new->id) }}" class="thumb">
                                                                            <img src="{{ asset('storage/' . $new->img_view) }}" alt="" class="h-20 object-cover" />
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                        <!-- Add more list items here -->
                                                    </ul>
                                                </div>
                                                <div class="tab-pane show active" id="nav-profile"
                                                    role="tabpanel" aria-labelledby="nav-profile-tab">
                                                    <!-- Content for أحدث الأخبار -->
                                                    <ul class="nav" id="nav_sider">
                                                        @php
                                                        $latest_news = App\Models\Nw::orderBy('id', 'desc')->get()->take(3);
                                                        @endphp
                                                        <!-- Example content for أحدث الأخبار -->
                                                        @foreach ($latest_news as $new)
                                                        <li>
                                                            <div class="post--item post--layout-3">
                                                                <div class="post--img">
                                                                    <div class="post--img-1">
                                                                        <div class="post--info">
                                                                            <ul class="nav meta text-center">
                                                                                <li><a href="#">{{ isset($new->publisher) ? $new->publisher->name : "" }}</a>
                                                                                </li>
                                                                                <li><a href="#">{{ $new->created_at->format('Y-m-d') }}</a>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="title">
                                                                                <h5 class="text-right" style="padding-right: 8px;">
                                                                                    <a href="{{ route('site.new', $new->id) }}" class="btn-link">
                                                                                        {{ \Illuminate\Support\Str::words($new->$title, 8, '...') }}
                                                                                    </a>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="post--img-2">
                                                                        <a href="{{ route('site.new', $new->id) }}" class="thumb">
                                                                            <img src="{{ asset('storage/' . $new->img_view) }}" alt="" class="h-20 object-cover" />
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                        <!-- Add more list items here -->
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                                    aria-labelledby="nav-contact-tab">
                                                    <!-- Content for الأكثر مشاهدة -->
                                                    <ul class="nav" id="nav_sider">
                                                        @php
                                                        $most_viewed = App\Models\Nw::where('new_place_id', 3)->get()->take(3);
                                                        @endphp
                                                        <!-- Example content for أحدث الأخبار -->
                                                        @foreach ($most_viewed as $new)
                                                        <li>
                                                            <div class="post--item post--layout-3">
                                                                <div class="post--img">
                                                                    <div class="post--img-1">
                                                                        <div class="post--info">
                                                                            <ul class="nav meta text-center">
                                                                                <li><a href="#">{{ isset($new->publisher) ? $new->publisher->name : "" }}</a>
                                                                                </li>
                                                                                <li><a href="#">{{ $new->created_at->format('Y-m-d') }}</a>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="title">
                                                                                <h5 class="text-right" style="padding-right: 8px;">
                                                                                    <a href="{{ route('site.new', $new->id) }}" class="btn-link">
                                                                                        {{ \Illuminate\Support\Str::words($new->$title, 8, '...') }}
                                                                                    </a>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="post--img-2">
                                                                        <a href="{{ route('site.new', $new->id) }}" class="thumb">
                                                                            <img src="{{ asset('storage/' . $new->img_view) }}" alt="" class="h-20 object-cover" />
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                        <!-- Add more list items here -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- sidebar ads 1 --}}
                            <div class="sticky-content-inner">
                                <hr>
                                @php
                                $ads = App\Models\Ad::where('ad_place_id', 3)->get();
                                @endphp
                                @forelse ($ads as $index => $ad)
                                <div class="widget">
                                    <div class="widget--title" style="display: {{ $index == 0 ? 'none' : 'block' }}">
                                    </div>

                                    <div class="">
                                        <a href="{{ $ad->url }}" title="{{ $ad->title }}">
                                            <img src="{{ asset('storage/' . $ad->image) }}" style="height: 100%; width: -webkit-fill-available; " alt="{{ $ad->title }}">
                                        </a>
                                    </div>
                                </div>
                                @empty
                                <div class="widget">
                                    <h2 class="h4" style="    direction: rtl;">
                                        <i class="icon fa fa-bullhorn"></i> إعلان
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
                                                        {{ __('site.emergency articles') }}
                                                    </a>
                                                </li>
                                                <li class="active">
                                                    <a href="#" id="nav-profile-tab2" data-bs-toggle="tab"
                                                        class="py-2 px-4 text-lg text-gray-600 hover:text-blue-500 cursor-pointer"
                                                        data-bs-target="#nav-profile2" role="tab"
                                                        aria-controls="nav-profile2" aria-selected="false">
                                                        {{-- أحدث الأخبار --}}
                                                        {{ __('site.latest articles') }}
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
                                                    <ul class="nav" id="nav_sider">
                                                        @php
                                                        $breaking_news = App\Models\Artical::get()->take(3);
                                                        @endphp
                                                        <!-- Example content for أحدث الأخبار -->
                                                        @foreach ($breaking_news as $new)
                                                        <li>
                                                            <div class="post--item post--layout-3">
                                                                <div class="post--img">
                                                                    <div class="post--img-1">
                                                                        <div class="post--info">
                                                                            <ul class="nav meta text-center">
                                                                                <li><a href="#">{{ isset($new->publisher) ? $new->publisher->name : "" }}</a>
                                                                                </li>
                                                                                <li><a href="#">{{ $new->created_at->format('Y-m-d') }}</a>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="title">
                                                                                <h5 class="text-right" style="padding-right: 8px;">
                                                                                    <a href="{{ route('site.article', $new->id) }}" class="btn-link">
                                                                                        {{ $new->$title }}
                                                                                    </a>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="post--img-2">
                                                                        <a href="{{ route('site.article', $new->id) }}" class="thumb">
                                                                            <img src="{{ asset('storage/' . $new->img_view) }}" alt="" class="h-20 object-cover" />
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                        <!-- Add more list items here -->
                                                    </ul>
                                                </div>
                                                <div class="tab-pane show active" id="nav-profile2"
                                                    role="tabpanel" aria-labelledby="nav-profile-tab">
                                                    <!-- Content for أحدث الأخبار -->
                                                    <ul class="nav" id="nav_sider">
                                                        @php
                                                        $latest_news = App\Models\Artical::orderBy('id', 'desc')->get()->take(3);
                                                        @endphp
                                                        <!-- Example content for أحدث الأخبار -->
                                                        @foreach ($latest_news as $new)
                                                        <li>
                                                            <div class="post--item post--layout-3">
                                                                <div class="post--img">
                                                                    <div class="post--img-1">
                                                                        <div class="post--info">
                                                                            <ul class="nav meta text-center">
                                                                                <li><a href="#">{{ isset($new->publisher) ? $new->publisher->name : "" }}</a>
                                                                                </li>
                                                                                <li><a href="#">{{ $new->created_at->format('Y-m-d') }}</a>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="title">
                                                                                <h5 class="text-right" style="padding-right: 8px;">
                                                                                    <a href="{{ route('site.article', $new->id) }}" class="btn-link">
                                                                                        {{ $new->$title }}
                                                                                    </a>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="post--img-2">
                                                                        <a href="{{ route('site.article', $new->id) }}" class="thumb">
                                                                            <img src="{{ asset('storage/' . $new->img_view) }}" alt="" class="h-20 object-cover" />
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                        <!-- Add more list items here -->
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="nav-contact2" role="tabpanel"
                                                    aria-labelledby="nav-contact-tab">
                                                    <!-- Content for الأكثر مشاهدة -->
                                                    <ul class="nav" id="nav_sider">
                                                        @php
                                                        $most_viewed = App\Models\Artical::orderBy('visit', 'asc')->orderBy('id', 'desc')->get()->take(3);
                                                        @endphp
                                                        <!-- Example content for أحدث الأخبار -->
                                                        @foreach ($most_viewed as $new)
                                                        <li>
                                                            <div class="post--item post--layout-3">
                                                                <div class="post--img">
                                                                    <div class="post--img-1">
                                                                        <div class="post--info">
                                                                            <ul class="nav meta text-center">
                                                                                <li><a href="#">{{ isset($new->publisher) ? $new->publisher->name : "" }}</a>
                                                                                </li>
                                                                                <li><a href="#">{{ $new->created_at->format('Y-m-d') }}</a>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="title">
                                                                                <h5 class="text-right" style="padding-right: 8px;">
                                                                                    <a href="{{ route('site.new', $new->id) }}" class="btn-link">
                                                                                        {{ $new->$title }}
                                                                                    </a>
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="post--img-2">
                                                                        <a href="{{ route('site.new', $new->id) }}" class="thumb">
                                                                            <img src="{{ asset('storage/' . $new->img_view) }}" alt="" class="h-20 object-cover" />
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endforeach
                                                        <!-- Add more list items here -->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- sidebar ads 2 --}}
                            <div class="sticky-content-inner">
                                <hr>
                                @php
                                $ads = App\Models\Ad::where('ad_place_id', 4)->take(3)->get();
                                @endphp
                                @forelse ($ads as $index => $ad)
                                <div class="widget">
                                    <div class="widget--title">
                                    </div>

                                    <div class="">
                                        <a href="{{ $ad->url }}" title="{{ $ad->title }}">
                                            <img src="{{ asset('storage/' . $ad->image) }}" style="height: 100%; width: -webkit-fill-available; " alt="{{ $ad->title }}">
                                        </a>
                                    </div>
                                </div>
                                @empty
                                <div class="widget">
                                    <h2 class="h4" style="direction: rtl;">
                                        <i class="icon fa fa-bullhorn"></i> إعلان
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
                                                    <a href="{{ route('site.new', $slider->id) }}">
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
                <!-- main-->
                <div class="row">
                    <div class="main--content col-md-12 col-sm-12" data-sticky-content="true" style="float: right;">
                        <div class="sticky-content-inner">
                            <div class="row">
                                <div class="col-md-12 ptop--30 ">
                                    <div class="post--items-title" data-ajax="tab">
                                        <h2 class="h4" style="    direction: rtl;">{{$categoryFirst->$name}}</h2>
                                    </div>
                                </div>
                                <div class="post--items" data-ajax-content="outer">
                                    <ul class="nav row gutter--15" data-ajax-content="inner">
                                        @php
                                        $newFirest = $news->first() ? $news->first() : new App\Models\Nw();
                                        @endphp
                                        <li class="col-xs-12 col-sm-12 col-md-12 col-lg-6 ">
                                            <div class="post--item post--layout-1">
                                                <div class="post--img mrg-top-m-34">
                                                    <a href="{{ route('site.new', $newFirest->id ?? 0) }}" class="thumb">
                                                        <img src="{{ asset('storage/' . $newFirest->img_view) }}" alt="{{ $newFirest->$title }}" style="object-fit: cover;" class="imgss">
                                                    </a>
                                                    <a href="#" class="cat"></a>
                                                    <a href="#" class="icon">
                                                        <i class="fa fa-flash"></i>
                                                    </a>
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li>
                                                                <a href="author?id=0"></a>
                                                            </li>
                                                            <li>
                                                                <a href=" #">{{ $newFirest->created_at->format('Y-m-d') }}</a>
                                                            </li>
                                                        </ul>
                                                        <div class="title" style="height:80px;">
                                                            <h3 class="text h4">
                                                                <a href="{{ route('site.new', $newFirest->id ?? 0) }}" class="btn-link text">{{ $newFirest->$title }}</a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="col-xs-12 col-sm-12 col-md-12 col-lg-6  ">
                                            <hr class="divider">
                                        </li>
                                        @foreach($news->skip(1)->take(6) as $new)
                                        <li class="col-xs-4 col-sm-6 col-md-4 col-lg-3 col-xl-3 home-sml-div">
                                            <div class="post--item post--layout-2">
                                                <div class="post--img">
                                                    <a href="{{ route('site.new', $new->id ?? 0) }}" class="thumb">
                                                        <img src="{{ asset('storage/' . $new->img_view) }}" alt="{{ $new->$title }}" class="home-sml-img">
                                                    </a>
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li>
                                                                <a href="author?id=0"></a>
                                                            </li>
                                                            <li>
                                                                <a href=" #">{{ $new->created_at->format('Y-m-d') }}</a>
                                                            </li>
                                                        </ul>
                                                        <div class="title" style="height: 50px;margin-bottom: 7px;">
                                                            <h3 class="h4">
                                                                <a href="{{ route('site.new', $new->id ?? 0) }}" maxlength="80" class="btn-link text">{{ $new->$title }}</a>
                                                            </h3>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="preloader bg--color-0--b" data-preloader="1">
                                        <div class="preloader--inner"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- مساحة اعلانية  -->
                            <div class="col-md-12 ptop--30 ">
                                <div class="post--items-title" style="padding: 0;" data-ajax="tab">
                                    <!-- <h2 class="h4" style="    direction: rtl;">
                                        إعلان </h2> -->
                                    @php
                                    $ads5 = App\Models\Ad::where('ad_place_id', '1')->first();
                                    @endphp
                                    @if($ads5)
                                    <a href="{{ $ads5->link }}">
                                        <img src="{{ asset('storage/' . $ads5->image) }}" alt="No Image For Ad"
                                            style="border: 1px solid gold;width: 100%;height:100px;">
                                    </a>
                                    @else
                                    <h2 class="h4" style="direction: rtl;"> <i class="icon fa fa-bullhorn"></i> إعلان </h2>
                                    @endif
                                </div>
                            </div>
                            <!--pbottom--30-->
                            <div class="row">
                                <div class="col-md-12 ptop--30 ">
                                    <div class="post--items-title" data-ajax="tab">
                                        <h2 class="h4" style="direction: rtl;">{{$categoryLast->$name}}</h2>
                                    </div>
                                </div>
                                <div class="post--items post--items-2" data-ajax-content="outer">
                                    <ul class="nav row gutter--15" data-ajax-content="inner">
                                        @php
                                        $articleFirest = $articles->first() ? $articles->first() : new App\Models\Artical();
                                        @endphp
                                        <li class="col-xs-12 col-sm-12 col-md-12 col-lg-6 ">
                                            <div class="post--item post--layout-1">
                                                <div class="post--img mrg-top-m-34">
                                                    <a href="{{ route('site.article', $articleFirest->id ?? 0) }}" class="thumb">
                                                        <img src="{{ asset('storage/' . $articleFirest->img_view) }}" alt="{{ $articleFirest->$title }}" style="object-fit: cover;" class="imgss">
                                                    </a>
                                                    <a href="#" class="cat"></a>
                                                    <a href="#" class="icon">
                                                        <i class="fa fa-flash"></i>
                                                    </a>
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li>
                                                                <a href="author?id=0"></a>
                                                            </li>
                                                            <li>
                                                                <a href=" #">{{ $articleFirest->created_at }}</a>
                                                            </li>
                                                        </ul>
                                                        <div class="title" style="    height: 80px;">
                                                            <h3 class="text h4">
                                                                <a href="{{ route('site.article', $articleFirest->id ?? 0) }}" class="btn-link text">{{ $articleFirest->$title }}</a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-xs-12 col-sm-12 col-md-12 col-lg-6  ">
                                            <hr class="divider">
                                        </li>
                                        @foreach($articles->skip(1)->take(6) as $article)
                                        <li class="col-xs-4 col-sm-6 col-md-4 col-lg-3 col-xl-3 home-sml-div" style="">
                                            <div class="post--item post--layout-2">
                                                <div class="post--img">
                                                    <a href="{{ route('site.article', $article->id) }}" class="thumb">
                                                        <img src="{{ asset('storage/' . $article->img_view) }}" alt="" class="home-sml-img">
                                                    </a>
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li>
                                                                <a href="author?id=0"></a>
                                                            </li>
                                                            <li>
                                                                <a href=" #">{{ $article->created_at->format('Y-m-d') }}</a>
                                                            </li>
                                                        </ul>
                                                        <div class="title" style="height: 50px;margin-bottom: 7px;">
                                                            <h3 class="h4">
                                                                <a href="{{ route('site.article', $article->id) }}" maxlength="80" class="btn-link text">{{ $article->$title }}</a>
                                                            </h3>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                    <div class="preloader bg--color-0--b" data-preloader="1">
                                        <div class="preloader--inner"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ptop--30 ">
                                <div class="post--items-title" style="padding: 0; margin: 20px 0;" data-ajax="tab">
                                    @php
                                    $ads6 = App\Models\Ad::where('ad_place_id', 2)->first();
                                    @endphp
                                    @if($ads6)
                                    <a href="{{ $ads6->link }}">
                                        <img src="{{ asset('storage/' . $ads6->image) }}" alt="No Image For Ad"
                                            style="border: 1px solid gold;width: 100%;height: 100px;">
                                    </a>
                                    @else
                                    <h2 class="h4" style="    direction: rtl;"> <i class="icon fa fa-bullhorn"></i> إعلان </h2>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-6 col-sm-5  col-lg-4 " style=" background-color: #670005; border: 1px solid #670005; border-radius: 19px;margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-3 col-sm-3  col-lg-3" style="background-image: url({{ asset('assets/img/rr37.png') }}); background-repeat: no-repeat;">
                                            <h5><a href="{{ route('site.news') }}" style="color: #fff;">&nbsp; </a></h5>
                                        </div>
                                        <div class="col-md-9 col-xs-9 col-sm-9  col-lg-9">
                                            <h5 style="text-align: center;"><a href="{{ route('site.news') }}" style="color: #fff;">
                                                    المزيد من الاخبار</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-0 col-sm-2  col-lg-4 "></div>
                                <div class="col-md-4 col-xs-6 col-sm-5  col-lg-4 " style="  background-color: #670005; border: 1px solid #670005; border-radius: 19px;margin-bottom: 10px;">
                                    <div class="row">

                                        <div class="col-md-9 col-xs-9 col-sm-9  col-lg-9" style="">
                                            <h5 style="text-align: center;"><a href="{{ route('site.articles') }}" style="color: #fff;">المزيد من المقالات </a>
                                            </h5>
                                        </div>
                                        <div class="col-md-3 col-xs-3 col-sm-3  col-lg-3" style="background-image: url({{ asset('assets/img/l37.png') }}); background-repeat: no-repeat;background-position-x: right;">
                                            <h5><a href="{{ route('site.articles') }}" style="color: #fff;">&nbsp;</a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    $ads = App\Models\Ad::where('ad_place_id', 5)->take(3)->get();
                                @endphp
                                @forelse ($ads as $ad)
                                    <div class="widget">
                                        <div class="">
                                            <a href="{{ $ad->url }}" title="{{ $ad->title }}">
                                                <img src="{{ asset('storage/' . $ad->image) }}" alt="off"  style="width: -webkit-fill-available;">
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="widget">
                                        <h2 class="h4" style="    direction: rtl;">
                                            <i class="icon fa fa-bullhorn"></i> إعلان </h2>
                                    </div>
                                @endforelse

                                <div class="widget">
                                    <div class="widget--title">
                                        <h2 class="h4" style="    direction: rtl;">
                                            حالة الطقس </h2>
                                        <i class="icon fa fa-bullhorn"></i>
                                    </div>
                                    <div class="">
                                        <a class="weatherwidget-io" href="https://forecast7.com/ar/31d9535d23/palestine/" data-label_1="PALESTINE" data-label_2="WEATHER" data-font="Cairo" data-icons="Climacons Animated" data-theme="pure" data-basecolor="#f8f8f8" data-textcolor="#000000" data-suncolor="#a74a4a" >PALESTINE WEATHER</a>
                                        <script>

                                        </script>
                                    </div>
                                </div>
                                <div class="widget">
                                    <div class="widget--title">
                                        <h2 class="h4" style="    direction: rtl;">
                                            أسعار العملات </h2>
                                        <i class="icon fa fa-bullhorn"></i>
                                    </div>
                                    <div class="">
                                        <a href="#">
                                            <iframe src="https://ecwidgets.economies.ae/rates?quotes=35,93,67,79,37,65&type=forex&hideColumn='change'&width=900&height=800&borderColor=670005&columnHeadColor=white&tableHeadBackground=670005&fontSize=18" width="100%" height="195px" style="border:1px solid #670005; " title="أسعار العملات" class="div-mobile"></iframe>
                                            <iframe src="https://ecwidgets.economies.ae/rates?quotes=35,93,67,79,37,65&type=forex&hideColumn='change'&width=100%&height=219&borderColor=670005&columnHeadColor=white&tableHeadBackground=670005" width="100%" height="194px" style="border:1px solid #670005;" title="أسعار العملات" class="div-ipad"></iframe>
                                        </a>
                                    </div>
                                </div>
                                @php
                                    $ads = App\Models\Ad::where('ad_place_id', 6)->take(3)->get();
                                @endphp
                                @forelse ($ads as $ad)
                                    <div class="widget">
                                        <div class="">
                                            <a href="{{ $ad->url }}" title="{{ $ad->title }}">
                                                <img src="{{ asset('storage/' . $ad->image) }}" alt="off"  style="width: -webkit-fill-available;">
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="widget">
                                        <h2 class="h4" style="    direction: rtl;">
                                            <i class="icon fa fa-bullhorn"></i> إعلان </h2>
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