@php
    $title = 'title_' . app()->getLocale();
    $text = 'text_' . app()->getLocale();
    $podcastImg = $podcast->img_view ?? $podcast->img_podcast;
    $podcastImgUrl = $podcastImg ? asset('storage/' . $podcastImg) : asset('assets/in-img/podcasts/6.png');
@endphp

<x-site-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/podcast.css') }}">
    @endpush

        <div class="main-content--section ">
            <div class="page-wrapper podcasts-page">
                <div class="podcast-bg" style="background-image: url('{{ asset('assets-new/bg.png') }}');"></div>

                <div class="container podcasts-container">

                    <section class="podcast-hero">

                        <!-- ══ Right: Program Image / Video Player ══ -->
                        @php
                            $heroType = $firstEpisode ? ($firstEpisode->type ?? 'audio') : 'audio';
                            $heroAudioSrc = $firstEpisode && $firstEpisode->audio ? asset('storage/' . $firstEpisode->audio) : '';
                            $heroVideoSrc = $firstEpisode && $firstEpisode->vedio ? asset('storage/' . $firstEpisode->vedio) : '';
                            $heroImgSrc = $firstEpisode && ($firstEpisode->img_episode ?? $firstEpisode->img_view) ? asset('storage/' . ($firstEpisode->img_episode ?? $firstEpisode->img_view)) : $podcastImgUrl;
                        @endphp
                        <div class="hero-image-wrap" data-type="{{ $heroType }}" data-video-src="{{ $heroVideoSrc }}"
                            data-audio-src="{{ $heroAudioSrc }}" data-image-src="{{ $heroImgSrc }}">
                            <img src="{{ $heroImgSrc }}" alt="{{ $podcast->$title }}" class="hero-img" />
                            <video class="hero-video-player" controls preload="none" playsinline></video>
                            <div class="hero-img-fade"></div>
                        </div>

                        <!-- ══ Left: Info Panel ══ -->
                        <div class="hero-info">

                            <!-- Title -->
                            <h2 class="hero-title">{{ $podcast->$title }}</h2>

                            <!-- Description -->
                            <p class="hero-desc">
                                {{ Str::limit($podcast->$text ?? '', 250) }}
                            </p>

                            <!-- Stats -->
                            <div class="hero-stats">
                                <span class="stats-label">{{ app()->getLocale() == 'ar' ? 'مجموع الحلقات:' : 'Total Episodes:' }}</span>
                                <span class="stats-number">{{ $episodes->count() }}</span>
                            </div>

                            <!-- Bottom bar: platforms + subscribe -->
                            <div class="hero-bottom">

                                <!-- Subscribe button -->
                                <a href="#" class="subscribe-btn">{{ app()->getLocale() == 'ar' ? 'الإشتراك' : 'Subscribe' }}</a>

                                <!-- Platform icons -->
                                <div class="platforms">

                                    <!-- Share -->
                                    <a href="#" class="platform-icon" title="مشاركة" aria-label="مشاركة">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" width="17" height="17">
                                            <circle cx="18" cy="5" r="3" />
                                            <circle cx="6" cy="12" r="3" />
                                            <circle cx="18" cy="19" r="3" />
                                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" />
                                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" />
                                        </svg>
                                    </a>

                                    <!-- Spotify -->
                                    <a href="#" class="platform-icon" title="Spotify" aria-label="Spotify">
                                        <svg viewBox="0 0 24 24" fill="white" width="17" height="17">
                                            <path
                                                d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z" />
                                        </svg>
                                    </a>

                                    <!-- Apple Podcasts -->
                                    <a href="#" class="platform-icon" title="Apple Podcasts"
                                        aria-label="Apple Podcasts">
                                        <svg viewBox="0 0 24 24" fill="white" width="17" height="17">
                                            <path
                                                d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 4.5a7.5 7.5 0 110 15 7.5 7.5 0 010-15zm0 2.25a5.25 5.25 0 100 10.5A5.25 5.25 0 0012 6.75zM12 9a3 3 0 110 6 3 3 0 010-6zm0 1.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3zm-5.25 8.25a.75.75 0 011.5 0v1.5a.75.75 0 01-1.5 0v-1.5zm10.5 0a.75.75 0 011.5 0v1.5a.75.75 0 01-1.5 0v-1.5z" />
                                        </svg>
                                    </a>

                                    <!-- RSS -->
                                    <a href="#" class="platform-icon" title="RSS" aria-label="RSS">
                                        <svg viewBox="0 0 24 24" fill="white" width="17" height="17">
                                            <path
                                                d="M6.18 15.64a2.18 2.18 0 012.18 2.18C8.36 19.01 7.38 20 6.18 20C4.98 20 4 19.01 4 17.82a2.18 2.18 0 012.18-2.18M4 4.44A15.56 15.56 0 0119.56 20h-2.83A12.73 12.73 0 004 7.27V4.44m0 5.66a9.9 9.9 0 019.9 9.9h-2.83A7.07 7.07 0 004 12.93V10.1z" />
                                        </svg>
                                    </a>

                                </div>

                            </div>

                        </div>

                    </section>
                    <section class="podcast-section">

                        <!-- ══════════════════════════════════
                             A) Current Episode Player Card
                        ══════════════════════════════════ -->
                        @php
                            $epType = $firstEpisode->type ?? 'audio';
                            $epAudioSrc = $firstEpisode && $firstEpisode->audio ? asset('storage/' . $firstEpisode->audio) : '';
                            $epVideoSrc = $firstEpisode && $firstEpisode->vedio ? asset('storage/' . $firstEpisode->vedio) : '';
                            $epImgSrc = $firstEpisode && ($firstEpisode->img_episode ?? $firstEpisode->img_view) ? asset('storage/' . ($firstEpisode->img_episode ?? $firstEpisode->img_view)) : $podcastImgUrl;
                            $epTitle = $firstEpisode ? $firstEpisode->$title : (app()->getLocale() == 'ar' ? 'لا توجد حلقات' : 'No episodes');
                            $epDesc = $firstEpisode ? ($firstEpisode->$text ?? '') : '';
                            $epTypeLabel = ($epType === 'video') ? (app()->getLocale() == 'ar' ? 'فيديو' : 'Video') : (app()->getLocale() == 'ar' ? 'صوت' : 'Audio');
                            $epBadgeClass = $epType === 'video' ? 'media-type-badge--video' : 'media-type-badge--audio';
                        @endphp
                        <div class="episode-card" data-type="{{ $epType }}" data-audio-src="{{ $epAudioSrc }}"
                            data-video-src="{{ $epVideoSrc }}" data-title="{{ $epTitle }}"
                            data-description="{{ $epDesc }}"
                            data-image-src="{{ $epImgSrc }}">

                            <!-- Title -->
                            <h2 class="episode-title">{{ $epTitle }}
                                <span class="media-type-badge {{ $epBadgeClass }}">{{ $epTypeLabel }}</span>
                            </h2>

                            <!-- Description -->
                            <p class="episode-desc">
                                {{ Str::limit($epDesc, 300) }}
                            </p>

                            <div style="display: flex; align-items: center; gap: 10px;">
                                <button class="play-btn play-btn--large" aria-label="تشغيل">
                                    <svg viewBox="0 0 24 24" fill="white" width="35" height="35">
                                        <polygon points="6,4 20,12 6,20" />
                                    </svg>
                                </button>

                                <div style="flex: 1;">
                                    <!-- Waveform -->
                                    <div class="waveform"></div>

                                    <!-- Controls Row -->
                                    <div class="controls-row">

                                        <!-- Right side: time + play -->
                                        <div class="controls-right">
                                            <span class="time-display">
                                                <span class="time-current">00:00</span>
                                                <span class="time-sep"> / </span>
                                                <span class="time-total">00:00</span>
                                            </span>

                                        </div>

                                        <!-- Left side: share icons -->
                                        <div class="share-icons">
                                            <!-- Share generic -->
                                            <a href="#" class="share-icon share-icon--gray" title="مشاركة"
                                                aria-label="مشاركة">
                                                <svg viewBox="0 0 24 24" fill="white" width="15" height="15">
                                                    <circle cx="18" cy="5" r="3" fill="none" stroke="white"
                                                        stroke-width="2" />
                                                    <circle cx="6" cy="12" r="3" fill="none" stroke="white"
                                                        stroke-width="2" />
                                                    <circle cx="18" cy="19" r="3" fill="none" stroke="white"
                                                        stroke-width="2" />
                                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49" stroke="white"
                                                        stroke-width="2" />
                                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49" stroke="white"
                                                        stroke-width="2" />
                                                </svg>
                                            </a>
                                            <!-- WhatsApp -->
                                            <a href="#" class="share-icon share-icon--whatsapp" title="واتساب"
                                                aria-label="واتساب">
                                                <svg viewBox="0 0 24 24" fill="white" width="15" height="15">
                                                    <path
                                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                                                    <path
                                                        d="M11.999 2C6.477 2 2 6.477 2 12c0 1.82.487 3.53 1.338 5.007L2.04 22l5.113-1.268A9.953 9.953 0 0012 22c5.523 0 10-4.477 10-10S17.522 2 12 2zm0 18.182a8.154 8.154 0 01-4.162-1.136l-.298-.177-3.035.752.785-2.966-.194-.305A8.182 8.182 0 1112 20.182z" />
                                                </svg>
                                            </a>
                                            <!-- X (Twitter) -->
                                            <a href="#" class="share-icon share-icon--x" title="X" aria-label="X">
                                                <svg viewBox="0 0 24 24" fill="white" width="14" height="14">
                                                    <path
                                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.74-8.857L2.134 2.25H8.08l4.259 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z" />
                                                </svg>
                                            </a>
                                            <!-- Facebook -->
                                            <a href="#" class="share-icon share-icon--facebook" title="فيسبوك"
                                                aria-label="فيسبوك">
                                                <svg viewBox="0 0 24 24" fill="white" width="14" height="14">
                                                    <path
                                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                                </svg>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ══════════════════════════════════
                             C) Latest Episodes List
                        ══════════════════════════════════ -->
                        <div class="episodes-list-section">
                            <h3 class="list-title"><span class="title-bar"></span>{{ app()->getLocale() == 'ar' ? 'أحدث حلقات البرنامج' : 'Latest Episodes' }}</h3>

                            <div class="episodes-list">
                                @foreach($episodes as $index => $episode)
                                    @php
                                        $episodeType = $episode->type ?? 'audio';
                                        $episodeAudioSrc = $episode->audio ? asset('storage/' . $episode->audio) : '';
                                        $episodeVideoSrc = $episode->vedio ? asset('storage/' . $episode->vedio) : '';
                                        $episodeImgSrc = ($episode->img_episode ?? $episode->img_view) ? asset('storage/' . ($episode->img_episode ?? $episode->img_view)) : $podcastImgUrl;
                                        $episodeTitle = $episode->$title;
                                        $episodeDesc = $episode->$text ?? '';
                                        $episodeTypeLabel = ($episodeType === 'video') ? (app()->getLocale() == 'ar' ? 'فيديو' : 'Video') : (app()->getLocale() == 'ar' ? 'صوت' : 'Audio');
                                        $episodeDate = $episode->date ? \Carbon\Carbon::parse($episode->date)->translatedFormat(app()->getLocale() == 'ar' ? 'd F Y' : 'M d, Y') : '';
                                        $isHidden = $index >= 4;
                                    @endphp
                                    <a href="#" class="ep-row {{ $isHidden ? 'ep-row--hidden' : '' }}" data-episode-id="{{ $episode->id }}" data-type="{{ $episodeType }}"
                                        data-audio-src="{{ $episodeAudioSrc }}" data-video-src="{{ $episodeVideoSrc }}"
                                        data-title="{{ $episodeTitle }}" data-description="{{ $episodeDesc }}"
                                        data-image-src="{{ $episodeImgSrc }}"
                                        style="{{ $isHidden ? 'display: none;' : '' }}">
                                        <span class="ep-title">{{ $episodeTitle }}</span>
                                        <span class="ep-type">{{ $episodeTypeLabel }}</span>
                                        <span class="ep-duration">{{ $episode->time ?? '--' }}</span>
                                        <span class="ep-date">{{ $episodeDate }}</span>
                                        <button class="play-btn play-btn--small" aria-label="{{ app()->getLocale() == 'ar' ? 'تشغيل' : 'Play' }}">
                                            <svg viewBox="0 0 24 24" fill="white" width="14" height="14">
                                                <polygon points="6,4 20,12 6,20" />
                                            </svg>
                                        </button>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- ══════════════════════════════════
                             D) CTA Button
                        ══════════════════════════════════ -->
                        @if($episodes->count() > 4)
                        <div class="cta-wrap">
                            <a href="#" class="cta-btn">{{ app()->getLocale() == 'ar' ? 'شاهد المزيد' : 'Show More' }}</a>
                        </div>
                        @endif

                    </section>

                    <section class="episodes-section">

                        <div class="section-header">
                            <h2 class="section-header-title">{{ app()->getLocale() == 'ar' ? 'بودكاست' : 'Podcasts' }}</h2>
                        </div>

                        <div class="podcast-grid">
                            @foreach($relatedPodcasts as $related)
                                @php
                                    $relatedImg = $related->img_view ?? $related->img_podcast;
                                    $relatedImgUrl = $relatedImg ? asset('storage/' . $relatedImg) : asset('assets/in-img/podcasts/6.png');
                                    $relatedTitle = $related->$title;
                                    $relatedUrl = route('site.podcast.show', $related->slug);
                                @endphp
                                <a href="{{ $relatedUrl }}" class="podcast-one-card">
                                    <div class="podcast-one-card__media">
                                        <img src="{{ $relatedImgUrl }}"
                                            alt="{{ $relatedTitle }}"
                                            class="podcast-one-card__image">
                                    </div>
                                    <div class="podcast-one-card__body">
                                        <div class="podcast-one-card__category">{{ app()->getLocale() == 'ar' ? 'بودكاست' : 'Podcast' }}</div>
                                        <h3 class="podcast-one-card__title">{{ $relatedTitle }}</h3>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                    </section>

                </div>

            </div>

           
        </div>
   
  


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            // ═══════════════════════════════════════════════
            // المهمة الأولى: زر "شاهد المزيد"
            // ═══════════════════════════════════════════════
            let visibleCount = 4;
            const itemsPerLoad = 2;
            const $episodeRows = $('.ep-row');
            const totalRows = $episodeRows.length;
            const $ctaBtn = $('.cta-btn');

            $ctaBtn.on('click', function (e) {
                e.preventDefault();
                visibleCount += itemsPerLoad;
                $episodeRows.slice(0, visibleCount).fadeIn(400);
                if (visibleCount >= totalRows) {
                    $(this).fadeOut(300);
                }
            });

            // ═══════════════════════════════════════════════
            // المهمة الثانية: تشغيل ديناميكي صوت/فيديو (inline في الهيرو)
            // ═══════════════════════════════════════════════
            const $episodeCard = $('.episode-card');
            const $mainPlayBtn = $episodeCard.find('.play-btn--large');
            const $heroWrap = $('.hero-image-wrap');
            const $heroImg = $heroWrap.find('.hero-img');
            const heroVideoPlayer = $heroWrap.find('.hero-video-player')[0];
            const $mediaBadge = $episodeCard.find('.media-type-badge');
            const $waveform = $('.waveform');

            let mainAudio = null;
            let isMainPlaying = false;
            const listAudios = {};

            const currentEpisode = {
                type: normalizeType($episodeCard.attr('data-type')),
                audioSrc: $episodeCard.attr('data-audio-src') || '',
                videoSrc: $episodeCard.attr('data-video-src') || '',
                imageSrc: $episodeCard.attr('data-image-src') || $heroWrap.attr('data-image-src') || '',
                title: $episodeCard.attr('data-title') || $episodeCard.find('.episode-title').text().trim(),
                description: $episodeCard.attr('data-description') || $episodeCard.find('.episode-desc').text().trim()
            };

            setMainEpisodeMedia(currentEpisode);

            $mainPlayBtn.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                handlePlayAction();
            });

            // ═══════════════════════════════════════════════
            // المهمة الثالثة: أزرار القائمة
            // ═══════════════════════════════════════════════
            $episodeRows.each(function (index) {
                const $row = $(this);
                const rowType = normalizeType($row.attr('data-type'));
                const rowAudioSrc = $row.attr('data-audio-src') || '';
                const $playBtn = $row.find('.play-btn--small');

                if (rowType === 'audio' && rowAudioSrc) {
                    const audio = new Audio(rowAudioSrc);
                    listAudios[index] = {
                        audio: audio,
                        isPlaying: false,
                        $btn: $playBtn
                    };

                    audio.addEventListener('ended', function () {
                        listAudios[index].isPlaying = false;
                        updateListPlayButton($playBtn, false);
                    });
                }

                $row.on('click', function (e) {
                    if ($(e.target).closest('.play-btn--small').length) return;
                    e.preventDefault();
                    setEpisodeFromElement($row);
                });

                $playBtn.on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    setEpisodeFromElement($row);

                    if (currentEpisode.type === 'video') {
                        stopAllListAudios();
                        playHeroVideo();
                        return;
                    }

                    if (mainAudio && isMainPlaying) {
                        mainAudio.pause();
                        isMainPlaying = false;
                        updateMainPlayButton(false);
                    }

                    stopAllListAudios(index);
                    const item = listAudios[index];
                    if (!item) return;

                    if (item.isPlaying) {
                        item.audio.pause();
                        item.isPlaying = false;
                    } else {
                        item.audio.play();
                        item.isPlaying = true;
                    }

                    updateListPlayButton(item.$btn, item.isPlaying);
                });
            });

            // ═══════════════════════════════════════════════
            // Deep link: فتح حلقة محددة وتشغيلها
            // url: ?episode=ID&autoplay=1
            // ═══════════════════════════════════════════════
            try {
                const params = new URLSearchParams(window.location.search);
                const epId = params.get('episode');
                const autoplay = params.get('autoplay');
                if (epId) {
                    const $target = $episodeRows.filter('[data-episode-id="' + epId + '"]').first();
                    if ($target.length) {
                        $target.trigger('click');
                        if (autoplay === '1' || autoplay === 'true') {
                            setTimeout(function () {
                                $mainPlayBtn.trigger('click');
                            }, 150);
                        }
                    }
                }
            } catch (e) {}

            function handlePlayAction() {
                if (currentEpisode.type === 'video') {
                    stopAllListAudios();
                    playHeroVideo();
                    return;
                }

                stopAllListAudios();
                if (!mainAudio && currentEpisode.audioSrc) {
                    mainAudio = new Audio(currentEpisode.audioSrc);
                    mainAudio.addEventListener('loadedmetadata', function () {
                        if (!mainAudio) return;
                        $episodeCard.find('.time-total').text(formatTime(mainAudio.duration));
                    });
                    mainAudio.addEventListener('timeupdate', function () {
                        if (!mainAudio) return;
                        $episodeCard.find('.time-current').text(formatTime(mainAudio.currentTime));
                        const progress = mainAudio.duration ? (mainAudio.currentTime / mainAudio.duration) * 100 : 0;
                        updateWaveform(progress);
                    });
                    mainAudio.addEventListener('ended', function () {
                        if (!mainAudio) return;
                        isMainPlaying = false;
                        updateMainPlayButton(false);
                    });
                }

                if (!mainAudio) return;

                if (isMainPlaying) {
                    mainAudio.pause();
                    isMainPlaying = false;
                } else {
                    mainAudio.play();
                    isMainPlaying = true;
                }

                updateMainPlayButton(isMainPlaying);
            }

            function playHeroVideo() {
                if (!currentEpisode.videoSrc || !heroVideoPlayer) return;
                if (mainAudio && isMainPlaying) {
                    mainAudio.pause();
                    isMainPlaying = false;
                    updateMainPlayButton(false);
                }
                $heroWrap.addClass('is-video');
                $heroImg.hide();
                /* تأخير التحميل حتى يصبح الفيديو ظاهراً (بعض المتصفحات لا تحمّل جيداً والعنصر مخفي) */
                var videoUrl = currentEpisode.videoSrc;
                /* إذا كان للفيديو مصدر سابق (مثلاً بعد العودة من الصوت) نضيف كسر كاش لفرض إعادة التحميل */
                if (heroVideoPlayer.src && heroVideoPlayer.src.length > 0) {
                    var sep = videoUrl.indexOf('?') >= 0 ? '&' : '?';
                    videoUrl = videoUrl + sep + '_=' + (Date.now ? Date.now() : new Date().getTime());
                }
                heroVideoPlayer.src = videoUrl;
                function doLoadAndPlay() {
                    heroVideoPlayer.load();
                    heroVideoPlayer.play().catch(function () { });
                }
                if (window.requestAnimationFrame) {
                    requestAnimationFrame(function () {
                        requestAnimationFrame(doLoadAndPlay);
                    });
                } else {
                    setTimeout(doLoadAndPlay, 50);
                }
            }

            function setEpisodeFromElement($sourceEl) {
                const media = getMediaFromElement($sourceEl);
                const title = $sourceEl.attr('data-title') || $sourceEl.find('.ep-title').first().text().trim();
                const description = $sourceEl.attr('data-description') || '';
                const imageSrc = $sourceEl.attr('data-image-src') || '';

                currentEpisode.type = media.type;
                currentEpisode.audioSrc = media.audioSrc;
                currentEpisode.videoSrc = media.videoSrc;
                currentEpisode.title = title;
                currentEpisode.description = description;
                currentEpisode.imageSrc = imageSrc;

                $episodeCard.attr('data-type', media.type);
                $episodeCard.attr('data-audio-src', media.audioSrc);
                $episodeCard.attr('data-video-src', media.videoSrc);
                $episodeCard.attr('data-title', title);
                $episodeCard.attr('data-description', description);
                $episodeCard.attr('data-image-src', imageSrc);

                const badgeText = media.type === 'video' ? 'فيديو' : 'صوت';
                const badgeClass = media.type === 'video' ? 'media-type-badge--video' : 'media-type-badge--audio';
                $episodeCard.find('.episode-title').html(`${title} <span class="media-type-badge ${badgeClass}">${badgeText}</span>`);
                $episodeCard.find('.episode-desc').text(description);

                setMainEpisodeMedia(currentEpisode);
            }

            function setMainEpisodeMedia(ep) {
                const type = normalizeType(ep.type);
                currentEpisode.type = type;
                currentEpisode.audioSrc = ep.audioSrc || '';
                currentEpisode.videoSrc = ep.videoSrc || '';
                currentEpisode.imageSrc = ep.imageSrc || '';
                currentEpisode.title = ep.title || '';
                currentEpisode.description = ep.description || '';

                $episodeCard.attr('data-type', type);
                $episodeCard.attr('data-audio-src', currentEpisode.audioSrc);
                $episodeCard.attr('data-video-src', currentEpisode.videoSrc);
                $episodeCard.attr('data-image-src', currentEpisode.imageSrc);
                $heroWrap.attr('data-type', type);
                $heroWrap.attr('data-audio-src', currentEpisode.audioSrc);
                $heroWrap.attr('data-video-src', currentEpisode.videoSrc);
                $heroWrap.attr('data-image-src', currentEpisode.imageSrc);

                updateMediaBadge(type);

                /* دائماً نعرض الصورة أولاً، الفيديو يظهر فقط عند الضغط على تشغيل */
                $heroWrap.removeClass('is-video');
                $heroImg.show();
                if (currentEpisode.imageSrc) {
                    $heroImg.attr('src', currentEpisode.imageSrc);
                }
                if (heroVideoPlayer) {
                    heroVideoPlayer.pause();
                    /* لا نمسح src — تغييره لسلسلة فارغة يسبب Invalid URI حتى بدون load() */
                }

                if (mainAudio) {
                    mainAudio.pause();
                    mainAudio.currentTime = 0;
                    mainAudio = null;
                }
                isMainPlaying = false;
                updateMainPlayButton(false);
                updateWaveform(0);
                resetMainTimes();

                if (type === 'audio' && currentEpisode.audioSrc) {
                    mainAudio = new Audio(currentEpisode.audioSrc);
                    mainAudio.addEventListener('loadedmetadata', function () {
                        if (!mainAudio) return;
                        $episodeCard.find('.time-total').text(formatTime(mainAudio.duration));
                    });
                    mainAudio.addEventListener('timeupdate', function () {
                        if (!mainAudio) return;
                        $episodeCard.find('.time-current').text(formatTime(mainAudio.currentTime));
                        const progress = mainAudio.duration ? (mainAudio.currentTime / mainAudio.duration) * 100 : 0;
                        updateWaveform(progress);
                    });
                    mainAudio.addEventListener('ended', function () {
                        if (!mainAudio) return;
                        isMainPlaying = false;
                        updateMainPlayButton(false);
                    });
                }
            }

            function stopAllListAudios(exceptIndex = -1) {
                Object.keys(listAudios).forEach(function (key) {
                    if (parseInt(key, 10) !== exceptIndex) {
                        const item = listAudios[key];
                        if (item.isPlaying) {
                            item.audio.pause();
                            item.audio.currentTime = 0;
                            item.isPlaying = false;
                            updateListPlayButton(item.$btn, false);
                        }
                    }
                });
            }

            function updateMainPlayButton(isPlaying) {
                const $svg = $mainPlayBtn.find('svg');
                if (isPlaying) {
                    $svg.html('<rect x="6" y="4" width="4" height="16" fill="white"/><rect x="14" y="4" width="4" height="16" fill="white"/>');
                    $mainPlayBtn.attr('aria-label', 'إيقاف');
                } else {
                    $svg.html('<polygon points="6,4 20,12 6,20" />');
                    $mainPlayBtn.attr('aria-label', 'تشغيل');
                }
            }

            function updateListPlayButton($btn, isPlaying) {
                const $svg = $btn.find('svg');
                if (isPlaying) {
                    $svg.html('<rect x="6" y="4" width="4" height="16" fill="white"/><rect x="14" y="4" width="4" height="16" fill="white"/>');
                    $btn.attr('aria-label', 'إيقاف');
                } else {
                    $svg.html('<polygon points="6,4 20,12 6,20" />');
                    $btn.attr('aria-label', 'تشغيل');
                }
            }

            function updateWaveform(progress) {
                const safeProgress = Math.max(0, Math.min(100, progress || 0));
                $waveform.css('background', `linear-gradient(to left, #e0e0e0 ${100 - safeProgress}%, #1e90ff ${100 - safeProgress}%)`);
            }

            function updateMediaBadge(type) {
                const isVideo = type === 'video';
                const badgeText = isVideo ? 'فيديو' : 'صوت';
                const badgeClass = isVideo ? 'media-type-badge--video' : 'media-type-badge--audio';
                $episodeCard.find('.media-type-badge')
                    .text(badgeText)
                    .removeClass('media-type-badge--video media-type-badge--audio')
                    .addClass(badgeClass);
            }

            function resetMainTimes() {
                $episodeCard.find('.time-current').text('00:00');
                $episodeCard.find('.time-total').text('00:00');
            }

            function normalizeType(type) {
                return type === 'video' ? 'video' : 'audio';
            }

            function getMediaFromElement($el) {
                return {
                    type: normalizeType($el.attr('data-type')),
                    audioSrc: $el.attr('data-audio-src') || '',
                    videoSrc: $el.attr('data-video-src') || ''
                };
            }

            function formatTime(seconds) {
                if (isNaN(seconds)) return '00:00';
                const mins = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            }
        });
    </script>



</x-site-layout>