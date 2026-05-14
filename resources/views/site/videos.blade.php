<x-site-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/videos-page.css') }}">
    @endpush

    @php
        $titleField = 'title_' . app()->getLocale();
        $name = 'name_' . app()->getLocale();
    @endphp

    <div class="main-content--section ">
        <div class="container">

            <!-- Featured Videos Section -->
            <section class="featured-videos">
                <div class="featured-videos__grid">
                    @php
                        $featuredItems = ($featured ?? collect())->values();
                    @endphp

                    @if ($featuredItems->count())
                        @php($v0 = $featuredItems->get(0))

                        @if ($v0)
                            <a href="{{ route('site.video.show', $v0->slug) }}" class="video-card video-card--large">
                                <div class="video-card__media">


                                    <img src="{{ $v0->img_view ? asset('storage/' . $v0->img_view) : asset('assets/in-img/1.png') }}"
                                        alt="{{ $v0->$titleField ?? '' }}" class="video-card__image">

                                    <span class="video-card__category">
                                        {{ $v0->category?->{'name_' . app()->getLocale()} ?? '' }}
                                    </span>
                                    <div class="video-card__play"></div>
                                </div>

                                <div class="video-card__content">
                                    <h3 class="video-card__title">{{ $v0->$titleField }}</h3>
                                </div>
                            </a>
                        @endif
                        <div class="featured-videos__stacked">
                            @foreach ($featuredItems->slice(1, 2) as $v)
                                <a href="{{ route('site.video.show', $v->slug) }}" class="video-card video-card--small">
                                    <div class="video-card__media">
                                        <img src="{{ $v->img_view ? asset('storage/' . $v->img_view) : asset('assets/in-img/3.png') }}"
                                            alt="{{ $v->$titleField }}" class="video-card__image">
                                        <span
                                            class="video-card__category">{{ $v->category?->{'name_' . app()->getLocale()} ?? '' }}</span>
                                        <div class="video-card__play"></div>
                                    </div>
                                    <div class="video-card__content">
                                        <h3 class="video-card__title">{{ $v->$titleField }}</h3>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="featured-videos__stacked">
                            @foreach ($featuredItems->slice(3, 2) as $v)
                                <a href="{{ route('site.video.show', $v->slug) }}"
                                    class="video-card video-card--small">
                                    <div class="video-card__media">
                                        <img src="{{ $v->img_view ? asset('storage/' . $v->img_view) : asset('assets/in-img/3.png') }}"
                                            alt="{{ $v->$titleField }}" class="video-card__image">
                                        <span
                                            class="video-card__category">{{ $v->category?->{'name_' . app()->getLocale()} ?? '' }}</span>
                                        <div class="video-card__play"></div>
                                    </div>
                                    <div class="video-card__content">
                                        <h3 class="video-card__title">{{ $v->$titleField }}</h3>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>

            <!-- Latest Videos -->
            <section class="latest-videos">
                <div class="latest-videos__header">
                    <h2 class="latest-videos__title">أحدث الفيديوهات</h2>
                </div>

                <div class="latest-videos__grid">
                    @foreach (($latestVideos ?? collect())->take(8) as $v)
                        <a href="{{ route('site.video.show', $v->slug) }}" class="news-card">
                            <div class="news-card__media">


                                <img src="{{ $v->img_view ? asset('storage/' . $v->img_view) : asset('assets/in-img/1.png') }}"
                                    alt="{{ $v->$titleField ?? '' }}" class="news-card__image">

                                <div class="news-card__play"></div>
                            </div>

                            <div class="news-card__body">
                                <div class="news-card__category">
                                    {{ $v->category?->{'name_' . app()->getLocale()} ?? '' }}
                                </div>

                                <h3 class="news-card__title">{{ $v->$titleField }}</h3>

                                <div class="news-card__meta">
                                    <span class="news-card__date">{{ $v->date }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

        </div>
        <!-- Latest Videos Section - أحدث الفيديوهات -->
        <section class="latest-videos most-viewed-videos">
            <div class="container">
                <div class="latest-videos__header">
                    <h2 class="latest-videos__title">الأكثر مشاهدة</h2>
                </div>

                <div class="latest-videos__grid">
                    @foreach (($mostViewedVideos ?? collect())->take(8) as $v)
                        <a href="{{ route('site.video.show', $v->slug) }}" class="news-card">
                            <div class="news-card__media">
                                <img src="{{ $v->img_view ? asset('storage/' . $v->img_view) : asset('assets/in-img/2.png') }}"
                                    alt="{{ $v->$titleField }}" class="news-card__image">
                                <div class="news-card__play"></div>
                            </div>
                            <div class="news-card__body">
                                <div class="news-card__category">
                                    {{ $v->category?->{'name_' . app()->getLocale()} ?? '' }}
                                </div>
                                <h3 class="news-card__title">{{ $v->$titleField }}</h3>
                                <div class="news-card__meta">
                                    <span class="news-card__meta-icon">
                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z"
                                                stroke="black" />
                                        </svg>
                                    </span>
                                    <span class="news-card__date">{{ $v->date }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        @foreach ($categorySliders ?? collect() as $category)
            @if ($category->videos->count())
                <section class="category-slider container">
                    <div class="latest-videos__header">
                        <h2 class="latest-videos__title">
                            {{ $category->$name }}
                        </h2>
                    </div>

                    <div class="category-slider__wrapper">
                        <button class="slider-btn slider-btn--prev">&#10094;</button>

                        <div class="category-slider__viewport">
                            <div class="category-slider__track">
                                @foreach ($category->videos as $v)
                                    <div class="slide">
                                        <a href="{{ route('site.video.show', $v->slug) }}" class="video-card">
                                            <div class="video-card__media">
                                                <img src="{{ $v->img_view ? asset('storage/' . $v->img_view) : asset('assets/in-img/1.png') }}"
                                                    alt="{{ $v->$titleField }}" class="video-card__image">
                                                <div class="video-card__play"></div>
                                            </div>

                                            <div class="video-card__content">
                                                <h3 class="video-card__title">{{ $v->$titleField }}</h3>
                                                <span class="slide__date">
                                                    <span class="news-card__meta-icon">
                                                        <svg width="17" height="17" viewBox="0 0 17 17"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.5 0.5C9.55057 0.5 10.5909 0.70734 11.5615 1.10938C12.5321 1.51141 13.4145 2.09998 14.1572 2.84277C14.9001 3.58562 15.4887 4.46796 15.8906 5.43848C16.2927 6.40909 16.5 7.44944 16.5 8.5C16.5 10.6217 15.6575 12.6569 14.1572 14.1572C12.6569 15.6575 10.6217 16.5 8.5 16.5C7.44944 16.5 6.40909 16.2927 5.43848 15.8906C4.46796 15.4887 3.58562 14.9001 2.84277 14.1572C1.34249 12.6569 0.5 10.6217 0.5 8.5C0.5 6.37827 1.34249 4.34306 2.84277 2.84277C3.5856 2.09996 4.46795 1.51141 5.43848 1.10938C6.40907 0.70734 7.44943 0.5 8.5 0.5ZM7.15039 9.62988L7.3877 9.77539L11.8076 12.4961L12.2334 12.7578L12.4961 12.332L13.1758 11.2266L13.4404 10.7969L13.0068 10.5361L9.4248 8.38574V3.75H7.15039V9.62988Z"
                                                                stroke="white" />
                                                        </svg>
                                                    </span>
                                                    <span>{{ $v->date }}</span>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button class="slider-btn slider-btn--next">&#10095;</button>
                    </div>

                    <div class="slider-dots"></div>
                </section>
            @endif
        @endforeach
    </div>
</x-site-layout>
