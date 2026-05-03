@php
    $name = 'name_' . app()->getLocale();
@endphp

<div class="row">
    <div class="form-group col-6 mb-3">
        <x-form.input name="title_ar" label="{{ __('admin.Title_AR') }}" :re='true' type="text"
            placeholder="{{ __('admin.enter video title') }}" required :value="$videos->title_ar" />
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input name="title_en" label="{{ __('admin.Title_EN') }}" :re='true' type="text"
            placeholder="{{ __('admin.enter video title') }}" required :value="$videos->title_en" />
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input name="date" label="{{ __('admin.Date') }}" :re='true' type="date"
            placeholder="mm/dd/yyyy" required :value="$videos->date" />
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input name="time" label="{{ __('admin.Duration') }}" type="text"
            placeholder="{{ __('admin.enter video duration') }}" :value="$videos->time" />
    </div>

    <div class="form-group col-6 mb-3">
        <label for="views_count" class="form-label">{{ __('admin.Views') ?? 'Views' }}</label>
        <input id="views_count" type="number" class="form-control" name="views_count"
            value="{{ old('views_count', $videos->views_count ?? 0) }}" readonly />
    </div>

    <div class="form-group col-6 mb-3 d-flex align-items-center gap-2" style="margin-top: 30px;">
        <input id="is_featured" type="checkbox" class="form-check-input" name="is_featured" value="1"
            @checked(old('is_featured', (bool) ($videos->is_featured ?? false))) />
        <label for="is_featured" class="form-check-label">{{ __('admin.Featured') ?? 'Featured' }}</label>
    </div>

    <div class="form-group col-12 mb-3">
        <label for="text_ar" class="form-label">{{ __('admin.Text_AR') }}<span style="color: red">*</span></label>
        <textarea name="text_ar" rows="3" class="form-control mytextarea" required>{{ $videos->text_ar }}</textarea>
    </div>

    <div class="form-group col-12 mb-3">
        <label for="text_en" class="form-label">{{ __('admin.Text_EN') }}<span style="color: red">*</span></label>
        <textarea name="text_en" rows="3" class="form-control mytextarea" required>{{ $videos->text_en }}</textarea>
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input name="keyword_ar" class="TagifyBasic" label="{{ __('admin.Keyword_AR') }}" type="text"
            placeholder="{{ __('admin.enter keyword') }}" :value="$videos->keyword_ar" />
    </div>

    <div class="form-group col-6 mb-3">
        <x-form.input name="keyword_en" class="TagifyBasic" label="{{ __('admin.Keyword_EN') }}" type="text"
            placeholder="{{ __('admin.enter keyword') }}" :value="$videos->keyword_en" />
    </div>

    <div class="form-group col-6 mb-3">
        <label for="image">{{ __('admin.Image View') }}<span style="color: red">*</span></label>
        @if ($videos->id == null)
            <input type="file" name="img_view" class="form-control" accept="image/*" required />
        @else
            <input type="file" name="img_view" class="form-control" accept="image/*" />
        @endif
        <span class="text-muted">{{ __('admin.Size Image') }}: 1920*1080 (16:9)</span>
        @if ($videos->img_view)
            <div class="d-flex align-items-center justify-content-between mt-3" id="img_view">
                <img src="{{ asset('storage/' . $videos->img_view) }}" alt="Current Image" width="50">
            </div>
        @endif
    </div>

    <div class="form-group col-6 mb-3">
        <label for="image">{{ __('admin.Vedio') }}<span style="color: red">*</span></label>
        @if ($videos->id == null)
            <input type="file" name="vedio" class="form-control" accept="video/mp4,video/webm,video/ogg" required />
        @else
            <input type="file" name="vedio" class="form-control" accept="video/mp4,video/webm,video/ogg" />
        @endif
        <span class="text-muted">{{ __('admin.Size Vedio') }}: 1920*1080 (16:9)</span>
        @php
            $vedio = $videos->vedio;
            $check = $vedio ? Storage::disk('public')->exists($videos->vedio) : false;
        @endphp
        @if ($videos->vedio && $check)
            <div class="d-flex align-items-center gap-2 mt-3" id="vedio">
                <button type="button" class="btn btn-sm btn-outline-primary btn-play-video"
                    data-url="{{ asset('storage/' . $videos->vedio) }}"
                    data-hls-url="{{ $videos->hls_path && $videos->status === 'ready' ? asset('storage/' . $videos->hls_path) : '' }}">
                    {{ __('admin.Open_Video') }}
                </button>
                @if($videos->status)
                    <span class="badge bg-{{ $videos->status === 'ready' ? 'success' : ($videos->status === 'failed' ? 'danger' : 'warning') }}">
                        {{ $videos->status === 'ready' ? 'جاهز' : ($videos->status === 'failed' ? 'فشل التحويل' : 'قيد المعالجة') }}
                    </span>
                @endif
                <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('vedio')">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        @endif
    </div>

    <div class="form-group col-6 mb-3">
    <label>{{ __('admin.Video URL') }}</label>
    <input type="url" name="video_url" class="form-control"
        placeholder="https://youtube.com/..." value="{{ old('video_url', $videos->video_url ?? '') }}">
