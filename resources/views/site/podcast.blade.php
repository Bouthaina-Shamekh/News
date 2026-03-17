<x-site-layout>

<div class="main-content--section">
<div class="page-wrapper podcasts-page">

<div class="container podcasts-container">

{{-- HERO --}}
<section class="podcast-hero">

<div class="hero-image-wrap"
     data-type="audio"
     data-image-src="{{ asset('storage/'.$podcast->img_podcast) }}">

<img src="{{ asset('storage/'.$podcast->img_podcast) }}"
     class="hero-img">

<video class="hero-video-player" controls preload="none"></video>

<div class="hero-img-fade"></div>

</div>

<div class="hero-info">

<h2 class="hero-title">
{{ app()->getLocale() == 'ar' ? $podcast->title_ar : $podcast->title_en }}
</h2>

<p class="hero-desc">
{!! app()->getLocale() == 'ar' ? $podcast->text_ar : $podcast->text_en !!}
</p>

<div class="hero-stats">
<span class="stats-label">مجموع الحلقات:</span>
<span class="stats-number">{{ $episodes->count() }}</span>
</div>

<div class="hero-bottom">

<a href="#" class="subscribe-btn">الإشتراك</a>

</div>

</div>

</section>

{{-- CURRENT EPISODE --}}
@if($episodes->count())

@php
$episode = $episodes->first();
@endphp

<section class="podcast-section">

<div class="episode-card"
data-type="{{ $episode->type }}"
data-audio-src="{{ asset('storage/'.$episode->audio) }}"
data-video-src="{{ asset('storage/'.$episode->video) }}"
data-title="{{ $episode->title_ar }}"
data-description="{{ $episode->description_ar }}"
data-image-src="{{ asset('storage/'.$podcast->img_podcast) }}">

<h2 class="episode-title">

{{ $episode->title_ar }}

<span class="media-type-badge media-type-badge--{{ $episode->type }}">
{{ $episode->type == 'video' ? 'فيديو' : 'صوت' }}
</span>

</h2>

<p class="episode-desc">
{{ $episode->description_ar }}
</p>

<button class="play-btn play-btn--large">

<svg viewBox="0 0 24 24" fill="white" width="35" height="35">
<polygon points="6,4 20,12 6,20" />
</svg>

</button>

</div>

{{-- LIST --}}
<div class="episodes-list-section">

<h3 class="list-title">
<span class="title-bar"></span>
أحدث حلقات البرنامج
</h3>

<div class="episodes-list">

@foreach($episodes as $episode)

<a href="#"
class="ep-row"

data-type="{{ $episode->type }}"

data-audio-src="{{ asset('storage/'.$episode->audio) }}"

data-video-src="{{ asset('storage/'.$episode->video) }}"

data-title="{{ $episode->title_ar }}"

data-description="{{ $episode->description_ar }}"

data-image-src="{{ asset('storage/'.$podcast->img_podcast) }}"

>

<span class="ep-title">
{{ $episode->title_ar }}
</span>

<span class="ep-type">

{{ $episode->type == 'video' ? 'فيديو' : 'صوت' }}

</span>

<span class="ep-duration">
{{ $episode->duration }}
</span>

<span class="ep-date">
{{ $episode->created_at->format('d M Y') }}
</span>

<button class="play-btn play-btn--small">

<svg viewBox="0 0 24 24" fill="white" width="14" height="14">
<polygon points="6,4 20,12 6,20"/>
</svg>

</button>

</a>

@endforeach

</div>

</div>

</section>

@endif


{{-- RELATED PODCASTS --}}
<section class="episodes-section">

<div class="section-header">
<h2 class="section-header-title">بودكاست</h2>
</div>

<div class="podcast-grid">

@foreach($relatedPodcasts as $pod)

<a href="{{ route('podcast.show',$pod->slug) }}" class="podcast-one-card">

<div class="podcast-one-card__media">

<img src="{{ asset('storage/'.$pod->img_view) }}"
class="podcast-one-card__image">

</div>

<div class="podcast-one-card__body">

<div class="podcast-one-card__category">

{{ $pod->category->title_ar ?? '' }}

</div>

<h3 class="podcast-one-card__title">

{{ $pod->title_ar }}

</h3>

</div>

</a>

@endforeach

</div>

</section>

</div>
</div>
</div>

@push('scripts')
<script>

document.addEventListener("DOMContentLoaded", function () {

    const episodeCards = document.querySelectorAll(".ep-row");
    const heroImage = document.querySelector(".hero-img");
    const heroVideo = document.querySelector(".hero-video-player");
    const episodeTitle = document.querySelector(".episode-title");
    const episodeDesc = document.querySelector(".episode-desc");

    episodeCards.forEach(card => {

        card.addEventListener("click", function(e){

            e.preventDefault();

            const type = this.dataset.type;
            const audio = this.dataset.audioSrc;
            const video = this.dataset.videoSrc;
            const title = this.dataset.title;
            const description = this.dataset.description;
            const image = this.dataset.imageSrc;

            episodeTitle.innerText = title;
            episodeDesc.innerText = description;

            if(type === "audio"){

                heroImage.src = image;
                heroVideo.style.display = "none";

                const audioPlayer = new Audio(audio);
                audioPlayer.play();

            }else{

                heroVideo.src = video;
                heroVideo.style.display = "block";
                heroVideo.play();

            }

        });

    });

});

</script>
@endpush

</x-site-layout>