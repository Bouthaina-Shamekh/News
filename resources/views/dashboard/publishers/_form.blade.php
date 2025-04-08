<div class="row">

<div class="form-group col-6 mb-3">
    <x-form.input name="name" label="{{ __('admin.Name') }}" type="text" placeholder="{{ __('admin.enter publisher name') }}" required :value="$publishers->name" />
</div>

<div class="form-group col-6 mb-3">
    <x-form.input name="email" label="{{ __('admin.Email') }}" type="email" placeholder="{{ __('admin.enter publisher email') }}" required :value="$publishers->email" />
</div>

<div class="form-group col-6 mb-3">
    <x-form.input name="password" label="{{ __('admin.Password') }}" type="password" placeholder="{{ __('admin.enter publisher password') }}" required :value="$publishers->password" />
</div>

<div class="form-group col-6 mb-3">
    <x-form.input name="phone" label="{{ __('admin.Phone') }}" type="text" placeholder="{{ __('admin.enter publisher phone') }}" required :value="$publishers->phone" />
</div>

<div class="form-group col-6 mb-3">
    <label for="image">Image</label>
    <input type="file" name="imageFile" class="form-control" />
    @if($publishers->image)
        <img src="{{ asset('storage/' . $publishers->image) }}" alt="Current Image" width="60">
    @endif
</div>

<div class="form-group col-6 mb-3">
    <x-form.input name="birth_of_date" label="{{ __('admin.Birth of Date') }}" type="date" placeholder="{{ __('admin.enter publisher Birth of Date') }}" required :value="$publishers->birth_of_date" />
</div>

<div class="form-group col-6 mb-3">
    <x-form.input name="address" label="{{ __('admin.Address') }}" type="text" placeholder="{{ __('admin.enter publisher address') }}" required :value="$publishers->address" />
</div>





<div class="form-group col-6 mb-3">
    <label for="content_en" class="form-label">{{('admin.About')}}</label>
    <textarea name="about" id="mytextarea" rows="3" class="form-control" required>{{$publishers->about}}</textarea>
</div>



<input type="hidden" name="visit" value="{{$publishers->visit ?? 0 }}">


<div class="form-group col-6 mb-3">
<label for="status" class="form-label">{{('admin.Status')}}</label>
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
    <label for="attachments">Attachments</label>
    <input type="file" name="attachmentsFile" class="form-control" />
    @if($publishers->attachments)
    <img src="{{ asset('storage/' . $publishers->attachments) }}" alt="Current Attachment" height="60">
    @endif
  </div>

</div>
