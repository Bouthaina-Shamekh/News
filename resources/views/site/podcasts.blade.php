<x-site-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/podcasts.css') }}">
    @endpush

    <div class="main-content--section ">
        <div class="page-wrapper podcasts-page">

            <div class="container">
                <section class="podcast-section">

                    <div class="section-header">
                        <h2 class="section-header-title">{{ __('site.Podcasts') }}</h2>
                    </div>

                    @php
                        $title = 'title_' . app()->getLocale();
                    @endphp

                    <div class="podcast-grid">
                        @foreach($podcasts as $podcast)
                            @php
                                $img = $podcast->img_view ?? $podcast->img_podcast;
                                $imgUrl = $img ? asset('storage/' . $img) : asset('assets/in-img/podcasts/6.png');
                                $podcastUrl = route('site.podcast.show', $podcast->slug);
                            @endphp
                            <a href="{{ $podcastUrl }}" class="podcast-one-card">
                                <div class="podcast-one-card__media">
                                    <img src="{{ $imgUrl }}" alt="{{ $podcast->$title }}" class="podcast-one-card__image">
                                </div>
                                <div class="podcast-one-card__body">
                                    <div class="podcast-one-card__category">{{ app()->getLocale() == 'ar' ? 'بودكاست' : 'Podcast' }}</div>
                                    <h3 class="podcast-one-card__title">{{ $podcast->$title }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </section>


                <section class="episodes-section">
                    <div class="section-header">
                        <h2 class="section-header-title">{{ __('site.Latest Episodes') }}</h2>
                    </div>

                    <div class="episodes-grid">
                        @foreach($episodes as $episode)
                            @php
                                $p = $episode->podcast;
                                $pSlug = $p?->slug ?? $episode->podcast_id;
                                $episodeImg = ($episode->img_episode ?? $episode->img_view) ?: ($p?->img_view ?? $p?->img_podcast);
                                $episodeImgUrl = $episodeImg ? asset('storage/' . $episodeImg) : asset('assets/in-img/podcasts/6.png');
                                $episodeUrl = route('site.podcast.show', $pSlug) . '?episode=' . $episode->id . '&autoplay=1';
                            @endphp
                            <a href="{{ $episodeUrl }}" class="podcast-card">
                                <div class="card-inner">
                                    <div class="card-image-wrap">
                                        <img src="{{ $episodeImgUrl }}" alt="{{ $episode->$title }}" class="card-img" />
                                    </div>
                                    <div class="card-content">
                                        <h3 class="card-title">{{ $episode->$title }}</h3>

                                        <div class="card-meta">
                                            <button class="play-btn" aria-label="{{ app()->getLocale() == 'ar' ? 'تشغيل' : 'Play' }}">
                                                <svg viewBox="0 0 24 24" fill="white" width="18" height="18">
                                                    <polygon points="6,4 20,12 6,20" />
                                                </svg>
                                            </button>
                                            <div class="card-meta-duration">
                                                <div class="waveform"></div>
                                                <span class="duration">{{ $episode->time ?? '--' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
                <!-- Latest Videos Section - أحدث الفيديوهات -->
                <section class="latest-videos">
                    <div class="latest-videos__header">
                        <h2 class="latest-videos__title">{{ __('site.Latest Videos') }}</h2>
                    </div>

                    <div class="latest-videos__grid">
                        @foreach($videos as $video)
                            @php
                                $vImg = $video->img_view ?? $video->img_video;
                                $vImgUrl = $vImg ? asset('storage/' . $vImg) : asset('assets/in-img/1.png');
                                $vUrl = route('site.video.show', $video->slug);
                                $vTitle = $video->$title;
                                $vCategoryName = $video->category ? ($video->category->{'name_' . app()->getLocale()} ?? '') : '';
                                $vDate = $video->date ? \Carbon\Carbon::parse($video->date)->translatedFormat(app()->getLocale() == 'ar' ? 'd F / Y' : 'M d, Y') : '';
                            @endphp
                            <a href="{{ $vUrl }}" class="news-card">
                                <div class="news-card__media">
                                    <img src="{{ $vImgUrl }}" alt="{{ $vTitle }}" class="news-card__image">
                                </div>
                                <div class="news-card__body">
                                    <div class="news-card__category">{{ $vCategoryName }}</div>
                                    <h3 class="news-card__title">{{ $vTitle }}</h3>
                                    <div class="news-card__meta">
                                        <span class="news-card__meta-icon">
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z" stroke="black" />
                                            </svg>
                                        </span>
                                        <span class="news-card__date">{{ $vDate }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                        {{--
                        <!-- News Card 1 -->
                        <a href="#" class="news-card">
                            <div class="news-card__media">
                                <img src="../assets/in-img/1.png" alt="نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري"
                                    class="news-card__image">

                            </div>
                            <div class="news-card__body">
                                <div class="news-card__category">أخبار إسرائيل</div>
                                <h3 class="news-card__title">نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري</h3>
                                <div class="news-card__meta">
                                    <span class="news-card__meta-icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z"
                                                stroke="black" />
                                        </svg>
                                    </span>
                                    <span class="news-card__date">6 فبراير / 2026</span>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="news-card">
                            <div class="news-card__media">
                                <img src="../assets/in-img/2.png" alt="نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري"
                                    class="news-card__image">

                            </div>
                            <div class="news-card__body">
                                <div class="news-card__category">أخبار إسرائيل</div>
                                <h3 class="news-card__title">نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري</h3>
                                <div class="news-card__meta">
                                    <span class="news-card__meta-icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z"
                                                stroke="black" />
                                        </svg>
                                    </span>
                                    <span class="news-card__date">6 فبراير / 2026</span>
                                </div>
                            </div>
                        </a>
                        <!-- News Card 1 -->
                        <a href="#" class="news-card">
                            <div class="news-card__media">
                                <img src="../assets/in-img/1.png" alt="نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري"
                                    class="news-card__image">

                            </div>
                            <div class="news-card__body">
                                <div class="news-card__category">أخبار إسرائيل</div>
                                <h3 class="news-card__title">نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري</h3>
                                <div class="news-card__meta">
                                    <span class="news-card__meta-icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z"
                                                stroke="black" />
                                        </svg>
                                    </span>
                                    <span class="news-card__date">6 فبراير / 2026</span>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="news-card">
                            <div class="news-card__media">
                                <img src="../assets/in-img/2.png" alt="نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري"
                                    class="news-card__image">

                            </div>
                            <div class="news-card__body">
                                <div class="news-card__category">أخبار إسرائيل</div>
                                <h3 class="news-card__title">نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري</h3>
                                <div class="news-card__meta">
                                    <span class="news-card__meta-icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z"
                                                stroke="black" />
                                        </svg>
                                    </span>
                                    <span class="news-card__date">6 فبراير / 2026</span>
                                </div>
                            </div>
                        </a>
                        <!-- News Card 1 -->
                        <a href="#" class="news-card">
                            <div class="news-card__media">
                                <img src="../assets/in-img/1.png" alt="نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري"
                                    class="news-card__image">

                            </div>
                            <div class="news-card__body">
                                <div class="news-card__category">أخبار إسرائيل</div>
                                <h3 class="news-card__title">نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري</h3>
                                <div class="news-card__meta">
                                    <span class="news-card__meta-icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z"
                                                stroke="black" />
                                        </svg>
                                    </span>
                                    <span class="news-card__date">6 فبراير / 2026</span>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="news-card">
                            <div class="news-card__media">
                                <img src="../assets/in-img/2.png" alt="نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري"
                                    class="news-card__image">

                            </div>
                            <div class="news-card__body">
                                <div class="news-card__category">أخبار إسرائيل</div>
                                <h3 class="news-card__title">نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري</h3>
                                <div class="news-card__meta">
                                    <span class="news-card__meta-icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z"
                                                stroke="black" />
                                        </svg>
                                    </span>
                                    <span class="news-card__date">6 فبراير / 2026</span>
                                </div>
                            </div>
                        </a>
                        <!-- News Card 1 -->
                        <a href="#" class="news-card">
                            <div class="news-card__media">
                                <img src="../assets/in-img/1.png" alt="نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري"
                                    class="news-card__image">

                            </div>
                            <div class="news-card__body">
                                <div class="news-card__category">أخبار إسرائيل</div>
                                <h3 class="news-card__title">نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري</h3>
                                <div class="news-card__meta">
                                    <span class="news-card__meta-icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z"
                                                stroke="black" />
                                        </svg>
                                    </span>
                                    <span class="news-card__date">6 فبراير / 2026</span>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="news-card">
                            <div class="news-card__media">
                                <img src="../assets/in-img/2.png" alt="نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري"
                                    class="news-card__image">

                            </div>
                            <div class="news-card__body">
                                <div class="news-card__category">أخبار إسرائيل</div>
                                <h3 class="news-card__title">نتنياهو يحرب عن علقه من تعاظم قوة الجيش المصري</h3>
                                <div class="news-card__meta">
                                    <span class="news-card__meta-icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z"
                                                stroke="black" />
                                        </svg>
                                    </span>
                                    <span class="news-card__date">6 فبراير / 2026</span>
                                </div>
                            </div>
                        </a>

                        --}}
                    </div>
                </section>
            </div>

        </div>


    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</x-site-layout>