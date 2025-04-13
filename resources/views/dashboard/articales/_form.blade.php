@php
        $name = 'name_' . app()->getLocale();
    @endphp
    <div class="row">
        <div class="form-group col-6 mb-3">
            <x-form.input name="title_ar" label="{{ __('admin.Title_AR') }}" type="text"
                placeholder="{{ __('admin.enter name of title') }}" required :value="$articals->title_ar" />
        </div>
        <div class="form-group col-6 mb-3">
            <x-form.input name="title_en" label="{{ __('admin.Title_EN') }}" type="text"
                placeholder="{{ __('admin.enter name of title') }}" required :value="$articals->title_en" />
        </div>
        <div class="form-group col-6 mb-3">
            <x-form.input name="date" label="{{ __('admin.Date') }}" type="date"
                placeholder="{{ __('admin.enter artical of date') }}" required :value="$articals->date" />
        </div>
        <!-- <div class="form-group col-6 mb-3">
            <x-form.input name="place" label="{{ __('admin.Place') }}" type="string" placeholder="{{ __('admin.enter artical of place') }}" required :value="$articals->place" />
        </div> -->
        <div class="form-group col-6 mb-3">
            <label for="place" class="form-label">{{ __('admin.place') }}</label>
            <select name="place" id="place" class="form-control">
                <option value="documentary" @selected($articals->place == 'documentary')>{{ __('admin.documentary') }}
                </option>
                <option value="war" @selected($articals->place == 'war')>{{ __('admin.war') }}</option>
                <option value="peace" @selected($articals->place == 'peace')>{{ __('admin.peace') }}</option>
            </select>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="text_ar" class="form-label">{{ __('admin.Text_AR') }}</label>
            <textarea name="text_ar" rows="3" class="form-control mytextarea" required>{{ $articals->text_ar }}</textarea>
        </div>
        <div class="form-group col-12 mb-3">
            <label for="text_en" class="form-label">{{ __('admin.Text_EN') }}</label>
            <textarea name="text_en" rows="3" class="form-control mytextarea" required>{{ $articals->text_en }}</textarea>
        </div>

        <div class="form-group col-6 mb-3">
            <x-form.input name="keyword_ar" label="{{__('admin.Keyword_AR')}}" type="text" placeholder="{{__('admin.enter articals of keyword')}}"  :value="$articals->keyword_ar" />
        </div>


        <div class="form-group col-6 mb-3">
            <x-form.input name="keyword_en" label="{{__('admin.Keyword_EN')}}" type="text" placeholder="{{__('admin.enter articals of keyword')}}" :value="$articals->keyword_en" />
        </div>
        <!-- <div class="form-group col-6 mb-3">
            <x-form.input name="visit" label="{{ __('admin.Visit') }}" type="number" placeholder="{{ __('admin.enter artical') }}" required :value="$articals->visit" />
        </div> -->
        <input type="hidden" name="visit" value="{{ $articals->visit }}">
        <div class="form-group col-6 mb-3">
            <label for="image">{{__('admin.Image')}}</label>
            <input type="file" name="img_view" class="form-control" />
            <span class="text-muted">{{__('admin.Size Image')}}: 16:9</span>
            @if ($articals->img_view)
                <img src="{{ asset('storage/' . $articals->img_view) }}" alt="Current Image" width="50">
            @endif
        </div>
        <div class="form-group col-6 mb-3">
            <label for="image">{{__('admin.Image')}}</label>
            <input type="file" name="img_article" class="form-control" />
            <span class="text-muted">{{__('admin.Size Image')}}: 16:9</span>
            @if($articals->img_article)
                <img src="{{ asset('storage/' . $articals->img_article) }}" alt="Current Image" width="50">
            @endif
        </div>
        <div class="form-group col-6 mb-3">
            <label for="image">{{__('admin.Vedio')}}</label>
            <input type="file" name="vedio" class="form-control" />
            <span class="text-muted">{{__('admin.Size Vedio')}}: 16:9</span>
            @if($articals->vedio)
                <video src="{{ asset('storage/' . $articals->vedio) }}" width="320" height="240" controls="controls"></video>
            @endif
        </div>
        <div class="form-group col-6 mb-3">
            <label for="statu_id" class="form-label">{{ __('admin.Status') }}</label>
            <select id="statu_id" name="statu_id" class="form-control">
                <option value="" disabled selected>{{ __('admin.Choose') }}</option>
                @foreach ($status as $statu)
                    <option value="{{ $statu->id }}" @selected($articals->statu_id == $statu->id)>
                        {{ $statu->$name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-6 mb-3">
            <label for="category_id" class="form-label">{{ __('admin.Categories') }}</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="" disabled selected>{{ __('admin.Choose') }}</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($articals->category_id == $category->id)>
                        {{ $category->$name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-6 mb-3">
            <label for="publisher_id" class="form-label">{{ __('admin.Publisher') }}</label>
            <select id="publisher_id" name="publisher_id" class="form-control">
                <option value="" disabled selected>{{ __('admin.Choose') }}</option>
                @foreach ($publishers as $publisher)
                    <option value="{{ $publisher->id }}" @selected($articals->publisher_id == $publisher->id)>
                        {{ $publisher->name }}</option>
                @endforeach
            </select>
        </div>
    </div>



@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js" referrerpolicy="origin"></script>

<script>
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