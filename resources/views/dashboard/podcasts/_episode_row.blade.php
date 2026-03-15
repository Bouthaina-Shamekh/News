<div class="card mb-3 episode-item">

    <div class="card-body">

        <div class="row">

            <div class="form-group col-6 mb-3">
                <x-form.input name="episodes[title_ar][]" label="{{ __('admin.Title_AR') }}" type="text"
                    :value="$episode->title_ar ?? ''" />
            </div>

            <div class="form-group col-6 mb-3">
                <x-form.input name="episodes[title_en][]" label="{{ __('admin.Title_EN') }}" type="text"
                    :value="$episode->title_en ?? ''" />
            </div>

            <div class="form-group col-4 mb-3">
                <x-form.input name="episodes[date][]" label="{{ __('admin.Date') }}" type="date" :value="$episode->date ?? ''" />
            </div>

            <div class="form-group col-4 mb-3">
                <x-form.input name="episodes[time][]" label="{{ __('admin.Duration') }}" type="text"
                    :value="$episode->time ?? ''" />
            </div>

            <div class="form-group col-4 mb-3">
                <label class="form-label">{{ __('admin.Type') }}</label>
                <select name="episodes[type][]" class="form-control episode-type-select">
                    <option value="audio" @selected(($episode->type ?? 'audio') == 'audio')>{{ __('admin.Audio') }}</option>
                    <option value="video" @selected(($episode->type ?? '') == 'video')>{{ __('admin.Video') }}</option>
                </select>
            </div>

            <div class="form-group col-12 mb-3 episode-audio-field" style="{{ ($episode->type ?? 'audio') == 'video' ? 'display:none' : '' }}">
                <label class="form-label">{{ __('admin.Audio') }}</label>
                <div class="d-flex gap-2 align-items-center flex-wrap">
                    @if($episode && $episode->audio)
                        <button type="button" class="btn btn-sm btn-outline-primary btn-play-media" data-url="{{ asset('storage/' . $episode->audio) }}" data-type="audio">
                            {{ __('admin.Open_Audio') }}
                        </button>
                    @endif
                    <input type="file" name="episodes[audio][]" class="form-control" style="max-width: 300px;">
                </div>
            </div>

            <div class="form-group col-12 mb-3 episode-video-field" style="{{ ($episode->type ?? 'audio') == 'audio' ? 'display:none' : '' }}">
                <label class="form-label">{{ __('admin.Video') }}</label>
                <div class="d-flex gap-2 align-items-center flex-wrap">
                    @if($episode && $episode->vedio)
                        <button type="button" class="btn btn-sm btn-outline-primary btn-play-media" data-url="{{ asset('storage/' . $episode->vedio) }}" data-type="video">
                            {{ __('admin.Open_Video') }}
                        </button>
                    @endif
                    <input type="file" name="episodes[vedio][]" class="form-control" style="max-width: 300px;">
                </div>
            </div>

            <div class="form-group col-12 mb-3">
                <label class="form-label">{{ __('admin.Description') }}</label>
                <textarea name="episodes[text_ar][]" class="form-control mytextarea">{{ $episode->text_ar ?? '' }}</textarea>
            </div>

        </div>

        <button type="button" class="btn btn-danger removeEpisode">
            {{ __('admin.Delete Episode') }}
        </button>

    </div>

</div>


@push('modals')
<div class="modal fade" id="mediaPlayerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaPlayerModalLabel"></h5>
                <button type="button" class="btn-close" data-pc-modal-dismiss="#mediaPlayerModal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="mediaPlayerContent">
                <audio id="mediaPlayerAudio" controls preload="none" style="width:100%;display:none;"></audio>
                <video id="mediaPlayerVideo" controls preload="none" style="width:100%;max-height:400px;display:none;"></video>
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
        $(item).find('.episode-audio-field').toggle(type === 'audio');
        $(item).find('.episode-video-field').toggle(type === 'video');
    }
    function clearMediaPlayer() {
        var a = document.getElementById('mediaPlayerAudio');
        var v = document.getElementById('mediaPlayerVideo');
        if (a) { a.pause(); a.src = ''; }
        if (v) { v.pause(); v.src = ''; }
    }
    $(document).on('change', '.episode-type-select', function() {
        toggleEpisodeMedia($(this).closest('.episode-item'));
    });
    $(document).on('click', '.btn-play-media', function() {
        var url = $(this).data('url');
        var type = $(this).data('type');
        var modal = document.getElementById('mediaPlayerModal');
        var audioEl = document.getElementById('mediaPlayerAudio');
        var videoEl = document.getElementById('mediaPlayerVideo');
        if (!modal) return;
        audioEl.pause();
        videoEl.pause();
        audioEl.style.display = 'none';
        videoEl.style.display = 'none';
        if (type === 'audio') {
            audioEl.src = url;
            audioEl.style.display = 'block';
            document.getElementById('mediaPlayerModalLabel').textContent = '{{ __("admin.Audio") }}';
        } else {
            videoEl.src = url;
            videoEl.style.display = 'block';
            document.getElementById('mediaPlayerModalLabel').textContent = '{{ __("admin.Video") }}';
        }
        modal.classList.add('show');
        setTimeout(function() { modal.classList.add('animate'); }, 100);
        var overlay = document.getElementById('modaloverlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.className = 'fixed inset-0 bg-gray-900/20 z-[1028] backdrop-blur-sm';
            overlay.id = 'modaloverlay';
            document.body.appendChild(overlay);
            document.body.classList.add('modal-open');
            overlay.addEventListener('click', function() {
                clearMediaPlayer();
                if (typeof modalclose === 'function') modalclose();
            });
        }
    });
    $(document).on('click', '[data-pc-modal-dismiss="#mediaPlayerModal"]', clearMediaPlayer);
    $('.episode-item').each(function() { toggleEpisodeMedia(this); });
})();
$('#addEpisode').click(function() {
    let html = `{!! view('dashboard.podcasts._episode_row', ['episode' => null])->render() !!}`;
    $('#episodes-wrapper').append(html);
});
$(document).on('click', '.removeEpisode', function() {
    $(this).closest('.episode-item').remove();
});
</script>
@endpush