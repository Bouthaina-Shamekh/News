@php
    $name = 'name_' . app()->getLocale();
@endphp
<div class="row">

    <div class="form-group col-6 mb-3">
        <x-form.input name="title" label="{{ __('admin.Title') }}" :re="true" type="text"
            placeholder="{{ __('admin.enter news of title') }}" required :value="$ads->title" />
    </div>


    <div class="form-group col-6 mb-3">
        <x-form.input name="url" label="{{ __('admin.Url') }}" :re="true" type="text"
            placeholder="{{ __('admin.enter url') }}" required :value="$ads->url" />
    </div>
    <div class="form-group col-6 mb-3">
        <label for="image">{{ __('admin.Image') }}</label>
        <input type="file" name="imageFile" class="form-control" />
        <span class="text-muted">{{__('admin.By Advertising Site')}}</span>
        @if ($ads->image)
            <!-- تأكد من أن المتغير صحيح -->
            <img src="{{ asset('storage/' . $ads->image) }}" alt="Current Image" width="60">
        @endif
    </div>



    <div class="form-group col-6 mb-3">
        <x-form.input name="owner" label="{{ __('admin.Owner') }}" :re="true" type="text"
            placeholder="{{ __('admin.enter name of owner') }}" required :value="$ads->owner" />
    </div>


    <div class="form-group col-6 mb-3">
        <x-form.input name="owner_phone" label="{{ __('admin.Owner Phone') }}" :re="true" type="number"
            placeholder="{{ __('admin.enter name of owner phone') }}" required :value="$ads->owner_phone" />
    </div>


    <div class="form-group col-6 mb-3">
        <x-form.input name="price" label="{{ __('admin.Price') }}" :re="true" type="number"
            placeholder="{{ __('admin.enter price') }}" required :value="$ads->price" />
    </div>



    <div class="form-group col-6 mb-3">
        <x-form.input name="date" label="{{ __('admin.Ad Date') }}" :re="true" type="date"
            placeholder="{{ __('admin.enter date') }}" required :value="$ads->date" />
    </div>



    <div class="form-group col-6 mb-3">
        <x-form.input name="time" label="{{ __('admin.Duration') }}" :re="true" type="time"
            placeholder="{{ __('admin.enter Duration') }}" required :value="$ads->time" />
    </div>

    <input type="hidden" name="visit" value="{{ $ads->visit ?? 0 }}">

    <div class="mb-4 col-md-6">
        <label for="ad_place_id" class="form-label">{{ __('admin. Ad Place') }} <span style="color: red">*</span></label>
        <select id="ad_place_id" name="ad_place_id" class="form-control" required>
            <option value="" disabled selected>{{ __('admin.Choose') }}</option>
            @foreach ($adplases as $adplase)
                <option value="{{ $adplase->id }}" @selected($ads->ad_place_id == $adplase->id)>{{ $adplase->$name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-6 mb-3">
        <label for="notes" class="form-label">{{ __('admin.Notes') }} <span style="color: red">*</span></label>
        <textarea name="notes" id="mytextarea" rows="3" class="form-control" required>{{ $ads->notes }}</textarea>
    </div>




    <!-- <div class="form-group col-6 mb-3">
    <label for="image">Image</label>
    <input type="file" name="image" class="form-control" />

    <img src="{{ asset('uploads/categories/' . $ads->image) }}" alt="Current Image" height="60">

</div> -->


</div>
