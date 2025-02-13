<div class="row">

<div class="form-group col-6 mb-3">
    <x-form.input name="name_ar" label="{{__('admin.Name_AR')}}" type="text" placeholder="{{__('admin.enter name of categories in arabic')}}" required :value="$categories->name_ar" />
</div>
<div class="form-group col-6 mb-3">
    <x-form.input name="name_en" label="{{__('admin.Name_EN')}}" type="text" placeholder="{{__('admin.enter name of categories in english')}}" required :value="$categories->name_en" />
</div>




<div class="form-group col-6 mb-3">
<label for="image">Image</label>
<input type="file" name="image" class="form-control" />

<img src="{{ asset('uploads/categories/' . $categories->image) }}" alt="Current Image" height="60">

</div>


</div>