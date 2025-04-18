<div class="row">
    <div class="form-group col-6 mb-3">
        <x-form.input name="name_ar" label="{{__('admin.Name_AR')}}" :re="true" type="text" placeholder="{{__('admin.enter name of status in arabic')}}" required :value="$status->name_ar" />
    </div>
    <div class="form-group col-6 mb-3">
        <x-form.input name="name_en" label="{{__('admin.Name_EN')}}" :re="true" type="text" placeholder="{{__('admin.enter name of status in english')}}" required :value="$status->name_en" />
    </div>
</div>
