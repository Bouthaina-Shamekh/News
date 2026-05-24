@php
    $name = 'name_' . app()->getLocale();
@endphp

<div class="row">

    <div class="form-group col-6 mb-3">
        <x-form.input name="title_ar" label="{{ __('admin.Title_AR') }}" type="text" required :value="$podcasts->title_ar" />
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input name="title_en" label="{{ __('admin.Title_EN') }}" type="text" required :value="$podcasts->title_en" />
    </div>

    <div class="form-group col-12 mb-3">
        <label>{{ __('admin.Text_AR') }}</label>
        <textarea name="text_ar" class="form-control mytextarea">{{ $podcasts->text_ar }}</textarea>
    </div>

    <div class="form-group col-12 mb-3">
        <label>{{ __('admin.Text_EN') }}</label>
        <textarea name="text_en" class="form-control mytextarea">{{ $podcasts->text_en }}</textarea>
    </div>

    <div class="form-group col-6 mb-3">
        <label>{{ __('admin.Categories') }}</label>

        <select name="category_id" class="form-control" required>
            <option value="">{{ __('admin.Choose') }}</option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected($podcasts->category_id == $category->id)>
                    {{ $category->$name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-6 mb-3">
        <label>{{ __('admin.Image View') }}</label>

        <input type="file" name="img_view" class="form-control">
        <small class="text-muted d-block mt-1">{{ __('admin.Podcast image size hint') }}</small>

        @if ($podcasts->img_view)
            <img src="{{ asset('storage/' . $podcasts->img_view) }}" width="80">
        @endif
    </div>

</div>

<hr>

<h5 class="mb-3">
    {{ __('admin.Podcast Episodes') }}
</h5>

<div id="episodes-wrapper">

    @if (isset($episodes))

        @foreach ($episodes as $episode)
            @php
                $episodeSource = ($episode->type == 'video' ? $episode->video_url : $episode->audio_url) ? 'url' : 'upload';
            @endphp
            <div class="card mb-3 episode-item">

    <input type="hidden" name="episodes[id][]" value="{{ $episode->id }}">

    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>{{ $episode->title_ar ?? $episode->title_en }}</strong>

        <button type="button"
            class="btn btn-danger btn-sm btn-delete-episode"
            data-url="{{ route('dashboard.podcast.episode.destroy', $episode->id) }}">
            حذف الحلقة
        </button>
    </div>

                <div class="card-body">

                    <div class="row">

                        <div class="form-group col-6 mb-3">
                            <label class="form-label">{{ __('admin.Title_AR') }}</label>
                            <input type="text" name="episodes[title_ar][]" class="form-control"
                                value="{{ $episode->title_ar }}" placeholder="Title AR">
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label class="form-label">{{ __('admin.Title_EN') }}</label>
                            <input type="text" name="episodes[title_en][]" class="form-control"
                                value="{{ $episode->title_en }}" placeholder="Title EN">
                        </div>

                        <div class="form-group col-4 mb-3">
                            <label class="form-label">{{ __('admin.Date') }}</label>
                            <input type="date" name="episodes[date][]" class="form-control"
                                value="{{ $episode->date }}">
                        </div>

                        <div class="form-group col-4 mb-3">
                            <label class="form-label">{{ __('admin.Type') }}</label>
                            <select name="episodes[type][]" class="form-control episode-type-select">
                                <option value="audio" @selected($episode->type == 'audio')>{{ __('admin.Audio') }}</option>
                                <option value="video" @selected($episode->type == 'video')>{{ __('admin.Video') }}</option>
                            </select>
                        </div>

                        <div class="form-group col-4 mb-3">
                            <label class="form-label">مصدر الحلقة</label>
                            <select name="episodes[source][]" class="form-control episode-source-select">
                                <option value="upload" @selected($episodeSource == 'upload')>رفع ملف</option>
                                <option value="url" @selected($episodeSource == 'url')>رابط خارجي</option>
                            </select>
                        </div>

                        <div class="form-group col-12 mb-3 episode-audio-url-field"
                            style="{{ $episode->type == 'video' || $episodeSource != 'url' ? 'display:none' : '' }}">
                            <label class="form-label">رابط صوت خارجي</label>
                            <input type="url" name="episodes[audio_url][]" class="form-control"
                                value="{{ $episode->audio_url }}"
                                placeholder="https://example.com/audio.mp3">
                            <small class="text-muted d-block mt-1">
                                إذا وضعت رابط خارجي سيتم استخدامه بدل ملف الصوت المرفوع.
                            </small>
                        </div>

                        <div class="form-group col-12 mb-3 episode-video-url-field"
                            style="{{ $episode->type == 'audio' || $episodeSource != 'url' ? 'display:none' : '' }}">
                            <label class="form-label">رابط فيديو خارجي</label>
                            <input type="url" name="episodes[video_url][]" class="form-control"
                                value="{{ $episode->video_url }}"
                                placeholder="https://example.com/video.mp4 أو https://youtube.com/watch?v=...">
                            <small class="text-muted d-block mt-1">
                                يقبل ملف فيديو مباشر أو رابط منصة مثل YouTube/Vimeo/Facebook.
                            </small>
                        </div>

                        <div class="form-group col-12 mb-3 episode-audio-field"
                            style="{{ $episode->type == 'video' || $episodeSource != 'upload' ? 'display:none' : '' }}">
                            <label class="form-label">{{ __('admin.Audio') }}</label>
                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                @php
                                    $audioPreviewUrl = $episode->audio_url ?: ($episode->audio ? asset('storage/' . $episode->audio) : null);
                                @endphp

                                @if ($audioPreviewUrl)
                                    <button type="button" class="btn btn-sm btn-outline-primary btn-play-media"
                                        data-url="{{ $audioPreviewUrl }}" data-type="audio">
                                        {{ __('admin.Open_Audio') }}
                                    </button>
                                @endif

                                <input type="file" name="episodes[audio][]" class="form-control"
                                    style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="form-group col-12 mb-3 episode-video-field"
                            style="{{ $episode->type == 'audio' || $episodeSource != 'upload' ? 'display:none' : '' }}">
                            <label class="form-label">{{ __('admin.Video') }}</label>
                            <div class="d-flex gap-2 align-items-center flex-wrap">
                                @php
                                    $videoPreviewUrl = $episode->video_url ?: ($episode->vedio ? asset('storage/' . $episode->vedio) : null);
                                @endphp

                                @if ($videoPreviewUrl)
                                    <button type="button" class="btn btn-sm btn-outline-primary btn-play-media"
                                        data-url="{{ $videoPreviewUrl }}" data-type="video">
                                        {{ __('admin.Open_Video') }}
                                    </button>
                                @endif

                                <input type="file" name="episodes[vedio][]" class="form-control"
                                    style="max-width: 300px;">
                            </div>
                        </div>

                        <div class="form-group col-12 mb-3">
                            <label class="form-label">{{ __('admin.Episode_Image') }}</label>

                            <div class="d-flex gap-2 align-items-center flex-wrap">

                                @if ($episode && $episode->img_episode)
                                    <img src="{{ asset('storage/' . $episode->img_episode) }}"
                                        style="width:80px;height:80px;object-fit:cover;border-radius:8px;">
                                @endif

                                <input type="file" name="episodes[img_episode][]" class="form-control"
                                    style="max-width: 300px;">
                            </div>
                            <small class="text-muted d-block mt-1">@lang('admin.Episode image size hint')</small>
                        </div>

                    </div>

                </div>

            </div>
        @endforeach

    @endif

</div>

<button type="button" class="btn btn-success" id="addEpisode">
    + {{ __('admin.Add Episode') }}
</button>

@push('modals')
    <div class="modal fade" id="mediaPlayerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediaPlayerModalLabel"></h5>
                    <button type="button" class="btn-close" data-pc-modal-dismiss="#mediaPlayerModal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" id="mediaPlayerContent">
                    <audio id="mediaPlayerAudio" controls preload="none" style="width:100%;display:none;"></audio>
                    <video id="mediaPlayerVideo" controls preload="none"
                        style="width:100%;max-height:400px;display:none;"></video>
                    <iframe id="mediaPlayerIframe" style="width:100%;height:400px;border:0;display:none;"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        (function() {
            function toggleEpisodeMedia(item) {
                var type = $(item).find('.episode-type-select').val();
                var source = $(item).find('.episode-source-select').val() || 'upload';

                $(item).find('.episode-audio-field').toggle(type === 'audio' && source === 'upload');
                $(item).find('.episode-audio-url-field').toggle(type === 'audio' && source === 'url');

                $(item).find('.episode-video-field').toggle(type === 'video' && source === 'upload');
                $(item).find('.episode-video-url-field').toggle(type === 'video' && source === 'url');
            }

            function clearMediaPlayer() {
                var a = document.getElementById('mediaPlayerAudio');
                var v = document.getElementById('mediaPlayerVideo');
                var iframe = document.getElementById('mediaPlayerIframe');

                if (a) {
                    a.pause();
                    a.removeAttribute('src');
                }

                if (v) {
                    v.pause();
                    v.removeAttribute('src');
                }

                if (iframe) {
                    iframe.removeAttribute('src');
                }
            }

            $(document).on('change', '.episode-type-select', function() {
                toggleEpisodeMedia($(this).closest('.episode-item'));
            });

            $(document).on('change', '.episode-source-select', function() {
                toggleEpisodeMedia($(this).closest('.episode-item'));
            });

            $(document).on('click', '.btn-play-media', function() {
                var url = $(this).data('url');
                var type = $(this).data('type');
                var modal = document.getElementById('mediaPlayerModal');
                var audioEl = document.getElementById('mediaPlayerAudio');
                var videoEl = document.getElementById('mediaPlayerVideo');
                var iframeEl = document.getElementById('mediaPlayerIframe');

                if (!modal || !audioEl || !videoEl || !iframeEl) return;

                audioEl.pause();
                videoEl.pause();

                audioEl.removeAttribute('src');
                videoEl.removeAttribute('src');
                iframeEl.removeAttribute('src');

                audioEl.style.display = 'none';
                videoEl.style.display = 'none';
                iframeEl.style.display = 'none';

                if (type === 'audio') {
                    audioEl.src = url;
                    audioEl.style.display = 'block';
                    document.getElementById('mediaPlayerModalLabel').textContent = '{{ __('admin.Audio') }}';
                } else if (isDirectVideoUrl(url)) {
                    videoEl.src = url;
                    videoEl.style.display = 'block';
                    document.getElementById('mediaPlayerModalLabel').textContent = '{{ __('admin.Video') }}';
                } else {
                    iframeEl.src = getEmbedVideoUrl(url) || url;
                    iframeEl.style.display = 'block';
                    document.getElementById('mediaPlayerModalLabel').textContent = '{{ __('admin.Video') }}';
                }

                modal.classList.add('show');

                setTimeout(function() {
                    modal.classList.add('animate');
                }, 100);

                var overlay = document.getElementById('modaloverlay');

                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.className = 'fixed inset-0 bg-gray-900/20 z-[1028] backdrop-blur-sm';
                    overlay.id = 'modaloverlay';
                    document.body.appendChild(overlay);
                    document.body.classList.add('modal-open');

                    overlay.addEventListener('click', function() {
                        clearMediaPlayer();

                        if (typeof modalclose === 'function') {
                            modalclose();
                        }
                    });
                }
            });

            $(document).on('click', '[data-pc-modal-dismiss="#mediaPlayerModal"]', clearMediaPlayer);

            $('.episode-item').each(function() {
                toggleEpisodeMedia(this);
            });

            var newEpisodeHtml = `
  <div class="card mb-3 episode-item">

    <input type="hidden" name="episodes[id][]" value="">

    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>حلقة جديدة</strong>

        <button type="button" class="btn btn-danger btn-sm btn-remove-new-episode">
            حذف الحلقة
        </button>
    </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6 mb-3">
                    <label class="form-label">{{ __('admin.Title_AR') }}</label>
                    <input type="text" name="episodes[title_ar][]" class="form-control" placeholder="Title AR">
                </div>

                <div class="form-group col-6 mb-3">
                    <label class="form-label">{{ __('admin.Title_EN') }}</label>
                    <input type="text" name="episodes[title_en][]" class="form-control" placeholder="Title EN">
                </div>

                <div class="form-group col-4 mb-3">
                    <label class="form-label">{{ __('admin.Date') }}</label>
                    <input type="date" name="episodes[date][]" class="form-control">
                </div>

                <div class="form-group col-4 mb-3">
                    <label class="form-label">{{ __('admin.Type') }}</label>
                    <select name="episodes[type][]" class="form-control episode-type-select">
                        <option value="audio">{{ __('admin.Audio') }}</option>
                        <option value="video">{{ __('admin.Video') }}</option>
                    </select>
                </div>

                <div class="form-group col-4 mb-3">
                    <label class="form-label">مصدر الحلقة</label>
                    <select name="episodes[source][]" class="form-control episode-source-select">
                        <option value="upload">رفع ملف</option>
                        <option value="url">رابط خارجي</option>
                    </select>
                </div>

                <div class="form-group col-12 mb-3 episode-audio-url-field" style="display:none">
                    <label class="form-label">رابط صوت خارجي</label>
                    <input type="url" name="episodes[audio_url][]" class="form-control"
                        placeholder="https://example.com/audio.mp3">
                    <small class="text-muted d-block mt-1">
                        إذا وضعت رابط خارجي سيتم استخدامه بدل ملف الصوت المرفوع.
                    </small>
                </div>

                <div class="form-group col-12 mb-3 episode-video-url-field" style="display:none">
                    <label class="form-label">رابط فيديو خارجي</label>
                    <input type="url" name="episodes[video_url][]" class="form-control"
                        placeholder="https://example.com/video.mp4 أو https://youtube.com/watch?v=...">
                    <small class="text-muted d-block mt-1">
                        يقبل ملف فيديو مباشر أو رابط منصة مثل YouTube/Vimeo/Facebook.
                    </small>
                </div>

                <div class="form-group col-12 mb-3 episode-audio-field">
                    <label class="form-label">{{ __('admin.Audio') }}</label>
                    <input type="file" name="episodes[audio][]" class="form-control" style="max-width: 300px;">
                </div>

                <div class="form-group col-12 mb-3 episode-video-field" style="display:none">
                    <label class="form-label">{{ __('admin.Video') }}</label>
                    <input type="file" name="episodes[vedio][]" class="form-control" style="max-width: 300px;">
                </div>

                <div class="form-group col-12 mb-3">
                    <label class="form-label">{{ __('admin.Episode_Image') }}</label>
                    <div class="d-flex gap-2 align-items-center flex-wrap">
                        <input type="file" name="episodes[img_episode][]" class="form-control" style="max-width: 300px;">
                    </div>
                    <small class="text-muted d-block mt-1">@lang('admin.Episode image size hint')</small>
                </div>
            </div>
        </div>
    </div>`;

            $('#addEpisode').click(function() {
                $('#episodes-wrapper').append(newEpisodeHtml);
            });

            function isDirectVideoUrl(url) {
                try {
                    var parsedUrl = new URL(url, window.location.href);
                    return /\.(mp4|m4v|webm|ogg|ogv|mov|m3u8)(\?.*)?$/i.test(parsedUrl.pathname + parsedUrl.search);
                } catch (e) {
                    return /\.(mp4|m4v|webm|ogg|ogv|mov|m3u8)(\?.*)?$/i.test(url || '');
                }
            }

            function getEmbedVideoUrl(url) {
                if (!url) return '';

                try {
                    var parsedUrl = new URL(url);
                    var host = parsedUrl.hostname.replace('www.', '');
                    var path = parsedUrl.pathname;

                    if (host.indexOf('youtube.com') !== -1) {
                        if (path.indexOf('/embed/') !== -1) return url;
                        if (path.indexOf('/shorts/') !== -1) {
                            var shortId = path.split('/shorts/')[1].split('/')[0];
                            return shortId ? 'https://www.youtube.com/embed/' + shortId : '';
                        }

                        var id = parsedUrl.searchParams.get('v');
                        return id ? 'https://www.youtube.com/embed/' + id : '';
                    }

                    if (host.indexOf('youtu.be') !== -1) {
                        var youtuBeId = path.replace('/', '').split('?')[0];
                        return youtuBeId ? 'https://www.youtube.com/embed/' + youtuBeId : '';
                    }

                    if (host.indexOf('vimeo.com') !== -1) {
                        var vimeoId = path.replace('/', '').split('/')[0];
                        return vimeoId ? 'https://player.vimeo.com/video/' + vimeoId : '';
                    }

                    if (host.indexOf('facebook.com') !== -1 || host.indexOf('fb.watch') !== -1) {
                        return 'https://www.facebook.com/plugins/video.php?href=' + encodeURIComponent(url) + '&show_text=false';
                    }
                } catch (e) {}

                return '';
            }
      
      $(document).on('click', '.btn-remove-new-episode', function() {
    $(this).closest('.episode-item').remove();
});

$(document).on('click', '.btn-delete-episode', function() {
    if (!confirm('هل أنت متأكد من حذف هذه الحلقة؟')) {
        return;
    }

    var button = $(this);
    var url = button.data('url');

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE'
        },
        success: function() {
            button.closest('.episode-item').remove();
        },
        error: function() {
            alert('حدث خطأ أثناء حذف الحلقة');
        }
    });
});
        })();
    </script>
@endpush
