@php
$name = 'name_' . app()->getLocale();
@endphp
<div class="row">

    <div class="form-group col-6 mb-3">
        <x-form.input name="title_org" label="{{__('admin.Title')}}" type="text" placeholder="{{__('admin.enter news of title')}}" :value="$news->title_org" />
    </div>
    <div class="form-group col-6 mb-3">
        <x-form.input name="title_ar" label="{{__('admin.Title_AR')}}" :re='true' type="text" placeholder="{{__('admin.enter news of title')}}" required :value="$news->title_ar" />
    </div>
    <div class="form-group col-6 mb-3">
        <x-form.input name="title_en" label="{{__('admin.Title_EN')}}" :re='true' type="text" placeholder="{{__('admin.enter news of title')}}" required :value="$news->title_en" />
    </div>
    <div class="form-group col-6 mb-3">
        <x-form.input name="date" label="{{__('admin.Date')}}" :re='true' type="date" placeholder="mm/dd/yyyy"  required :value="$news->date" />
    </div>
    <!-- <div class="form-group col-6 mb-3">
            <x-form.input name="visit" label="{{__('admin.Visit')}}" type="number" placeholder="{{__('admin.enter news')}}" required :value="$news->visit" disabled/>
        </div> -->
    <input type="hidden" name="visit" value="{{ $news->visit }}">
    <div class="form-group col-12 mb-3">
        <label for="text_org" class="form-label">{{app()->getLocale() == 'ar' ? 'المحتوى باللغة الأصلية' : 'Content in the original language'}}</label>
        <textarea name="text_org" rows="3" class="form-control mytextarea">{!!$news->text_org!!}</textarea>
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
        <x-form.input name="keyword_org" class="TagifyBasic" label="{{app()->getLocale() == 'ar' ? 'الكلمات المفتاحية' : 'Keywords'}}" type="text" placeholder="{{__('admin.enter keyword')}}" :value="$news->keyword_org" />
    </div>
    <div class="form-group col-6 mb-3">
        <x-form.input name="keyword_ar" class="TagifyBasic" label="{{__('admin.Keyword_AR')}}" type="text" placeholder="{{__('admin.enter keyword')}}" required :value="$news->keyword_ar" />
    </div>
    <div class="form-group col-6 mb-3">
        <x-form.input name="keyword_en" class="TagifyBasic" label="{{__('admin.Keyword_EN')}}" type="text" placeholder="{{__('admin.enter keyword')}}" :value="$news->keyword_en" />
    </div>
    <div class="form-group col-6 mb-3">
        <label for="image">{{__('admin.Image View')}}<span style="color: red">*</span></label>
        @if ($news->id == null)
            <input type="file" name="img_view" class="form-control" accept="image/*" required />
        @else
            <input type="file" name="img_view" class="form-control" accept="image/*" />
        @endif
        <span class="text-muted">{{__('admin.Size Image')}}: 1920*1080 (16:9)</span>
        @if ($news->img_view)
            <div class="d-flex align-items-center justify-content-between mt-3" id="img_view">
                <img src="{{ asset('storage/' . $news->img_view) }}" alt="Current Image" width="50">
                {{-- <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('img_view')"><i class="fa fa-trash"></i></button> --}}
            </div>
        @endif
    </div>
    <div class="form-group col-6 mb-3">
        <label for="image">{{__('admin.Image In Article')}}</label>
        <input type="file" name="img_article" class="form-control" accept="image/*" />
        <span class="text-muted">{{__('admin.Size Image')}}: 1920*1080 (16:9)</span>
        @if ($news->img_article)
        <div class="d-flex align-items-center justify-content-between mt-3" id="img_article">
            <img src="{{ asset('storage/' . $news->img_article) }}" alt="Current Image" width="50">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('img_article')"><i class="fa fa-trash"></i></button>
        </div>
        @endif
    </div>

    <div class="form-group col-6 mb-3">
        <label for="image">{{__("admin.Vedio")}}</label>
        <input type="file" name="vedio" class="form-control" accept="video/mp4" />
        <span class="text-muted">{{__('admin.Size Vedio')}}: 1920*1080 (16:9)</span>
        @php
            $vedio = $news->vedio;
            $check = $vedio ? Storage::disk('public')->exists($news->vedio) : false;
        @endphp
        @if($news->vedio && $check)
            <div class="d-flex align-items-center justify-content-between mt-3" id="vedio">
                <video src="{{ asset('storage/' . $news->vedio)  }}" width="320" height="240" controls="controls"></video>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('vedio')"><i class="fa fa-trash"></i></button>
            </div>
        @endif
    </div>


    <div class="form-group col-6 mb-3">
        <label for="statu_id" class="form-label">{{__('admin.Status')}}<span style="color: red">*</span></label>
        <select id="statu_id" name="statu_id" class="form-control" required>
            <option value="" disabled selected>{{__('admin.Choose')}}</option>
            @foreach ($status as $statu)
            <option value="{{$statu->id}}" @selected( $news->statu_id == $statu->id)>{{$statu->$name}}</option>
            @endforeach
        </select>
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


    <div class="form-group col-6 mb-3">
        <label for="new_place_id" class="form-label">{{__('admin.NewPlace')}}<span style="color: red">*</span></label>
        <select id="new_place_id" name="new_place_id" class="form-control" required>
            <option value="" disabled selected>{{__('admin.Choose')}}</option>
            @foreach ($newplaces as $newplace)
            <option value="{{$newplace->id}}" @selected( $news->new_place_id == $newplace->id)>{{$newplace->$name}}</option>
            @endforeach
        </select>
    </div>



    @if($news->id != null)
    <div class="form-group col-6 mb-3">
        <label for="publisher_id" class="form-label">{{__('admin.Publisher')}}<span style="color: red">*</span></label>
        @if($news->publisher_id == 0)
        <input type="hidden" name="publisher_id" value="0">
        <x-form.input value="{{__('admin.Admin')}}" disabled/>
        @else
            <input type="hidden" name="publisher_id" value="{{$news->publisher_id}}">
            <select id="publisher_id" name="publisher_id" class="form-control" required disabled>
                <option value="" disabled selected>{{__('admin.Choose')}}</option>
                @foreach ($publishers as $publisher)
                    <option value="{{$publisher->id}}" @selected( $news->publisher_id == $publisher->id)>{{$publisher->name}}</option>
                @endforeach
            </select>
        @endif
    </div>
    @else
    <div class="form-group col-6 mb-3">
        {{-- <label for="publisher_id" class="form-label">{{__('admin.Publisher')}}<span style="color: red">*</span></label> --}}
        <input type="hidden" name="publisher_id" value="0">
    </div>
    @endif


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
<script>
        function removeImage(name) {
            const id = "{{ $news->id }}";
            $.ajax({
                url: `{{ route('dashboard.nw.removeImage', ':id') }}`.replace(':id', id),
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
