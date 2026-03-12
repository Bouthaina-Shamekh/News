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
        <label for="image">{{ __('admin.Image Video') }}</label>
        <input type="file" name="img_video" class="form-control" accept="image/*" />
        <span class="text-muted">{{ __('admin.Size Image') }}: 1920*1080 (16:9)</span>
        @if ($videos->img_video)
            <div class="d-flex align-items-center justify-content-between mt-3" id="img_video">
                <img src="{{ asset('storage/' . $videos->img_video) }}" alt="Current Image" width="50">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('img_video')">
                    <i class="fa fa-trash"></i>
                </button>
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
            <div class="d-flex align-items-start justify-content-between mt-3" id="vedio">
                <video width="320" height="240" controls="controls">
                    <source src="{{ asset('storage/' . $videos->vedio) }}" type="video/mp4">
                    <source src="{{ asset('storage/' . $videos->vedio) }}" type="video/webm">
                    <source src="{{ asset('storage/' . $videos->vedio) }}" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('vedio')">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        @endif
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

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.33.2/tagify.css" referrerpolicy="origin">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.33.2/tagify.min.js" referrerpolicy="origin"></script>

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