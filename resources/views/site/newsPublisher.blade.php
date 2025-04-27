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
                padding: 6px 9px !important;
                margin: 0 0.5px !important;
            }
            .h4{
                text-align: start !important;
            }
            .post--item.post--layout-2 .post--info {
                margin-top: 7px;
                margin-right: 40px;
            }
        </style>
    @endpush
    <div class="main--breadcrumb">
        <div class="container">
            <ul class="breadcrumb" style="direction: rtl">
                <li>
                    <a href="{{ route('site.index')}}" class="btn-link"><i class="fa fm fa-home"></i> الرئيسية</a>
                </li>
                <li class="active">
                    <span>{{$publisher->name ?? ''}}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content--section pbottom--30">
        <div class="container">
            <div class="row" id="contentRow">
                <div class="main--content col-md-8 col-sm-12" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <div class="post--author-info clearfix" id="com">
                            <div class="info">
                                <h2 class="h4">
                                    {{-- عن الناشر  --}}
                                    {{ __('site.about_publisher') }}
                                </h2>
                                <div class="content">
                                    <p>
                                        {{-- ناشرة في مجلة مارينا بوست  --}}
                                        {{ __('site.publisher_marina_post') }}
                                    </p>
                                </div>
                            </div>
                            <div class="img">
                                <div class="vc--parent">
                                    <div class="vc--child">
                                        <a href="{{route('site.publisherNews',$publisher->id)}}" class="btn-link">
                                            @if($publisher->img)
                                                <img src="{{asset('storage/'.$publisher->img)}}" alt="">
                                            @endif
                                            <br>
                                            <h3 class="name" style="text-align:center;color:red;">
                                                {{$publisher->name ?? ''}} </h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page--title ptop--30">
                            <h2 class="h2"></h2>
                        </div>
                        <div class="post--items post--items-2 pd--30-0">
                            <ul class="nav row AdjustRow">
                                @foreach ($news as $new )
                                <li class="col-md-12 col-sm-12 col-xs-12 col-lg-12 col-xss-12">
                                    <div class="post--item post--layout-2">
                                        <div class="post--img" style="display: flex; align-items: center;">
                                            <a href="{{ route('site.new', $new->slug)}}" class="thumb" style="width: 300px; justify-content: space-evenly;">
                                                <img
                                                    src="{{ asset('storage/' . $new->img_view) }}" alt=""
                                                    style="object-fit: contain;" /></a>
                                            <div class="post--info">
                                                <ul class="nav meta">
                                                    <li>
                                                        <a href="{{ route('site.news',['c' => $new->category_id]) }}" style="background-color: #454545; padding: 2px 10px; border-radius: 7px; color: #fff;">{{ $new->category ? $new->category->$name : '' }}</a>
                                                    </li>
                                                    <li><a href="#">{{ $new->created_at->format('Y-m-d') }}</a></li>
                                                </ul>
                                                <div class="title">
                                                    <h3 class="h4">

                                                        <a href="{{ route('site.new', $new->slug)}}" title="{{ $new->$title }}" class="btn-link">

                                                            {{ Illuminate\Support\Str::words($new->$title, 30, '...') }}
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
                        @if($news->lastPage() > 1)
                            <div class="pagination--wrapper clearfix bdtop--1 bd--color-2 ptop--60 pbottom--30" dir="rtl">
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
                <div class="main--sidebar col-md-4 col-sm-12 ptop--30 pbottom--30 text_dir"
                    data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">
                                    {{-- احصل على النشرة الإخبارية  --}}
                                    {{__('site.subscribe to our newsletter')}}
                                </h2> <i class="icon fa fa-envelope-open-o"></i>
                            </div>
                            <div class="subscribe--widget">
                                <div class="content">
                                    <p>
                                        {{-- اشترك في النشرة الإخبارية لدينا للحصول على آخر الأخبار والأخبار الشعبية
                                        والتحديثات الحصرية. --}}
                                        {{__('site.subscribe_to_our_newsletter_text')}}
                                    </p>
                                </div>
                                <form action="{{ route('site.addEmail') }}" method="post" name="mc-embedded-subscribe-form" target="_blank"
                                    data-form="mailchimpAjax">
                                    @csrf
                                    <div class="input-group">
                                        <input type="email" name="EMAIL"
                                            placeholder="عنوان بريد الكتروني" class="form-control"
                                            autocomplete="off" required
                                            data-cf-modified-74f1811ed9adbc6538a65f0a-="">
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-lg btn-default active">
                                                <i class="fa fa-paper-plane-o"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="status"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-site-layout>
