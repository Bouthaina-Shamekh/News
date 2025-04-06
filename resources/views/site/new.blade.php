<x-site-layout>
    @php
        $title = 'title_' . app()->getLocale();
        $name = 'name_' . app()->getLocale();
        $text = 'text_' . app()->getLocale();
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
        </style>
    @endpush
    <x-slot:header>
        <div class="main--breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="home" class="btn-link"><i class="fa fm fa-home"></i>{{__("site.Home")}}</a>
                    </li>
                    <li>
                        <a href="news?c={{ $new->category_id }}" class="btn-link">{{ $new->category->$name  ?? ''}} </a>
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
                                    <img src="{{asset('storage/'.$new->img_article)}}" alt=""></a> <a href="#"
                                    class="icon"><i class="fa fa-star-o"></i></a>
                                <div class="post--map">
                                </div>
                            </div>
                            <div class="post--cats">
                                <ul class="nav">
                                    <li><span><i class="fa fa-share"></i></span></li>
                                    <li><span><a href="https://www.facebook.com/sharer/sharer.php?u={{config('app.url') . 'new/' . $new->id}}"
                                                target="_blank"><i class="fa fa-facebook"></i></a></span></li>

                                    <li><span><a href="https://twitter.com/intent/tweet?text={{$new->$title}}&url={{config('app.url') . 'new/' . $new->id}}"
                                                target="_blank"><i class="fa fa-twitter"></i></a></span></li>
                                    <li><span><a href="https://wa.me/?text={{$new->$title}}%20{{config('app.url') . 'new/' . $new->id}}"
                                                target="_blank"><i class="fa fa-whatsapp"></i></a></span></li>
                                    <li><a onclick="if (!window.__cfRLUnblockHandlers) return false; like_dis('0','1155','1','like_v')"
                                            data-cf-modified-74f1811ed9adbc6538a65f0a-=""><i
                                                class="fa fa-thumbs-up"></i></a></li>
                                    <li><a onclick="if (!window.__cfRLUnblockHandlers) return false; like_dis('0','1155','1','dislike')"
                                            data-cf-modified-74f1811ed9adbc6538a65f0a-=""><i
                                                class="fa  fa-thumbs-down"></i></a></li>
                                    <li><a href="{{url('news?c='.$new->category_id)}}">{{$new->category->$name ?? ''}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="post--info">

                                <ul class="nav meta">
                                    <li><a href="news?psh=31">
                                        {{$new->publisher->name ?? ''}}
                                    </a>
                                    </li>
                                    <li><a href="#">{{date('Y-m-d',strtotime($new->created_at))}}</a></li>
                                    <li><span><i class="fa fm fa-eye"></i>{{$new->visit}}</span></li>
                                    {{-- <li><span id="slike"><i class="fa fa-thumbs-up"></i> 0</span></li>
                                    <li><span id="sdislike"><i class="fa fa-thumbs-down"></i> 0</span></li>
                                    <li><a href="#"><i class="fa fm fa-comments-o"></i>0</a> --}}
                                    </li>
                                </ul>
                                <div class="title dir_rtl">
                                    <h2 class="h4">{{$new->$title}}</h2>
                                </div>
                            </div>
                            <div class="post--content dir_rtl">
                                {!! $new->$text !!}
                            </div>
                            <div>
                                <video src="{{asset('storage/'.$new->vedio)}}" height="320" width="100%" controls></video>
                            </div>
                        </div>

                        <div class="post--author-info clearfix" id="com">
                            <div class="img">
                                <div class="vc--parent">
                                    <div class="vc--child">
                                        <a href="author?id=31" class="btn-link">
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
                                    عن الناشر </h2>
                                <div class="content">
                                    <p>ناشرة في مجلة مارينا بوست </p>
                                </div>

                            </div>
                        </div>

                        <div class="comment--list pd--30-0">
                            <div class="post--items-title">
                                <h2 class="h4">
                                    {{$new->comment->count()}} تعليقات </h2> <i class="icon fa fa-comments-o"></i>
                            </div>
                            <ul class="comment--items nav">
                                @foreach ($comments as $comment)
                                    <li class="comment--item mb-3">
                                        <div class="comment--info">
                                            <div class="title">
                                                <h3 class="name">
                                                    {{$comment->sender_name}}
                                                </h3>
                                            </div>
                                            <div class="content">
                                                <p>
                                                    {{$comment->text}}
                                                </p>
                                            </div>
                                            <div class="meta">
                                                <span class="date">
                                                    {{date('Y-m-d',strtotime($comment->created_at))}}
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="comment--form pd--30-0">
                            <div class="post--items-title">
                                <h2 class="h4">
                                    اترك تعليقا </h2> <i class="icon fa fa-pencil-square-o"></i>
                            </div>
                            <div class="comment-respond text_dir {
                                text-align: left;
                            }">
                                <form action="{{route('site.comment')}}" method="post" data-form="validate">
                                    @csrf
                                    <p>لا تقلق! لن يتم نشر عنوان بريدك الإلكتروني. الحقول الإلزامية مشار إليها
                                        بعلامة (*). </p>
                                    <div class="row">
                                        <input type="hidden" name="nw_id" value="{{$new->id}}">
                                        <div class="col-sm-6"> <label>
                                                <input type="text" value="a" style="display:none;" name="artical">
                                                <span>{{('comment')}} * </span>
                                                <textarea name="comment" id="comment" class="form-control" required onkeyup="if (!window.__cfRLUnblockHandlers) return false;  myFn2('comment')" data-cf-modified-74f1811ed9adbc6538a65f0a-="">
                                                </textarea>
                                            </label> </div>
                                        <div class="col-sm-6"> <label>
                                                <span>{{('name')}} *</span>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    required
                                                    onkeyup="if (!window.__cfRLUnblockHandlers) return false;  myFn2('name')"
                                                    data-cf-modified-74f1811ed9adbc6538a65f0a-="">
                                                <input type="text" name="id" id="id" class="form-control" required
                                                    onkeyup="if (!window.__cfRLUnblockHandlers) return false;  myFn2('id')"
                                                    value="1155" style="display: none;"
                                                    data-cf-modified-74f1811ed9adbc6538a65f0a-="">
                                            </label>
                                            <label>
                                                <span>{{('email')}} *</span>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required
                                                    onkeyup="if (!window.__cfRLUnblockHandlers) return false;  myFn2('email')"
                                                    data-cf-modified-74f1811ed9adbc6538a65f0a-=""> </label>
                                        </div>
                                        <div class="col-md-12"> <button type="submit" class="btn btn-primary">
                                                {{('submit')}} </button> </div>
                                    </div>
                                </form>
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
                                <form action="#" method="post" name="mc-embedded-subscribe-form" target="_blank"
                                    data-form="mailchimpAjax">
                                    <div class="input-group">
                                        <input type="email" name="EMAIL"
                                            onkeyup="if (!window.__cfRLUnblockHandlers) return false; myFn2('EMAIL')"
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
                                        @foreach ($news as $newS)
                                        <li>
                                            <div class="post--item post--layout-3">
                                                <div class="post--img">
                                                    <a href="{{ route('site.news',$newS->id) }}" class="thumb" style="float: right;">
                                                        <img src="{{asset('storage/'.$newS->img_view)}}" alt="">
                                                    </a>
                                                    <div class="post--info">
                                                        <ul class="nav meta" style="text-align: center;">
                                                            <li>
                                                                <a href="#"></a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('site.news',$newS->id) }}">{{$newS->created_at->format('Y-M-d')}}</a>
                                                            </li>
                                                        </ul>
                                                        <div class="title">
                                                            <h3 class="h4"
                                                                style="text-align: right; padding-right: 27px;">
                                                                <a href="{{ route('site.news',$newS->id) }}" class="btn-link news-title">{{$newS->$title}}</a>
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