</div>

    <div class="form-group col-6 mb-3">
        <label for="category_id" class="form-label">{{ __('admin.Categories') }}<span style="color: red">*</span></label>
        <select id="category_id" name="category_id" class="form-control" required>
            <option value="" disabled selected>{{ __('admin.Choose') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected($videos->category_id == $category->id)>
                    {{ $category->$name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

@push('modals')
<div class="modal fade" id="videoPlayerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('admin.Video') }}</h5>
                <button type="button" class="btn-close" data-pc-modal-dismiss="#videoPlayerModal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <video id="videoPlayerEl" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="none" style="width:100%;max-height:400px;"></video>
            </div>
        </div>
    </div>
</div>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.33.2/tagify.css" referrerpolicy="origin">
    <link rel="stylesheet" href="https://vjs.zencdn.net/8.6.1/video-js.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.33.2/tagify.min.js" referrerpolicy="origin"></script>
    <script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>

    <script>
        const tagifyElements = document.querySelectorAll('.TagifyBasic');
        tagifyElements.forEach(el => {
            new Tagify(el);
        });

        tinymce.init({
            selector: '.mytextarea',
            height: 500,
            menubar: true,
            plugins: `
                advlist autolink lists link image charmap print preview anchor
                searchreplace visualblocks code fullscreen
                insertdatetime media table code help wordcount
                emoticons codesample directionality hr pagebreak
            `,
            toolbar: `
                undo redo | blocks | bold italic underline strikethrough forecolor backcolor |
                alignleft aligncenter alignright alignjustify |
                bullist numlist outdent indent | link image media table |
                emoticons charmap hr pagebreak | code fullscreen preview print |
                ltr rtl | removeformat
            `,
            paste_as_text: false,
            paste_word_valid_elements: 'b,strong,i,em,u,ul,ol,li,p,br',
            paste_retain_style_properties: '',
            entity_encoding: 'raw',
            directionality: '{{ app()->getLocale() == "ar" ? "rtl" : "ltr" }}',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    </script>

    <script>
        let dashboardVideoPlayer = null;

        $(document).on('click', '.btn-play-video', function() {
            var url = $(this).data('url');
            var hlsUrl = $(this).data('hls-url');
            var modal = document.getElementById('videoPlayerModal');
            var videoEl = document.getElementById('videoPlayerEl');
            if (!modal || !videoEl) return;

            if (!dashboardVideoPlayer && typeof videojs === 'function') {
                dashboardVideoPlayer = videojs('videoPlayerEl', {
                    fluid: true,
                    responsive: true
                });
            }

            if (dashboardVideoPlayer) {
                dashboardVideoPlayer.src({
                    src: hlsUrl || url,
                    type: hlsUrl ? 'application/x-mpegURL' : 'video/mp4'
                });
            } else {
                videoEl.src = url;
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
                    if (dashboardVideoPlayer) {
                        dashboardVideoPlayer.pause();
                        dashboardVideoPlayer.src({ src: '', type: 'video/mp4' });
                    } else {
                        videoEl.pause();
                        videoEl.src = '';
                    }
                    if (typeof modalclose === 'function') modalclose();
                });
            }
        });
        $(document).on('click', '[data-pc-modal-dismiss="#videoPlayerModal"]', function() {
            var videoEl = document.getElementById('videoPlayerEl');
            if (dashboardVideoPlayer) {
                dashboardVideoPlayer.pause();
                dashboardVideoPlayer.src({ src: '', type: 'video/mp4' });
            } else if (videoEl) { videoEl.pause(); videoEl.src = ''; }
        });
        function removeImage(name) {
            const id = "{{ $videos->id }}";
            $.ajax({
                url: `{{ route('dashboard.video.removeImage', ':id') }}`.replace(':id', id),
                type: 'POST',
                data: {
                    name: name,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $(`#${name}`).remove();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endpush
