@php
    $name = 'name_' . app()->getLocale();
@endphp
<div class="row">

        <div class="form-group col-6 mb-3">
            <x-form.input name="title_ar" label="{{__('admin.Title_AR')}}" :re="true" type="text" placeholder="{{__('admin.enter news of title')}}" required :value="$news->title_ar" />
        </div>


        <div class="form-group col-6 mb-3">
            <x-form.input name="title_en" label="{{__('admin.Title_EN')}}" :re="true" type="text" placeholder="{{__('admin.enter news of title')}}" :value="$news->title_en" />
        </div>



        <div class="form-group col-6 mb-3">
            <x-form.input name="date" label="{{__('admin.Date')}}" :re="true" type="date" required :value="$news->date" />
        </div>


        <input type="hidden" name="visit" value="{{ $news->visit }}">


        <div class="form-group col-6 mb-3">
            <x-form.input name="keyword_ar" class="TagifyBasic" label="{{__('admin.Keyword_AR')}}" type="text" placeholder="{{__('admin.enter keyword')}}" :value="$news->keyword_ar" />
        </div>


        <div class="form-group col-6 mb-3">
            <x-form.input name="keyword_en" class="TagifyBasic" label="{{__('admin.Keyword_EN')}}" type="text" placeholder="{{__('admin.enter keyword')}}" :value="$news->keyword_en" />
        </div>


        <div class="form-group col-12 mb-3">
            <label for="text_ar" class="form-label">{{__('admin.Text_AR')}}<span style="color: red">*</span></label>
            <textarea name="text_ar" rows="3" class="form-control mytextarea" required>{!!$news->text_ar!!}</textarea>
        </div>


        <div class="form-group col-12 mb-3">
            <label for="text_en" class="form-label">{{__('admin.Text_EN')}}<span style="color: red">*</span></label>
            <textarea name="text_en" rows="3" class="form-control mytextarea">{!!$news->text_en!!}</textarea>
        </div>







        <div class="form-group col-6 mb-3">
            <label for="image">{{__('admin.Image View')}}</label>
            <input type="file" name="img_view" class="form-control" />
            <span class="text-muted">{{__('admin.Size Image')}}: 1920*1080 (16:9)</span>
            @if ($news->img_view)
                <img src="{{ asset('storage/' . $news->img_view) }}" alt="Current Image" width="50">
            @endif
        </div>
        <div class="form-group col-6 mb-3">
            <label for="image">{{__('admin.Image In Article')}}</label>
            <input type="file" name="img_article" class="form-control" />
            <span class="text-muted">{{__('admin.Size Image')}}: 1920*1080 (16:9)</span>
            @if ($news->img_article)
                <img src="{{ asset('storage/' . $news->img_article) }}" alt="Current Image" width="50">
            @endif
        </div>

        <div class="form-group col-6 mb-3">
            <label for="image">{{__("admin.Vedio")}}</label>
            <input type="file" name="vedio" class="form-control" />
            <span class="text-muted">{{__('admin.Size Vedio')}}: 1920*1080 (16:9)</span>
            @if ($news->vedio)
            <video src="{{ asset('storage/' . $news->vedio)  }}" width="320" height="240" controls="controls"></video>
            @endif
        </div>





        <div class="form-group col-6 mb-3">
            <label for="category_id" class="form-label">{{__('admin.Categories')}}<span style="color: red">*</span></label>
            <select id="category_id" name="category_id" class="form-control" required>
                <option value="" disabled selected>{{__('admin.Choose')}}</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}" @selected( $news->category_id ==$category->id)>{{$category->$name}}</option>
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
@endpush