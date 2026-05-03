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
                                        {{ $v0->category?->{"name_" . app()->getLocale()} ?? '' }}
                                    </span>
                                    <div class="video-card__play"></div>
                                </div>

                                <div class="video-card__content">
                                    <h3 class="video-card__title">{{ $v0->$titleField }}</h3>
                                </div>
                            </a>
                        @endif
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
                                    {{ $v->category?->{"name_" . app()->getLocale()} ?? '' }}
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
    </div>
</x-site-layout>
