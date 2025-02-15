<header class="header--section header--style-1">
    <div class="header--topbar bg--color-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                    <div class="float--right float--xs-none text-xs-center">
                        <ul class="header--topbar-info nav">
                            <li id="cur">
                                1&nbsp; <i class="fa fa-ils" style="font-size: 12px"></i>
                                <i class="fa fa-long-arrow-right" aria-hidden="true"
                                    style="font-size: 12px"></i>
                                <i class="fa fa-usd" style="font-size: 13px"></i>&nbsp;&nbsp; 1&nbsp;
                                <i class="fa fa-ils" style="font-size: 12px"></i>
                                <i class="fa fa-long-arrow-right" aria-hidden="true"
                                    style="font-size: 12px"></i>
                                JOD &nbsp;&nbsp; 1&nbsp;
                                <i class="fa fa-ils" style="font-size: 12px"></i>
                                <i class="fa fa-long-arrow-right" aria-hidden="true"
                                    style="font-size: 12px"></i>
                                <i class="fa fa-euro" style="font-size: 13px"></i>
                            </li>

                            <li>
                                <i class="fa fm fa-map-marker"></i><span id="city"></span>
                            </li>
                            <li id="temp">
                                <i class="fa fm fa-mixcloud"></i>
                                <sup>0</sup> C
                            </li>

                            <li>
                                <i class="fa fm fa-calendar"></i>Thursday 13th of February
                                2025 04:15:09 AM
                            </li>
                        </ul>
                    </div>
                    <div class="float--left float--xs-none text-xs-center">
                        <ul class="header--topbar-action nav">
                            <li>
                                @auth
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn-link">
                                            <i class="fa fm fa-user-o"></i>  Logout
                                        </button>
                                    </form>
                                @else
                                <a href="{{route('login')}}">
                                    <i class="fa fm fa-user-o"></i> دخول/تسجيل
                                </a>
                                @endauth
                            </li>
                        </ul>
                        <ul class="header--topbar-lang nav">
                            <li class="dropdown">
                                <a href="#"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; langc('ar')"
                                    class="dropdown-toggle" data-toggle="dropdown"
                                    data-cf-modified-6a7e8b1cabee735aa3fb2ed4-="">
                                    <i class="fa fm fa-language"></i> English
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        @if(app()->getLocale() == 'en')
                                        <a href="/ar"  id="toLang">
                                            Arabic
                                        </a>
                                        @else
                                        <a href="/en"  id="toLang">
                                            English
                                        </a>
                                        @endif
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
        <!--<div class="container">-->
        <div class="main-content--section">
            <div class="row" style="margin: 0px 4%">
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-1" style="width: 2.333333%"></div>
                <!--header--logo-->
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-4 float--right float--sm-none text-sm-center" style=" justify-content: center; float: left; width: revert-layer; ">
                    <!--<h1 class="h1" >-->
                    <a href="home" class="btn-link">
                        <img src="{{ asset('assets/img/صورة_واتساب_بتاريخ_2024-10-09_في_12.53.11_cd9169ce.jpg') }}" alt="" style="width: 60%" />
                        <span class="hidden"> Logo</span>
                    </a>
                    <!--</h1>-->
                </div>
                <!--Marena-header.png-->

                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-7 float--sm-none">
                    <a href="https://www.jinnedu.com/">
                        <img src="{{ asset('assets/img/Marena-header.png') }}" alt="jinn"
                            style="border: 1px solid gold; width: 100%; height: 90px" />
                    </a>
                </div>
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-1"></div>
            </div>
        </div>
    </div>
    <div class="header--navbar style--1 navbar bd--color-1 bg--color-1" data-trigger="sticky">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#headerNav" aria-expanded="false" aria-controls="headerNav">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="headerNav" class="navbar-collapse collapse float--right" style="margin-right: 30%">
                <span class="close-menu"><i class="fa fa-times"></i></span>
                <ul class="header--menu-links nav navbar-nav" data-trigger="hoverIntent">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">المزيد <i
                                class="fa flm fa-angle-left"></i>
                        </a>

                        <ul class="dropdown-menu scrollmenu" style="float: right; direction: rtl; text-align: right">
                            @php
                                $categories = App\Models\Category::all();
                            @endphp
                            @foreach ($categories as $category)
                                <li style="width: 200px; padding: 20px" class="box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img src="{{asset('storage/'.$category->image)}}"style="width: max-content; height: 100px" />
                                        </div>
                                        <div class="col-md-12">
                                            <a href="{{route('site.news', $category->id)}}">{{ $category->$name }}</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="{{ request()->is(app()->getLocale() . '/contact') ? 'active' : '' }}">
                        <a href="{{route('site.contact')}}">تواصل معنا</a>
                    </li>
                    <li class="{{ request()->is(app()->getLocale() . '/about') ? 'active' : '' }}">
                        <a href="{{route('site.about')}}">من نحن</a>
                    </li>
                    <li class="{{ request()->is(app()->getLocale() . '/news') || request()->is('news/*') ? 'active' : '' }}">
                        <a href="{{route('site.news')}}">اخبار</a>
                    </li>
                    <li class="{{ request()->is(app()->getLocale() . '/articles') || request()->is('articles/*') ? 'active' : '' }}">
                        <a href="{{  route('site.articles') }}">مقالات</a>
                    </li>
                    <li class="{{ request()->is(app()->getLocale() . '/') ? 'active' : '' }}">
                        <a href="{{ route('site.index') }}">الرئيسية</a>
                    </li>
                </ul>
            </div>

            <form action="#" class="header--search-form float--right" data-form=" validate ">
                <input type="search " name="search " id="stxt " placeholder="Search... "
                    class="header--search-control form-control" required
                    onkeyup="if (!window.__cfRLUnblockHandlers) return false; myFn2( 'stxt') " />
                <button type="submit " class="header--search-btn btn">
                    <i class="header--search-icon fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</header>
