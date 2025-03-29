<x-site-layout>
    @php
        $title = 'title_' . app()->getLocale();
        $name = 'name_' . app()->getLocale();
    @endphp
    @push('styles')
        <style>
            .news-title{
                display: inline-block !important;
                max-width: 395px !important;
                white-space: nowrap;
                overflow: clip;
                text-overflow: ellipsis;
                text-align: start !important;
            }
            .AdjustRow li {
                padding: 6px 14px !important;
            }
            .h4{
                text-align: start !important;
            }
        </style>
    @endpush
    <x-slot:header>
        <div class="posts--filter-bar style--1 hidden-xs">
            <div class="container">
                <ul class="nav">
                    @foreach ($newPalces as $newPalce)
                    <li>
                        <a href="news?pl={{ $newPalce->id }}">
                            <i class="fa fa-heart-o"></i>
                            <span>{{ $newPalce->$name }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </x-slot:header>
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb" style="direction: rtl">
                <li>
                    <a href="{{ route('site.index')}}" class="btn-link"><i class="fa fm fa-home"></i> الرئيسية</a>
                </li>
                <li class="active">
                    <span>الاخبار</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content--section pbottom--30">
        <div class="container">
            <div class="row" id="contentRow">
                <div class="main--content col-md-8 col-sm-7" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <div class="page--title ptop--30">
                            <h2 class="h2"></h2>
                        </div>
                        <div class="post--items post--items-2 pd--30-0">
                            <ul class="nav row AdjustRow">
                                @foreach ($news as $new )
                                <li class="col-md-5 col-sm-12 col-xs-6 col-lg-6 col-xss-12">
                                    <div class="post--item post--layout-2">
                                        <div class="post--img">
                                            <a href="{{ route('site.new', $new->id)}}" class="thumb"><img
                                                    src="{{ asset('storage/' . $new->img_view) }}" alt=""
                                                    style="height: 193px; object-fit: cover;" /></a>
                                            <div class="post--info">
                                                <ul class="nav meta">
                                                    <li>
                                                        <a href="author?id=0"></a>
                                                    </li>
                                                    <li><a href="#">{{ $new->created_at }}</a></li>
                                                </ul>
                                                <div class="title">
                                                    <h3 class="h4">
                                                        <a href="{{ route('site.new', $new->id)}}" class="btn-link news-title">
                                                            {{ $new->$title }}
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
                        @if(request()->is(app()->getLocale() . '/news') && $news->lastPage() > 1)
                            <div class="pagination--wrapper clearfix bdtop--1 bd--color-2 ptop--60 pbottom--30">
                                <ul class="pagination">
                                    <li>
                                        <a href="{{ $news->previousPageUrl() . (http_build_query(request()->except('page')) ? '&' . http_build_query(request()->except('page')) : '') }}">
                                            <i class="fa fa-long-arrow-right"></i>
                                        </a>
                                    </li>

                                    {{-- عرض الصفحات بين النطاق السابق واللاحق للصفحة الحالية --}}
                                    @php
                                        $currentPage = $news->currentPage();
                                        $lastPage = $news->lastPage();
                                        $range = 2;  // عرض صفحتين قبل وبعد الصفحة الحالية
                                    @endphp

                                    @for($i = max(1, $currentPage - $range); $i <= min($lastPage, $currentPage + $range); $i++)
                                        <li class="{{ $currentPage == $i ? 'active' : '' }}">
                                            <a href="{{ $news->url($i) . (http_build_query(request()->except('page')) ? '&' . http_build_query(request()->except('page')) : '') }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <li>
                                        <a href="{{ $news->nextPageUrl() . (http_build_query(request()->except('page')) ? '&' . http_build_query(request()->except('page')) : '') }}">
                                            <i class="fa fa-long-arrow-left"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30 text_dir"
                    data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <div class="widget"></div>
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">فئة</h2>
                                <i class="icon fa fa-folder-open-o"></i>
                            </div>
                            <div class="nav--widget">
                                <ul class="nav">
                                    @foreach ($categories as $category)
                                    <li>
                                        <a href="news?c={{ $category->id }}">
                                            <span> ({{ $category->nw->count() }})</span><span>{{ $category->$name }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">العلامات</h2>
                                <i class="icon fa fa-tags"></i>
                            </div>
                            <div class="tags--widget style--1">
                                <ul class="nav">
                                    <li><a href="news?pl=7"> الأكثر شهرة</a></li>
                                    <li><a href="news?pl=6"> أخبار مميزة</a></li>
                                    <li>
                                        <a href="news?pl=4"> سلايدر الارتفاع ٣٠٠ عرض ٤٥٠</a>
                                    </li>
                                    <li><a href="news?pl=3"> الأكثر مشاهدة</a></li>
                                    <li><a href="news?pl=2"> عصري </a></li>
                                    <li><a href="news?pl=1"> Hot</a></li>
                                </ul>
                            </div>
                        </div>
                        @php
                        $ads5 = App\Models\Ad::where('ad_place_id', 10)->first();
                        @endphp
                        <div class="widget">
                            <div class="widget--title">
                                @if($ads5)
                                <a href="{{ $ads5->link }}">
                                    <img src="../assets/files/{{ $ads5->image }}" alt="No Image For Ad"
                                        style="border: 1px solid gold;width: 100%;height: 100px;">
                                </a>
                                @else
                                <h2 class="h4">إعلان</h2>
                                <i class="icon fa fa-bullhorn"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-site-layout>
