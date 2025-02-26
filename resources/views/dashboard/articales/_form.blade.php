                    <div class="row">

                        <div class="form-group col-6 mb-3">
                            <x-form.input name="title_ar" label="{{__('admin.Title_AR')}}" type="text" placeholder="{{__('admin.enter artical of title')}}" required :value="$articals->title_ar" />
                        </div>


                        <div class="form-group col-6 mb-3">
                            <x-form.input name="title_en" label="{{__('admin.Title_EN')}}" type="text" placeholder="{{__('admin.enter artical of title')}}" required :value="$articals->title_en" />
                        </div>



                        <div class="form-group col-6 mb-3">
                            <x-form.input name="date" label="{{__('admin.Date')}}" type="date" placeholder="{{__('admin.enter artical of date')}}" required :value="$articals->date" />
                        </div>

                        <!-- <div class="form-group col-6 mb-3">
                            <x-form.input name="place" label="{{__('admin.Place')}}" type="string" placeholder="{{__('admin.enter artical of place')}}" required :value="$articals->place" />
                        </div> -->

                        <div class="form-group col-6 mb-3">
                                <label for="place" class="form-label">{{__('admin.place')}}</label>
                                <select name="place" id="place" class="form-control">
                                    <option value="documentary">{{__('admin.documentary')}}</option>
                                    <option value="war">{{__('admin.war')}}</option>
                                    <option value="peace">{{__('admin.peace')}}</option>
                                </select>
                            </div>


                        <div class="form-group col-6 mb-3">
                            <label for="text_ar" class="form-label">{{__('admin.Text_AR')}}</label>
                            <textarea name="text_ar" id="mytextarea" rows="3" class="form-control" required>{{$articals->text_ar}}</textarea>
                        </div>


                        <div class="form-group col-6 mb-3">
                            <label for="text_en" class="form-label">{{__('admin.Text_EN')}}</label>
                            <textarea name="text_en" id="mytextarea" rows="3" class="form-control" required>{{$articals->text_en}}</textarea>
                        </div>


                       


                        <!-- <div class="form-group col-6 mb-3">
                            <x-form.input name="visit" label="{{__('admin.Visit')}}" type="number" placeholder="{{__('admin.enter artical')}}" required :value="$articals->visit" />
                        </div> -->

                        <input type="hidden" name="visit" value="{{$articals->visit }}">


                        <div class="form-group col-6 mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="img_view" class="form-control" />

                            <img src="{{ asset('storage/' . $articals->img_view) }}" alt="Current Image" width="50">

                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="img_article" class="form-control" />
                            <img src="{{ asset('storage/' . $articals->img_article) }}" alt="Current Image" width="50">
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="image">Vedio</label>
                            <input type="file" name="vedio" class="form-control" />
                            {{-- < src="{{ asset('storage/' . $articals->vedio) }}" alt="Current video" width="50"> --}}
                            <video src="{{ asset('storage/' . $articals->vedio) }}" width="320" height="240" controls="controls">
                            </video>
                        </div>


                        <div class="form-group col-6 mb-3">
                            <label for="statu_id" class="form-label">{{__('admin.Status')}}</label>
                            <select id="statu_id" name="statu_id" class="form-control">
                                <option value="" disabled selected>{{__('admin.Choose')}}</option>
                                @foreach ($status as $statu)
                                    <option value="{{$statu->id}}" @selected( $articals->statu_id == $statu->id)>{{$statu->name_en}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-6 mb-3">
                        <label for="category_id" class="form-label">{{__('admin.Categories')}}</label>
                        <select id="category_id" name="category_id" class="form-control">
                            <option value="" disabled selected>{{__('admin.Choose')}}</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" @selected( $articals->category_id ==$category->id)>{{$category->name_en}}</option>
                            @endforeach
                        </select>
                    </div>


                        
                    


                    <div class="form-group col-6 mb-3">
                        <label for="publisher_id" class="form-label">{{__('admin.Publisher')}}</label>
                        <select id="publisher_id" name="publisher_id" class="form-control">
                            <option value="" disabled selected>{{__('admin.Choose')}}</option>
                            @foreach ($publishers as  $publisher)
                            <option value="{{$publisher->id}}" @selected( $articals->publisher_id == $publisher->id)>{{$publisher->name}}</option>
                            @endforeach
                        </select>
                    </div>


                        


                    </div>