<div class="row">

    <div class="form-group col-6 mb-3">
        <x-form.input name="name_ar" label="{{ __('admin.Name_AR') }}" :re="true" type="text"
            placeholder="{{ __('admin.enter name of categories in arabic') }}" required :value="$categories->name_ar" />
    </div>
    <div class="form-group col-6 mb-3">
        <x-form.input name="name_en" label="{{ __('admin.Name_EN') }}" :re="true" type="text"
            placeholder="{{ __('admin.enter name of categories in english') }}" required :value="$categories->name_en" />
    </div>




    <div class="form-group col-6 mb-3">
        <label for="image">{{__('admin.Image')}}</label>
        <input type="file" name="image" class="form-control" />
        <span class="text-muted">{{__('admin.Size Image')}}: 1080*1080 (1:1)</span>
        @if($categories->image)
            <img src="{{ asset('storage/' . $categories->image) }}" alt="Current Image" height="60">
        @endif
    </div>


</div>
