<x-site-layout>
    @php
        $title = 'title_' . app()->getLocale();
        $name = 'name_' . app()->getLocale();
        $text = 'text_' . app()->getLocale();

        $lang = request()->query('lang') ?? false;
    @endphp
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-new/css/new.css') }}">
    @endpush
@push('meta')
    @php
        $titleVal = $lang == 'org' ? $new->title_org : $new->$title;
        $descriptionVal = Str::limit(strip_tags($lang == 'org' ? $new->text_org : $new->$text), 160);
        $image = $new->img_article ? asset('storage/' . $new->img_article) : asset('storage/' . $new->img_view);
        $url = route('site.new', $new->slug);
    @endphp

    @section('has_custom_meta', true)

    <title>{{ $titleVal }}</title>
    <meta name="description" content="{{ $descriptionVal }}">
    <meta name="keywords" content="مارينا بوست, {{ $new->category->$name ?? '' }}">
    <link rel="canonical" href="{{ $url }}">
    <meta name="robots" content="index, follow">

    <!-- OG -->
    <meta property="og:title" content="{{ $titleVal }}">
    <meta property="og:description" content="{{ $descriptionVal }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="{{ $url }}">
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="مارينا بوست">
    <meta property="og:locale" content="ar_AR">
    <meta property="og:image:alt" content="{{ $titleVal }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $titleVal }}">
    <meta name="twitter:description" content="{{ $descriptionVal }}">
    <meta name="twitter:image" content="{{ $image }}">
    <meta name="twitter:url" content="{{ $url }}">
