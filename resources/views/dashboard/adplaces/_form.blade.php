                    <div class="row">

                        <div class="form-group col-6 mb-3">
                            <x-form.input name="name_ar" label="{{__('admin.Name_AR')}}" type="text" placeholder="{{__('admin.enter name of adplaces in arabic')}}" required :value="$adplaces->name_ar" />
                        </div>
                        <div class="form-group col-6 mb-3">
                            <x-form.input name="name_en" label="{{__('admin.Name_EN')}}" type="text" placeholder="{{__('admin.enter name of adplaces in english')}}" required :value="$adplaces->name_en" />
                        </div>


                    </div>