<x-site-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/video.css') }}">
    @endpush
    @php
    $titleField = 'title_' . app()->getLocale();
    $textField = 'text_' . app()->getLocale();
    $catNameField = 'name_' . app()->getLocale();
    $videoTitle = $video->$titleField ?? $video->title_ar ?? $video->title_en ?? '';
    $pageUrl = url()->current();
    @endphp

    <div class="main-content--section">
        <div class="page-wrapper">
            <div class="container">

                <!-- HEADER -->
                <section class="video-header">

                    <h1 class="video-title">
                        {{ $videoTitle }}
                    </h1>

                    <div class="video-header__row">
                    <div class="video-meta">

                        <span class="video-clock">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="12" r="10" stroke="#1E1E1E" stroke-width="2" />
                                <path d="M12 6V12L16 14" stroke="#1E1E1E" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>

                        <span class="video-date">
                            {{ optional($video->created_at)->translatedFormat('d F Y') }}
                        </span>

                        <span class="video-separator">|</span>

                        <span class="video-time">
                            {{ optional($video->created_at)->format('H:i') }}
                        </span>

                    </div>

                    <div class="video-share" aria-label="{{ __('site.share') }}">
                        <a class="video-share__link video-share__link--facebook"
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($pageUrl) }}"
                            target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            f
                        </a>
                        <a class="video-share__link video-share__link--whatsapp"
                            href="https://wa.me/?text={{ urlencode($videoTitle . ' ' . $pageUrl) }}"
                            target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                            واتساب
                        </a>
                        <a class="video-share__link video-share__link--x"
                            href="https://twitter.com/intent/tweet?url={{ urlencode($pageUrl) }}&text={{ urlencode($videoTitle) }}"
                            target="_blank" rel="noopener noreferrer" aria-label="X">
                            X
                        </a>
                        <button class="video-share__link video-share__link--copy" type="button"
                            data-share-url="{{ $pageUrl }}" aria-label="Copy link">
                            نسخ
                        </button>
                    </div>
                    </div>

                </section>


                <div class="layout">

                    <!-- MAIN -->
                    <main class="main-content">

                        <!-- VIDEO -->
                        <section class="article-media">

                             <div class="media-wrapper"
                                 data-video="{{ $video->vedio ? asset('storage/' . $video->vedio) : '' }}"
                                 data-url="{{ $video->video_url }}">

                                 <img src="{{ $video->img_view ? asset('storage/' . $video->img_view) : asset('assets/in-img/1.png') }}" alt="">
                                 <div class="media-overlay"></div>

                                <button class="play-btn">▶</button>

                            </div>

                            <div class="media-info">

                                <span class="media-source">
                                    {{ $video->category?->$catNameField ?? '' }}
                                </span>

                                <p>
                                    {!! $video->$textField ?? $video->text_ar ?? $video->text_en ?? '' !!}
                                </p>

                            </div>

                        </section>


                        <!-- PLAYLIST -->
                        <section class="vdo_playlist_cont">

                            <div class="playlist-grid">

                                @foreach($relatedVideos as $item)

                                <a href="{{ route('site.video.show', $item->slug) }}" class="playlist-card">

                                    <div class="thumb">
                                        <img src="{{ asset('storage/' . $item->img_view) }}" alt="">
                                        <span class="thumb-play">▶</span>
                                    </div>

                                    <div class="card-content">

                                        <span class="category">
                                            {{ $item->category?->$catNameField ?? '' }}
                                        </span>

                                        <h3>{{ $item->$titleField ?? $item->title_ar ?? $item->title_en ?? '' }}</h3>

                                        <span class="date">
                                            <span>{{ optional($item->created_at)->translatedFormat('d F Y') }}</span>
                                        </span>

                                    </div>

                                </a>

                                @endforeach

                            </div>

                        </section>


                        <!-- MORE VIDEOS -->
                        <section class="more-videos">

                            <div class="more-videos__header">
                                <h2 class="more-videos__title">{{ __('site.more_videos') }}</h2>
                            </div>

                            <div class="more-videos__grid">

                                @foreach($moreVideos as $item)

                                <a href="{{ route('site.video.show', $item->slug) }}" class="news-card">

                                    <div class="news-card__media">

                                        <img src="{{ asset('storage/' . $item->img_view) }}" class="news-card__image">

                                        <div class="news-card__play"></div>

                                        <span class="video-card__time">
                                            {{ $item->time ?? '00:00' }}
                                        </span>

                                    </div>

                                    <div class="news-card__body">

                                        <div class="news-card__category">
                                            {{ $item->category?->$catNameField ?? '' }}
                                        </div>

                                        <h3 class="news-card__title">
                                            {{ $item->$titleField ?? $item->title_ar ?? $item->title_en ?? '' }}
                                        </h3>

                                        <div class="news-card__meta">

                                            <span class="news-card__date">
                                                {{ optional($item->created_at)->translatedFormat('d F Y') }}
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
                                {{ __('site.breaking_news') }}
                            </div>

                            @foreach($breakingNews as $news)

                            <div class="breaking-item">

                                <div class="breaking-time">
                                    {{ __('site.before') }} {{ optional($news->created_at)->diffForHumans() }}
                                </div>

                                <div class="breaking-body">

                                    <p>{{ $news->{'title_' . app()->getLocale()} ?? $news->title_ar ?? $news->title_en ?? '' }}</p>

                                    <div class="breaking-more-box">
                                        <a href="{{ route('site.article', $news->id) }}" class="breaking-more">
                                            {{ __('site.more') }}
                                        </a>
                                    </div>

                                </div>

                            </div>

                            @endforeach

                        </section>


                        <!-- PODCAST -->
                        <section class="sidebar-podcast">

                            <h2 class="podcast-title">
                                <span>{{ __('site.podcasts') }}</span>
                            </h2>

                            <div class="podcast-wrapper">

                                @foreach($podcasts as $pod)

                                <a href="{{ route('site.podcast.show', $pod->slug) }}" class="podcast-item">

                                    <div class="podcast-content">
                                        <h3>{{ $pod->{'title_' . app()->getLocale()} ?? $pod->title_ar ?? $pod->title_en ?? '' }}</h3>

                                        <div class="podcast-date">
                                            {{ optional($pod->created_at)->translatedFormat('d F Y') }}
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
                                <span>{{ __('site.most_viewed_videos') }}</span>
                            </h2>

                            @foreach(($mostViewedVideos ?? collect()) as $trend)

                            <a href="{{ route('site.video.show', $trend->slug) }}" class="trending-item">

                                <div class="item-thumb">
                                    <img src="{{ asset('storage/' . $trend->img_view) }}">
                                </div>

                                <div class="item-content">
                                    <h4>{{ $trend->$titleField ?? '' }}</h4>
                                    <p>{{ $trend->$titleField ?? $trend->title_ar ?? $trend->title_en ?? '' }}</p>
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
            function getYouTubeEmbedUrl(url) {
                if (!url) return '';

                try {
                    const parsedUrl = new URL(url);
                    const host = parsedUrl.hostname.replace('www.', '');
                    let videoId = '';

                    if (host === 'youtu.be') {
                        videoId = parsedUrl.pathname.split('/').filter(Boolean)[0] || '';
                    } else if (host === 'youtube.com' || host === 'm.youtube.com' || host === 'youtube-nocookie.com') {
                        if (parsedUrl.pathname.startsWith('/embed/')) {
                            videoId = parsedUrl.pathname.split('/').filter(Boolean)[1] || '';
                        } else if (parsedUrl.pathname.startsWith('/shorts/')) {
                            videoId = parsedUrl.pathname.split('/').filter(Boolean)[1] || '';
                        } else {
                            videoId = parsedUrl.searchParams.get('v') || '';
                        }
                    }

                    return videoId ? `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0` : '';
                } catch (error) {
                    return '';
                }
            }

            function isDirectVideoUrl(url) {
                return /\.(mp4|webm|ogg)(\?.*)?$/i.test(url || '');
            }

            $('.media-wrapper').on('click', '.play-btn', function () {
                let wrapper = $(this).closest('.media-wrapper');
                let videoSrc = wrapper.data('video');
                let videoUrl = wrapper.data('url');

                if (wrapper.find('video, iframe').length) return;

                const youtubeEmbedUrl = getYouTubeEmbedUrl(videoUrl);

                if (videoUrl && !youtubeEmbedUrl && !isDirectVideoUrl(videoUrl)) {
                    window.open(videoUrl, '_blank', 'noopener,noreferrer');
                    return;
                }

                if (!youtubeEmbedUrl && !isDirectVideoUrl(videoUrl) && !videoSrc) return;

                wrapper.find('img, .media-overlay, .play-btn').remove();

                if (youtubeEmbedUrl) {
                    let iframe = $('<iframe />', {
                        src: youtubeEmbedUrl,
                        title: @json($videoTitle),
                        frameborder: 0,
                        allow: 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share',
                        allowfullscreen: true
                    });

                    wrapper.append(iframe);
                } else if (isDirectVideoUrl(videoUrl)) {
                    let video = $('<video />', {
                        src: videoUrl,
                        controls: true,
                        autoplay: true,
                        playsinline: true
                    });

                    wrapper.append(video);
                } else if (videoSrc) {
                    let video = $('<video />', {
                        src: videoSrc,
                        controls: true,
                        autoplay: true,
                        playsinline: true
                    });

                    wrapper.append(video);
                }
            });

            $('.video-share__link--copy').on('click', async function () {
                const button = $(this);
                const shareUrl = button.data('share-url');
                const originalText = button.text();

                try {
                    await navigator.clipboard.writeText(shareUrl);
                    button.text('تم النسخ');
                } catch (error) {
                    const input = $('<input />', { value: shareUrl }).appendTo('body').select();
                    document.execCommand('copy');
                    input.remove();
                    button.text('تم النسخ');
                }

                setTimeout(function () {
                    button.text(originalText);
                }, 1600);
            });
        });
    </script>
</x-site-layout>
