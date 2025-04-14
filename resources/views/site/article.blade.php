<x-site-layout>
    @php
        $title = 'title_' . app()->getLocale();
        $name = 'name_' . app()->getLocale();
        $text = 'text_' . app()->getLocale();
    @endphp
    <x-slot:header>
        <div class="main--breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="{{ route('site.index') }}" class="btn-link"><i class="fa fm fa-home"></i>{{__("site.Home")}}</a>
                    </li>
                    <li>
                        <a href="{{ route('site.articles',['c' => $article->category_id]) }}" class="btn-link">{{ $article->category->$name ?? '' }} </a>
                    </li>
                    <li class="active">
                        <span>{{ $article->$title }}</span>
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
                                    @if($article->img_view)
                                        <img src="{{asset('storage/'.$article->img_view)}}" alt="">
                                    @endif
                                </a> <a href="#"
                                    class="icon"><i class="fa fa-star-o"></i></a>
                                <div class="post--map">
                                </div>
                            </div>
                            <div class="post--cats">
                                <ul class="nav">
                                    <li><span><i class="fa fa-share"></i></span></li>
                                    <li><span><a href="https://www.facebook.com/sharer/sharer.php?u={{config('app.url') . 'article/' . $article->id}}"
                                                target="_blank"><i class="fa fa-facebook"></i></a></span></li>

                                    <li><span><a href="https://twitter.com/intent/tweet?text={{$article->$title}}&url={{config('app.url') . 'article/' . $article->id}}"
                                                target="_blank"><i class="fa fa-twitter"></i></a></span></li>
                                    <li><span><a href="https://wa.me/?text={{$article->$title}}%20{{config('app.url') . 'article/' . $article->id}}"
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
                                    <li><a href="{{url('articles?c='.$article->category_id)}}">{{$article->category->$name ?? ''}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="post--info">
                                <ul class="nav meta">
                                    <li><a href="news?psh=31">
                                        {{$article->publisher->name ?? ''}}
                                    </a>
                                    </li>
                                    <li><a href="#">{{date('Y-m-d',strtotime($article->created_at))}}</a></li>
                                    <li><span><i class="fa fm fa-eye"></i>{{$article->visit}}</span></li>
                                    {{-- <li><span id="slike"><i class="fa fa-thumbs-up"></i> 0</span></li>
                                    <li><span id="sdislike"><i class="fa fa-thumbs-down"></i> 0</span></li>
                                    <li><a href="#"><i class="fa fm fa-comments-o"></i>0</a> --}}
                                    </li>
                                </ul>
                                <div class="title dir_rtl">
                                    <h2 class="h2 text-dark">{{$article->$title}}</h2>
                                </div>
                            </div>
                            @if($article->img_article)
                            <div class="post--img">
                                <img src="{{asset('storage/'.$article->img_article)}}" alt="">
                            </div>
                            @endif
                            <div class="post--content dir_rtl">
                                {!! $article->$text !!}
                            </div>
                            @if($article->vedio)
                            <div>
                                <video src="{{asset('storage/'.$article->vedio)}}" height="320" width="100%" controls></video>
                            </div>
                            @endif
                        </div>
                        @php
                            $ads = App\Models\Ad::where('ad_place_id', 9)->take(3)->get();
                        @endphp
                        @forelse ($ads as $ad)
                            <div class="widget">
                                <div class="">
                                    <a href="{{ $ad->url }}" title="{{ $ad->title }}" target="_blank">
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
                        <div class="post--author-info clearfix" id="com">
                            <div class="img">
                                <div class="vc--parent">
                                    <div class="vc--child">
                                        <a href="author?id=31" class="btn-link">
                                            @if($article->publisher)
                                            <img src="{{asset('storage/'.$article->publisher->img)}}" alt="">
                                            <br>
                                            <h3 class="name" style="text-align:center;color:red;">
                                                {{$article->publisher->name ?? ''}} </h3>
                                            @else
                                            {{-- <img src="" alt=""> --}}
                                            <br>
                                            <h3 class="name" style="text-align:center;color:red;">
                                                {{$article->publisher->name ?? ''}} </h3>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <h2 class="h4">
                                    عن الناشر </h2>
                                <div class="content">
                                    <p>ناشرة في مجلة مارينا بوست </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main--sidebar col-md-4 ptop--30 pbottom--30" data-sticky-content="true">
                    <div class="sticky-content-inner">
                        <div class="widget">
                            <div class=" style--1">
                                {{-- <ul class="nav">
                                    <li style="    width: 50%;     float: left;">
                                        <a href="{{route('author',['id'=>$article->publisher->id])}}" class="btn btn-lg btn-default active">
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
                                    ابق على اتصال </h2> <i class="icon fa fa-share-alt"></i>
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
                                    احصل على النشرة الإخبارية </h2> <i class="icon fa fa-envelope-open-o"></i>
                            </div>
                            <div class="subscribe--widget">
                                <div class="content">
                                    <p>
                                        اشترك في النشرة الإخبارية لدينا للحصول على آخر الأخبار والأخبار الشعبية
                                        والتحديثات الحصرية.
                                    </p>
                                </div>
                                <form action="{{ route('site.addEmail') }}" method="post">
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
                                </form>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">
                                    مقالات ذات صلة </h2> <i class="icon fa fa-newspaper-o"></i>
                            </div>
                            <div class="list--widget list--widget-1">
                                <div class="post--items post--items-3" data-ajax-content="outer">
                                    <ul class="nav" data-ajax-content="inner" id="nav_sider">
                                        @foreach ($articles as $articleS)
                                        <li>
                                            <div class="post--item post--layout-3">
                                                <div class="post--img">
                                                    <a href="{{ route('site.article',$articleS->id) }}" class="thumb" style="float: right;">
                                                        <img src="{{asset('storage/'.$articleS->img_view)}}" alt="">
                                                    </a>
                                                    <div class="post--info">
                                                        <ul class="nav meta" style="text-align: center;">
                                                            <li>
                                                                <a href="#"></a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('site.article',$articleS->id) }}">{{$articleS->created_at->format('Y-M-d')}}</a>
                                                            </li>
                                                        </ul>
                                                        <div class="title">
                                                            <h3 class="h4"
                                                                style="text-align: right;     padding-right: 27px;">
                                                                <a href="{{ route('site.article',$articleS->id) }}" class="btn-link">{{$articleS->$title}}</a>
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
                        <div class="widget">
                            <div class="widget--title">
                                <h2 class="h4">
                                    إعلان </h2> <i class="icon fa fa-bullhorn"></i>
                            </div>
                            <div class="">
                                <a href="#">
                                    <img src="../assets/files/addad.jpg" alt="مساحة اعلانية">
                                </a>
                            </div>

                            <div class="">
                                <a href="مساحة اعلانيه">
                                    <img src="../assets/files/ad35.jpg" alt="مساحة اعلانيه">
                                </a>
                            </div>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</x-site-layout>
@push('scripts')
<script>
    $(document).ready(function() {
        $('.like_v_btn').on('click',function(){
            let type = $(this).data('type');
            $.ajax({
                url: `{{ route('site.article.like',':id')}}`.replace(':id', "{{ $article->id }}"),
                method: 'POST',
                data: {
                    type: type,
                },
                success: function(response) {
                    $(this).attr('style', 'background-color: #670005')
                }
            });
        });
    });
</script>
@endpush