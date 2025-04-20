@php
    $name = 'name_' . app()->getLocale();
    $title = 'title_' . app()->getLocale();
@endphp
<script src="{{ asset('asset/js/plugins/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<header class="header--section header--style-1">
    <div class="header--topbar bg--color-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                    <div class=" float--right text-xs-center">
                        <ul class="header--topbar-info nav">
                            <li id="cur">
                                1&nbsp; <i class="fa fa-ils" style="font-size: 12px;"></i>
                                <i class="fa fa-long-arrow-right" aria-hidden="true"
                                    style="font-size: 12px;"></i> <i class="fa fa-usd"
                                    style="font-size: 13px;"></i>&nbsp;&nbsp; 1&nbsp; <i class="fa fa-ils"
                                    style="font-size: 12px;"></i>
                                <i class="fa fa-long-arrow-right" aria-hidden="true"
                                    style="font-size: 12px;"></i> JOD &nbsp;&nbsp; 1&nbsp; <i class="fa fa-ils"
                                    style="font-size: 12px;"></i>
                                <i class="fa fa-long-arrow-right" aria-hidden="true"
                                    style="font-size: 12px;"></i> <i class="fa fa-euro"
                                    style="font-size: 13px;"></i>
                                <i class="fa fm fa-map-marker"></i><span id="city"></span>
                                <i class="fa fm fa-mixcloud"></i>
                                <sup>0</sup> C
                            <li id="temp">
                                <i class="fa fm fa-calendar"></i><span id="datetime"></span>
                            </li>
                        </ul>
                    </div>
                    <div class=" float--left text-xs-center">
                        <ul class="header--topbar-action nav">
                            @guest('publisherGuard')
                            <li>
                                <a href="{{ url(app()->getLocale().'/publisher/login') }}">
                                    <i class="fa fm fa-user-o"></i> {{ __('site.Login') }}
                                </a>
                            </li>
                            <li>/</li>
                            <li>
                                <a href="{{ url(app()->getLocale().'/publisher/register') }}">
                                    {{ __('site.Signup') }}
                                </a>
                            </li>
                            @endguest
                            @auth('publisherGuard')
                            <li>
                                <a href="{{route('publisher.home')}}">
                                    <i class="fa fm fa-user-o"></i> {{__('site.dashboard')}}
                                </a>
                            </li>
                            @endauth
                        </ul>
                        <ul class="header--topbar-lang nav hidden-sm">
                            <li class="dropdown">
                                <a href="#"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; langc('ar')"
                                    class="dropdown-toggle" data-toggle="dropdown"
                                    data-cf-modified-6a7e8b1cabee735aa3fb2ed4-="">
                                    <i class="fa fm fa-language"></i>
                                    @if(app()->getLocale() == 'en')
                                        العربية
                                    @else
                                        English
                                    @endif
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        @php
                                            $lang = app()->getLocale() == 'en' ? 'ar' : 'en';
                                        @endphp
                                        <a href="{{ Str::replaceFirst(app()->getLocale(), $lang, url()->current()) }}"  id="toLang">
                                            @if(app()->getLocale() == 'en')
                                                العربية
                                            @else
                                                English
                                            @endif
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            onclick="if (!window.__cfRLUnblockHandlers) return false; langc('ar')"
                                            data-cf-modified-6a7e8b1cabee735aa3fb2ed4-="">Spanish</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            onclick="if (!window.__cfRLUnblockHandlers) return false; langc('ar')"
                                            data-cf-modified-6a7e8b1cabee735aa3fb2ed4-="">French</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header--mainbar">
        <div class="container">
            <div class="main-content--section">
                <div class="row hrader_logo_ads">
                    <!--header--logo-->
                    <div class="col-md-4 col-sm-12 float--right text-sm-center"
                        style="display: flex;justify-content: space-between;float: left;align-items: center;margin-bottom: 10px;">
                        <!--<h1 class="h1" >-->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#headerNav" aria-expanded="false" aria-controls="headerNav">
                                <span class="sr-only">Toggle Navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        @php
                            $logo = \App\Models\Setting::where('key', 'logo')->first();
                            if($logo){
                                $logo = $logo->value;
                            }
                        @endphp
                        <a href="{{ route('site.index') }}" class="btn-link col-sm-4 nav_logo_img" style="padding-right: 0px;">
                            @if($logo)
                                <img src="{{ asset('uploads/logos/' . $logo) }}" alt="" style="width: 80%;">
                            @else
                                <img src="{{ asset('assets/img/صورة_واتساب_بتاريخ_2024-10-09_في_12.53.11_cd9169ce.jpg') }}" alt="" style="width: 80%;">
                            @endif
                            <span class="hidden"> Logo</span>
                        </a>
                        <!--</h1>-->
                    </div>
                    <!--Marena-header.png-->
                    @php
                        $adsHerder = App\Models\Ad::where('ad_place_id', 8)->first();
                    @endphp
                    <div class="col-md-8 col-sm-12">
                        @if($adsHerder)
                            <a href="{{ $adsHerder->url }}" target="_blank">
                                <img src="{{ asset('storage/' . $adsHerder->image) }}" alt="jinn" style="border: 1px solid gold;width: 100%; height: 104px;">
                            </a>
                        @else
                            <a href="#">
                                <img src="{{ asset('assets/img/Marena-header.png') }}" alt="jinn" style="border: 1px solid gold;width: 100%; height: 104px;">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header--navbar style--1 navbar bd--color-1 bg--color-1" data-trigger="sticky">
        <div class="container">
            <div id="headerNav" class="navbar-collapse collapse float--right " style='margin-right:30%;'>
                <span class="close-menu"><i class="fa fa-times"></i></span>
                <ul class="header--menu-links nav navbar-nav" data-trigger="hoverIntent">
                    <li class="hidden-md hidden-lg">
                        <form action="{{route('site.news')}}" method="GET" class="header--search-form float--right">
                            <input type="search" name="search" id="stxt" placeholder="Search... "
                                class="header--search-control form-control " required
                                >
                            <button type="button" class="header--search-btn btn btn-header-1">
                                <i class="header--search-icon fa fa-search "></i>
                            </button>
                            <button type="submit" class="header--search-btn btn btn-header-2" style="display: none;">
                                <i class="header--search-icon fa fa-search "></i>
                            </button>
                        </form>
                    </li>
                    <li class="hidden-md hidden-lg ">
                        @php
                            $lang = app()->getLocale() == 'en' ? 'ar' : 'en';
                        @endphp
                        <a href="{{ Str::replaceFirst(app()->getLocale(), $lang, url()->current()) }}"
                            id="toLang2">
                            <i class="fa fm fa-language"></i>
                            @if(app()->getLocale() == 'en')
                                العربية
                            @else
                                English
                            @endif
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__('site.More')}}
                            <i class="fa flm fa-angle-left"></i>
                        </a>
                        <ul class="dropdown-menu scrollmenu" style="float: right;direction: rtl;text-align: right;">
                            @php
                                $categories = App\Models\Category::all();
                            @endphp
                            @foreach ($categories as $category)
                            <li style="width: 200px;padding: 20px;" class="box">
                                <a href="{{route('site.news', ['c' => $category->id])}}" class="row">
                                    <div class="col-md-12">
                                        <img src="{{asset('storage/'.$category->image)}}" style="width: max-content; height: 100px;">
                                    </div>
                                    <div class="col-md-12">
                                        <span >{{ $category->$name }}</span>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="{{ request()->is(app()->getLocale() . '/') ? 'active' : '' }}">
                        <a href="{{route('site.contact')}}">{{__('site.ContactUs')}}</a>
                    </li>
                    <li class="{{ request()->is(app()->getLocale() . '/') ? 'active' : '' }}">
                        <a href="{{route('site.about')}}">{{__('site.AboutUs')}}</a>
                    </li>
                    <li class="{{ request()->is(app()->getLocale() . '/') ? 'active' : '' }}">
                        <a href="{{route('site.news')}}">{{__('site.News')}}</a>
                    </li>
                    <li class="{{ request()->is(app()->getLocale() . '/') ? 'active' : '' }}">
                        <a href="{{route('site.articles')}}">{{__('site.Articles')}}</a>
                    </li>
                    <li class="{{ request()->is(app()->getLocale() . '/') ? 'active' : '' }}">
                        <a href="{{route('site.index')}}">{{__('site.Home')}}</a>
                    </li>
                </ul>
            </div>
            <form action="{{route('site.news')}}" method="GET" class="header--search-form float--right hidden-sm">
                <input type="search" name="search" id="stxt" placeholder="Search... "
                    class="header--search-control form-control " required
                    >
                <button type="button" class="header--search-btn btn btn-header-1">
                    <i class="header--search-icon fa fa-search "></i>
                </button>
                <button type="submit" class="header--search-btn btn btn-header-2" style="display: none;">
                    <i class="header--search-icon fa fa-search "></i>
                </button>
            </form>
        </div>
    </div>
</header>
