<x-site-layout>

<div class="main-content--section">
<div class="page-wrapper">
<div class="container">

<!-- HEADER -->
<section class="video-header">

<h1 class="video-title">
    {{ $video->title_ar }}
</h1>

<div class="video-meta">

<span class="video-clock">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
        <circle cx="12" cy="12" r="10" stroke="#1E1E1E" stroke-width="2" />
        <path d="M12 6V12L16 14" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" />
    </svg>
</span>

<span class="video-date">
    {{ $video->created_at->translatedFormat('d F Y') }}
</span>

<span class="video-separator">|</span>

<span class="video-time">
    {{ $video->created_at->format('H:i') }}
</span>

</div>

</section>


<div class="layout">

<!-- MAIN -->
<main class="main-content">

<!-- VIDEO -->
<section class="article-media">

<div class="media-wrapper" data-video="{{ asset('storage/'.$video->video) }}">

<img src="{{ asset('storage/'.$video->img_view) }}" alt="">
<div class="media-overlay"></div>

<button class="play-btn">▶</button>

</div>

<div class="media-info">

<span class="media-source">
    {{ $video->source ?? 'المصدر غير متوفر' }}
</span>

<p>
    {{ $video->description_ar }}
</p>

</div>

</section>


<!-- PLAYLIST -->
<section class="vdo_playlist_cont">

<div class="playlist-grid">

@foreach($relatedVideos as $item)

<a href="{{ route('video.show',$item->slug) }}" class="playlist-card">

<div class="thumb">
    <img src="{{ asset('storage/'.$item->img_view) }}" alt="">
    <span class="thumb-play">▶</span>
</div>

<div class="card-content">

<span class="category">
    {{ $item->category->title_ar ?? '' }}
</span>

<h3>{{ $item->title_ar }}</h3>

<span class="date">
    <span>{{ $item->created_at->translatedFormat('d F Y') }}</span>
</span>

</div>

</a>

@endforeach

</div>

</section>


<!-- MORE VIDEOS -->
<section class="more-videos">

<div class="more-videos__header">
<h2 class="more-videos__title">المزيد من الفيديوهات</h2>
</div>

<div class="more-videos__grid">

@foreach($moreVideos as $item)

<a href="{{ route('video.show',$item->slug) }}" class="news-card">

<div class="news-card__media">

<img src="{{ asset('storage/'.$item->img_view) }}"
class="news-card__image">

<div class="news-card__play"></div>

<span class="video-card__time">
{{ $item->duration ?? '00:00' }}
</span>

</div>

<div class="news-card__body">

<div class="news-card__category">
{{ $item->category->title_ar ?? '' }}
</div>

<h3 class="news-card__title">
{{ $item->title_ar }}
</h3>

<div class="news-card__meta">

<span class="news-card__date">
{{ $item->created_at->translatedFormat('d F Y') }}
</span>

</div>

</div>

</a>

@endforeach

</div>

</section>

</main>


<!-- SIDEBAR -->
<aside class="sidebar">

<!-- BREAKING -->
<section class="sidebar-breaking">

<div class="breaking-header">
الأخبار العاجلة
</div>

@foreach($breakingNews as $news)

<div class="breaking-item">

<div class="breaking-time">
قبل {{ $news->created_at->diffForHumans() }}
</div>

<div class="breaking-body">

<p>{{ $news->title_ar }}</p>

<div class="breaking-more-box">
<a href="{{ route('articale.show',$news->slug) }}" class="breaking-more">
المزيد
</a>
</div>

</div>

</div>

@endforeach

</section>


<!-- PODCAST -->
<section class="sidebar-podcast">

<h2 class="podcast-title">
<span>بودكاست</span>
</h2>

<div class="podcast-wrapper">

@foreach($podcasts as $pod)

<a href="{{ route('podcast.show',$pod->slug) }}" class="podcast-item">

<div class="podcast-content">
<h3>{{ $pod->title_ar }}</h3>

<div class="podcast-date">
{{ $pod->created_at->translatedFormat('d F Y') }}
</div>
</div>

<div class="podcast-thumb">
<div class="play-icon">▶</div>
<span class="duration">{{ $pod->duration ?? '00:00' }}</span>
</div>

</a>

@endforeach

</div>

</section>


<!-- TRENDING -->
<section class="sidebar-trending">

<h2 class="trending-title">
<span>زوارنا يشاهدون الآن</span>
</h2>

@foreach($trending as $trend)

<a href="{{ route('video.show',$trend->slug) }}" class="trending-item">

<div class="item-thumb">
<img src="{{ asset('storage/'.$trend->img_view) }}">
</div>

<div class="item-content">
<h4>{{ $trend->category->title_ar ?? '' }}</h4>
<p>{{ $trend->title_ar }}</p>
</div>

</a>

@endforeach

</section>

</aside>

</div>

</div>
</div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $('.media-wrapper').on('click', '.play-btn', function () {

        let wrapper = $(this).closest('.media-wrapper');
        let videoSrc = wrapper.data('video');

        if (wrapper.find('video').length) return;

        let video = $('<video />', {
            src: videoSrc,
            controls: true,
            autoplay: true
        });

        wrapper.find('img, .media-overlay, .play-btn').remove();

        wrapper.append(video);

    });

});
</script>

</x-site-layout>