@php
    $name = 'name_' . app()->getLocale();
@endphp
<div class="row">
    <div class="form-group col-6 mb-3">
        <x-form.input name="title_org" label="{{__('admin.Title')}}" :re="true" type="text" placeholder="{{__('admin.enter news of title')}}" required :value="$news->title_org" />
    </div>
    <div class="form-group col-6 mb-3">
        <x-form.input name="date" label="{{__('admin.Date')}}" placeholder="mm/dd/yyyy"  :re="true" type="date" required :value="$news->date" />
    </div>
    <input type="hidden" name="visit" value="{{ $news->visit }}">
    <div class="form-group col-6 mb-3">
        <x-form.input name="keyword_org" class="TagifyBasic" label="{{__('admin.enter keyword')}}" type="text" placeholder="{{__('admin.enter keyword')}}" :value="$news->keyword_org" />
    </div>
    <div class="form-group col-6 mb-3">
        <label for="category_id" class="form-label">{{__('admin.Categories')}}<span style="color: red">*</span></label>
        <select id="category_id" name="category_id" class="form-control" required>
            <option value="" disabled selected>{{__('admin.Choose')}}</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}" @selected($news->category_id == $category->id)>
                    {{$category->$name}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-6 mb-3">
        <label for="image">{{__('admin.Image View')}}<span style="color: red">*</span></label>
        <input type="file" name="img_view" class="form-control" accept="image/*" @required(!isset($btn_label)) />
        <span class="text-muted">{{__('admin.Size Image')}}: 1920*1080 (16:9)</span>
        @if ($news->img_view)
            <img src="{{ asset('storage/' . $news->img_view) }}" alt="Current Image" width="50">
        @endif
    </div>
    <div class="form-group col-6 mb-3">
        <label for="image">{{__('admin.Image In Article')}}</label>
        <input type="file" name="img_article" class="form-control" accept="image/*" />
        <span class="text-muted">{{__('admin.Size Image')}}: 1920*1080 (16:9)</span>
        @if ($news->img_article)
            <img src="{{ asset('storage/' . $news->img_article) }}" alt="Current Image" width="50">
        @endif
    </div>
    <div class="form-group col-6 mb-3">
        <label for="image">{{__("admin.Vedio")}}</label>
        <input type="file" name="vedio" class="form-control" accept="video/mp4" />
        <span class="text-muted">{{__('admin.Size Vedio')}}: 1920*1080 (16:9)</span>
        @if ($news->vedio)
            <video src="{{ asset('storage/' . $news->vedio)  }}" width="320" height="240" controls="controls"></video>
        @endif
    </div>
    <div class="form-group col-12 mb-3">
        <label for="text_org" class="form-label">{{__('admin.Text')}}<span style="color: red">*</span></label>
        <textarea name="text_org" rows="4" class="form-control mytextarea" required>{!!$news->text_org!!}</textarea>
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


        // أهم الإعدادات
        paste_as_text: false, // لصق كنص عادي (يحل المشكلة)
        paste_word_valid_elements: 'b,strong,i,em,u,ul,ol,li,p,br',
        paste_retain_style_properties: '',

        entity_encoding: 'raw', // يحافظ على الترميز بشكل صحيح

        // دعم RTL أو LTR بناء على اللغة الحالية
        directionality: '{{ app()->getLocale() == "ar" ? "rtl" : "ltr" }}',

        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });
</script>
@endpush
