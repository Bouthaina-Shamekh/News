@php
        $name = 'name_' . app()->getLocale();
    @endphp
    <div class="row">
        <div class="form-group col-6 mb-3">
            <x-form.input name="title_ar" label="{{ __('admin.Title_AR') }}" :re='true' type="text"
                placeholder="{{ __('admin.enter news of title') }}" required :value="$articals->title_ar" />
        </div>
        <div class="form-group col-6 mb-3">
            <x-form.input name="title_en" label="{{ __('admin.Title_EN') }}" :re='true' type="text"
                placeholder="{{ __('admin.enter news of title') }}" required :value="$articals->title_en" />
        </div>
        <div class="form-group col-6 mb-3">
            <x-form.input name="date" label="{{ __('admin.Date') }}" :re='true' type="date"
                placeholder="mm/dd/yyyy"  required :value="$articals->date" />
        </div>
        <!-- <div class="form-group col-6 mb-3">
            <x-form.input name="place" label="{{ __('admin.Place') }}" type="string" placeholder="{{ __('admin.enter artical of place') }}" required :value="$articals->place" />
        </div> -->
        <div class="form-group col-6 mb-3">
            <label for="place" class="form-label">{{ __('admin.place') }}<span style="color: red">*</span></label>
            <select name="place" id="place" class="form-control" required>
                <option value="documentary" @selected($articals->place == 'documentary')>{{ __('admin.documentary') }}
                </option>
                <option value="war" @selected($articals->place == 'war')>{{ __('admin.war') }}</option>
                <option value="peace" @selected($articals->place == 'peace')>{{ __('admin.peace') }}</option>
            </select>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="text_ar" class="form-label">{{ __('admin.Text_AR') }}<span style="color: red">*</span></label>
            <textarea name="text_ar" rows="3" class="form-control mytextarea" required>{{ $articals->text_ar }}</textarea>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="text_en" class="form-label">{{ __('admin.Text_EN') }}<span style="color: red">*</span></label>
            <textarea name="text_en" rows="3" class="form-control mytextarea" required>{{ $articals->text_en }}</textarea>
        </div>

        <div class="form-group col-6 mb-3">
            <x-form.input name="keyword_ar"  class="TagifyBasic" label="{{__('admin.Keyword_AR')}}" type="text" placeholder="{{__('admin.enter keyword')}}"  :value="$articals->keyword_ar" />
        </div>
        <div class="form-group col-6 mb-3">
            <x-form.input name="keyword_en" class="TagifyBasic" label="{{__('admin.Keyword_EN')}}" type="text" placeholder="{{__('admin.enter keyword')}}" :value="$articals->keyword_en" />
        </div>
        <input type="hidden" name="visit" value="{{ $articals->visit }}">
        <div class="form-group col-6 mb-3">
            <label for="image">{{__('admin.Image View')}}<span style="color: red">*</span></label>
            @if ($articals->id == null)
            <input type="file" name="img_view" class="form-control" accept="image/*" required />
            @else
            <input type="file" name="img_view" class="form-control" accept="image/*" />
            @endif
            <span class="text-muted">{{__('admin.Size Image')}}: 1920*1080 (16:9)</span>
            @if ($articals->img_view)
                <div class="d-flex align-items-center justify-content-between mt-3" id="img_view">
                    <img src="{{ asset('storage/' . $articals->img_view) }}" alt="Current Image" width="50">
                    {{-- <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('img_view')"><i class="fa fa-trash"></i></button> --}}
                </div>
            @endif
        </div>
        <div class="form-group col-6 mb-3">
            <label for="image">{{__('admin.Image In Article')}}</label>
            <input type="file" name="img_article" class="form-control" accept="image/*" />
            <span class="text-muted">{{__('admin.Size Image')}}: 1920*1080 (16:9)</span>
            @if($articals->img_article)
                <div class="d-flex align-items-center justify-content-between mt-3" id="img_article">
                    <img src="{{ asset('storage/' . $articals->img_article) }}" alt="Current Image" width="50">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('img_article')"><i class="fa fa-trash"></i></button>
                </div>
            @endif
        </div>
        <div class="form-group col-6 mb-3">
            <label for="image">{{__('admin.Vedio')}}</label>
            <input type="file" name="vedio" class="form-control" accept="video/*" />
            <span class="text-muted">{{__('admin.Size Vedio')}}: 1920*1080 (16:9)</span>
            @php
                $vedio = $articals->vedio;
                $check = $vedio ? Storage::disk('public')->exists($articals->vedio) : false;
            @endphp
            @if($articals->vedio && $check)

                <div class="d-flex align-items-start justify-content-between mt-3" id="vedio">
                    <video width="320" height="240" controls="controls">
                        <source src="{{ asset('storage/' . $articals->vedio) }}" type="video/mp4">
                        <source src="{{ asset('storage/' . $articals->vedio) }}" type="video/webm">
                        <source src="{{ asset('storage/' . $articals->vedio) }}" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('vedio')"><i class="fa fa-trash"></i></button>
                </div>
            @endif
        </div>
        <div class="form-group col-6 mb-3">
            <label for="statu_id" class="form-label">{{ __('admin.Status') }}<span style="color: red">*</span></label>
            <select id="statu_id" name="statu_id" class="form-control" required>
                <option value="" disabled selected>{{ __('admin.Choose') }}</option>
                @foreach ($status as $statu)
                    <option value="{{ $statu->id }}" @selected($articals->statu_id == $statu->id)>
                        {{ $statu->$name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-6 mb-3">
            <label for="category_id" class="form-label">{{ __('admin.Categories') }}<span style="color: red">*</span></label>
            <select id="category_id" name="category_id" class="form-control" required>
                <option value="" disabled selected>{{ __('admin.Choose') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($articals->category_id == $category->id)>
                        {{ $category->$name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-6 mb-3">
            <label for="publisher_id" class="form-label">{{ __('admin.Publisher') }}<span style="color: red">*</span></label>
            <select id="publisher_id" name="publisher_id" class="form-control" required>
                <option value="" disabled selected>{{ __('admin.Choose') }}</option>
                @foreach ($publishers as $publisher)
                    <option value="{{ $publisher->id }}" @selected($articals->publisher_id == $publisher->id)>
                        {{ $publisher->name }}</option>
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
    // Basic
    //------------------------------------------------------
    const tagifyElements = document.querySelectorAll('.TagifyBasic');
    tagifyElements.forEach(el => {
        new Tagify(el);
    });
    tinymce.init({
        selector: '.mytextarea',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
</script>
<script>
        function removeImage(name) {
            const id = "{{ $articals->id }}";
            $.ajax({
                url: `{{ route('dashboard.articale.removeImage', ':id') }}`.replace(':id', id),
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