@endpush
    <x-slot:header>
        <div class="main--breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('site.index') }}" class="btn-link"><i class="fa fm fa-home"></i>{{__("site.Home")}}</a>
                    </li>
                    <li>
                        <a href="{{ route('site.news', ['c' => $new->category_id]) }}" class="btn-link">{{ $new->category->$name  ?? ''}} </a>
                    </li>
                    <li class="active">
                        <span>{{ $new->$title }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </x-slot:header>
    <div class="main-content--section pbottom--30">
        <div class="container">
            <div class="row">
                <div class="main--content col-md-8" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <div class="post--item post--single post--title-largest pd--30-0">
                            <div class="post--img">
                                <a href="#" class="thumb">
                                    <br>
                                    @if($new->img_view)
                                        <img src="{{asset('storage/'.$new->img_view)}}" alt="">
                                    @endif
                                </a>
                                <a href="#"
                                    class="icon"><i class="fa fa-star-o"></i></a>
                                <div class="post--map">
                                </div>
                            </div>
                            <div class="post--cats">
                                <ul class="nav">
                                    <li>
                                        <span>
                                            <a href="#">
                                                <i class="fa fa-share"></i>
                                            </a>
                                        </span>
                                    </li>

                                    <li><span><a href="https://www.facebook.com/sharer/sharer.php?u={{config('app.url') . '/news/' . $new->slug}}"

                                                target="_blank"><i class="fa fa-facebook"></i></a></span></li>

                                    <li><span><a href="https://twitter.com/intent/tweet?text={{$new->$title}}&url={{config('app.url') . '/news/' . $new->slug}}"
                                                target="_blank"><i class="fa fa-twitter"></i></a></span></li>
                                    <li><span><a href="https://wa.me/?text={{$new->$title}}%20{{config('app.url') . '/news/' . $new->slug}}"
                                                target="_blank"><i class="fa fa-whatsapp"></i></a></span></li>
                                    <li class="like_v_btn" data-type="true">
                                        <a>
                                            <i class="fa fa-thumbs-up"></i>
                                        </a>
                                    </li>
                                    <li class="like_v_btn" data-type="false">
                                        <a>
                                            <i class="fa  fa-thumbs-down"></i>
                                        </a>
                                    </li>
                                    <li><a href="{{url('news?c='.$new->category_id)}}">{{$new->category->$name ?? ''}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="post--info">
                                <ul class="nav meta">
                                    <li><a href="{{ route('site.publisher', $new->publisher ? $new->publisher->id : 0) }}">
                                        {{$new->publisher->name ?? ''}}
                                    </a>
                                    </li>
                                    <li><a href="#">{{date('Y-m-d',strtotime($new->created_at))}}</a></li>
                                    <li><a href="#"><i class="fa fm fa-eye"></i>{{$new->visit}}</a></li>
                                    {{-- <li><span id="slike"><i class="fa fa-thumbs-up"></i> 0</span></li>
                                    <li><span id="sdislike"><i class="fa fa-thumbs-down"></i> 0</span></li>
                                    <li><a href="#"><i class="fa fm fa-comments-o"></i>0</a> --}}
                                    </li>
                                </ul>
                                <div class="title dir_rtl">
                                    <h2 class="h2 text-dark">{{$lang == 'org' ? $new->title_org : $new->$title}}</h2>
                                </div>
                            </div>
                            <div style="margin:20px 10px">
                                <a href="{{route('site.new',$new->slug)}}?lang=org" class="link__org">
                                    عرض النص باللغة الأصلية *
                                </a>
                            </div>
                            @if($new->img_article)
                            <div class="post--img">
                                <img src="{{asset('storage/'.$new->img_article)}}" alt="">
                            </div>
                            @endif
                            <div class="post--content dir_rtl">
                                {!! $lang == 'org' ? $new->text_org : $new->$text !!}
                            </div>
                            @php
                                $vedio = $new->vedio;
                                $check = $vedio ? Storage::disk('public')->exists($new->vedio) : false;
                            @endphp
                            @if($new->vedio && $check)
                            <div>
                                <video src="{{asset('storage/'.$new->vedio)}}" height="320" width="100%" controls></video>
                            </div>
                            @endif
                        </div>
                        @php
                            $ads = App\Models\Ad::where('ad_place_id', 9)->get();
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
                                    {{__('site.ad')}}
                                </h2>
                            </div>
                        @endforelse
                        @if($new->publisher && $new->publisher->id != 0)
                        <div class="post--author-info clearfix" id="com">
                            <div class="img">
                                <div class="vc--parent">
                                    <div class="vc--child">
                                        <a href="{{route('site.publisherNews',$new->publisher ? $new->publisher->id : 0)}}" class="btn-link">
                                            @if($new->publisher)
                                            <img src="{{asset('storage/'.$new->publisher->img)}}" alt="">
                                            @endif
                                            <br>
                                            <h3 class="name" style="text-align:center;color:red;">
                                                {{$new->publisher->name ?? ''}} </h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
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
                        </div>
                        @endif

                    </div>
                </div>
                <div class="main--sidebar col-md-4 ptop--30 pbottom--30" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <div class="widget">
                            <div class=" style--1">
                                {{-- <ul class="nav">
                                    <li style="    width: 50%;     float: left;">
                                        <a href="{{route('author',['id'=>$article->publisher ? $article->publisher->id : 0])}}" class="btn btn-lg btn-default active">
                                            اخبار الناشر <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li style="    width: 50%;     float: left;">
                                        <a href="{{}}" class="btn btn-lg btn-default active">
                                            نبذه عن الناشر <i class="fa fa-user" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">
                                    {{-- ابق على اتصال --}}
                                    تابعنا على مواقع التواصل الاجتماعي
                                </h2> <i class="icon fa fa-share-alt"></i>
                            </div>
                            <div class="social--widget style--1">
                                <ul class="nav">
                                    @php
                                        $settings= App\Models\Setting::get();
                                    @endphp
                                    <li class="facebook">
                                        {{-- <a href="https://www.facebook.com/marena.post.news?locale=ar_AR"> --}}
                                        <a href="{{ $settings->where('key','facebook')->first() ? $settings->where('key','facebook')->first()->value : '' }}">
                                            <span class="icon">
                                                <i class="fa fa-facebook-f" style="margin-top:13px"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="rss">
                                        <a href="{{ $settings->where('key','instagram')->first() ? $settings->where('key','instagram')->first()->value : '' }}">
                                            <span class="icon">
                                                <i class="fa fa-instagram" style="margin-top:13px"></i>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="youtube">
                                        <a href="{{ $settings->where('key','youtube')->first() ? $settings->where('key','youtube')->first()->value : '' }}">
                                            <span class="icon">
                                                <i class="fa fa-youtube-square" style="margin-top:13px"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
                                <form action="{{ route('site.addEmail') }}" method="post" name="mc-embedded-subscribe-form" data-form="mailchimpAjax">
                                    @csrf
                                    <div class="input-group">
                                        <input type="email" name="email"
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
                                    @if(session('successAdd'))
                                        <div class="alert alert-success mt-3">
                                            نجح الإشتراك في الخدمة
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">
                                    {{-- مقالات ذات صلة  --}}
                                    {{__('site.related_news')}}
                                </h2> <i class="icon fa fa-newspaper-o"></i>
                            </div>
                            <div class="list--widget list--widget-1">
                                <div class="post--items post--items-3" data-ajax-content="outer">
                                    <ul class="nav" data-ajax-content="inner" id="nav_sider">
                                        @foreach ($news as $newS)
                                        <li>
                                            <div class="post--item post--layout-3">
                                                <div class="post--img" style="display: flex; align-items: center;">
                                                    <a href="{{ route('site.new', $newS->slug)}}" class="thumb" style="width: 160px; justify-content: space-evenly;">
                                                        <img src="{{ asset('storage/' . $newS->img_view) }}" alt="" style="object-fit: contain;" />
                                                    </a>
                                                    <div class="post--info post--info-3">
                                                        <ul class="nav meta">
                                                            <li>
                                                                <a href="{{ route('site.news',['c' => $newS->category_id]) }}" style="background-color: #454545; padding: 2px 6px; border-radius: 7px; color: #fff;">{{ $newS->category ? $newS->category->$name : '' }}</a>
                                                            </li>
                                                            <li><a href="#">{{ $newS->created_at->format('Y-m-d') }}</a></li>
                                                        </ul>
                                                        <div class="title">
                                                            <h3 class="h4">
                                                                <a href="{{ route('site.new', $newS->slug)}}" title="{{ $newS->$title }}" class="btn-link">
                                                                    {{ Illuminate\Support\Str::words($newS->$title, 10, '...') }}
                                                                </a>
                                                            </h3>
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
                        </div>
                        <!--جانبي صفحة الخبر 300x250 -->
                        @php
                            $ads = App\Models\Ad::where('ad_place_id', 10)->get();
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
                                    {{__('site.ad')}}
                                </h2>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.like_v_btn', function() {
            let type = $(this).data('type');
            let $btn = $(this);
            $.ajax({
                url: `{{ route('site.new.like',':id')}}`.replace(':id', "{{ $new->slug }}"),
                method: 'POST',
                data: {
                    type: type,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $btn.css('background-color', '#670005');
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('copy', function (e) {
        let selection = window.getSelection();
        let selectedText = selection.toString();

        if (!selectedText || selectedText.length < 20) return; // تجاهل النسخ القصير

        let pageUrl = "{{ route('site.new', $new->slug) }}";
        let sourceText = "\n\nرابط المصدر: " + pageUrl;

        let newText = selectedText + sourceText;

        e.clipboardData.setData('text/plain', newText);
        e.preventDefault();
    });
</script>
@endpush
</x-site-layout>
