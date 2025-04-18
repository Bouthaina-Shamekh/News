<div class="row">

<div class="form-group col-6 mb-3">
    <x-form.input name="name" label="{{ __('admin.Name') }}" :re="true" type="text" placeholder="{{ __('admin.enter publisher name') }}" required :value="$publishers->name" />
</div>

<div class="form-group col-6 mb-3">
    <x-form.input name="email" label="{{ __('admin.Email') }}"  :re="true" type="email" placeholder="{{ __('admin.enter publisher email') }}" required :value="$publishers->email" />
</div>

<div class="form-group col-6 mb-3">
    <x-form.input name="password" label="{{ __('admin.Password') }}" :re="true" type="password" placeholder="{{ __('admin.enter publisher password') }}" required/>
</div>

<div class="form-group col-6 mb-3">
    <x-form.input name="phone" label="{{ __('admin.Phone') }}" :re="true" type="text" placeholder="{{ __('admin.enter publisher phone') }}" required :value="$publishers->phone" />
</div>

<div class="form-group col-6 mb-3">
    <label for="image">{{__('admin.Image')}}</label>
    <input type="file" name="imageFile" class="form-control" />
    <span class="text-muted">{{__('admin.Size Image')}}: 1:1</span>
    @if($publishers->image)
        <img src="{{ asset('storage/' . $publishers->image) }}" alt="Current Image" width="60">
    @endif
</div>

<div class="form-group col-6 mb-3">
    <x-form.input name="birth_of_date" label="{{ __('admin.Birth of Date') }}" :re="true" type="date" placeholder="{{ __('admin.enter publisher Birth of Date') }}" required :value="$publishers->birth_of_date" />
</div>

<div class="form-group col-6 mb-3">
    <x-form.input name="address" label="{{ __('admin.Address') }}" :re="true" type="text" placeholder="{{ __('admin.enter publisher address') }}" required :value="$publishers->address" />
</div>





<div class="form-group col-6 mb-3">
    <label for="content_en" class="form-label">{{__('admin.About')}}<span style="color: red">*</span></label>
    <textarea name="about" id="mytextarea" rows="3" class="form-control" required>{{$publishers->about}}</textarea>
</div>



<input type="hidden" name="visit" value="{{$publishers->visit ?? 0 }}">


<div class="form-group col-6 mb-3">
<label for="status" class="form-label">{{__('admin.Status')}} <span style="color: red">*</span></label>
<div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="status-active"
            value="1" @checked(old('status', $publishers->status) == 1)>
        <label class="form-check-label" for="status-active">{{__('admin.Accept')}}</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="status" id="status-inactive"
            value="0" @checked(old('status', $publishers->status) == 0)>
        <label class="form-check-label" for="status-inactive">{{__('admin.Dont Accept')}}</label>
    </div>
</div>
</div>




<div class="form-group col-6 mb-3">
    <label for="attachments">{{__('admin.Attachments')}}</label>
    <input type="file" name="attachmentsFile" class="form-control" />
    @if($publishers->attachments)
    <img src="{{ asset('storage/' . $publishers->attachments) }}" alt="Current Attachment" height="60">
    @endif
  </div>

</div>
