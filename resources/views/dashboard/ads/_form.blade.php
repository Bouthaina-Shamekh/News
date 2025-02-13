                    <div class="row">

                        <div class="form-group col-6 mb-3">
                            <x-form.input name="title" label="{{__('admin.Title')}}" type="text" placeholder="{{__('admin.enter name of title ')}}" required :value="$ads->title" />
                        </div>


                        <div class="form-group col-6 mb-3">
                            <x-form.input name="url" label="{{__('admin.Url')}}" type="text" placeholder="{{__('admin.enter name of url ')}}" required :value="$ads->url" />
                        </div>



                        <!-- <div class="form-group col-6 mb-3">
                        <label for="image">{{__('admin.Image')}}</label>
                        <input type="file" name="imageFile" class="form-control" />
                        @if ($ads->image) 
                      <img src="{{ asset('storage/' . $ads->image) }}" alt="Current Image" height="60">
                        @endif
                    </div> -->

                        <div class="form-group col-6 mb-3">
                            <label for="image">{{ __('admin.Image') }}</label>
                            <input type="file" name="imageFile" class="form-control" />

                            @if ($ads->image) <!-- تأكد من أن المتغير صحيح -->
                            <img src="{{ asset('storage/' . $ads->image) }}" alt="Current Image" height="60">
                            @else
                            <p>No image available</p>
                            @endif
                        </div>



                        <div class="form-group col-6 mb-3">
                            <x-form.input name="owner" label="{{__('admin.Owner')}}" type="text" placeholder="{{__('admin.enter name of owner ')}}" required :value="$ads->owner" />
                        </div>


                        <div class="form-group col-6 mb-3">
                            <x-form.input name="owner_phone" label="{{__('admin.Owner Phone')}}" type="number" placeholder="{{__('admin.enter name of owner phone')}}" required :value="$ads->owner_phone" />
                        </div>


                        <div class="form-group col-6 mb-3">
                            <x-form.input name="price" label="{{__('admin.Price')}}" type="number" placeholder="{{__('admin.enter name of price')}}" required :value="$ads->price" />
                        </div>



                        <div class="form-group col-6 mb-3">
                            <x-form.input name="date" label="{{__('admin.Date')}}" type="date" placeholder="{{__('admin.enter name of date ')}}" required :value="$ads->date" />
                        </div>



                        <div class="form-group col-6 mb-3">
                            <x-form.input name="time" label="{{__('admin.time')}}" type="time" placeholder="{{__('admin.enter name of time')}}" required :value="$ads->time" />
                        </div>


                        <div class="form-group col-6 mb-3">
                            <x-form.input name="visit" label="{{__('admin.visit')}}" type="number
                            " placeholder="{{__('admin.enter name of visit')}}" required :value="$ads->visit" />
                        </div>



                        <div class="mb-4 col-md-6">
                            <label for="ad_place_id" class="form-label">{{__('admin. Ad Place')}}</label>
                            <select id="ad_place_id" name="ad_place_id" class="form-control">
                                <option value="" disabled selected>{{__('admin.Choose')}}</option>
                                @foreach ($adplases as $adplase)
                                <option value="{{$adplase->id}}" @selected($ads->ad_place_id == $adplase->id)>{{$adplase->name_en}}</option>
                                @endforeach
                            </select>
                        </div>




                        <!-- <div class="form-group col-6 mb-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control" />
                       
                        <img src="{{ asset('uploads/categories/' . $ads->image) }}" alt="Current Image" height="60">
                       
                    </div> -->


                    </div>