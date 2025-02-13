                    <div class="row">

                        <div class="form-group col-6 mb-3">
                            <x-form.input name="title_ar" label="{{__('admin.Title_AR')}}" type="text" placeholder="{{__('admin.enter news of title')}}" required :value="$news->title_ar" />
                        </div>


                        <div class="form-group col-6 mb-3">
                            <x-form.input name="title_en" label="{{__('admin.Title_EN')}}" type="text" placeholder="{{__('admin.enter news of title')}}" required :value="$news->title_en" />
                        </div>



                        <div class="form-group col-6 mb-3">
                            <x-form.input name="date" label="{{__('admin.Date')}}" type="date" placeholder="{{__('admin.enter news of date')}}" required :value="$news->date" />
                        </div>


                        <div class="form-group col-6 mb-3">
                            <label for="text_ar" class="form-label">{{__('admin.Text_AR')}}</label>
                            <textarea name="text_ar" id="mytextarea" rows="3" class="form-control" required>{{$news->text_ar}}</textarea>
                        </div>


                        <div class="form-group col-6 mb-3">
                            <label for="text_en" class="form-label">{{__('admin.Text_EN')}}</label>
                            <textarea name="text_en" id="mytextarea" rows="3" class="form-control" required>{{$news->text_en}}</textarea>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <x-form.input name="keyword_ar" label="{{__('admin.Keyword_AR')}}" type="text" placeholder="{{__('admin.enter news of keyword')}}" required :value="$news->keyword_ar" />
                        </div>


                        <div class="form-group col-6 mb-3">
                            <x-form.input name="keyword_en" label="{{__('admin.Keyword_EN')}}" type="text" placeholder="{{__('admin.enter news of keyword')}}" required :value="$news->keyword_en" />
                        </div>


                        <div class="form-group col-6 mb-3">
                            <x-form.input name="visit" label="{{__('admin.Visit')}}" type="number" placeholder="{{__('admin.enter news')}}" required :value="$news->visit" />
                        </div>


                        <div class="form-group col-6 mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="img_view" class="form-control" />

                            <img src="{{ asset('storage/' . $news->img_view) }}" alt="Current Image" width="50">

                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="img_article" class="form-control" />

                            <img src="{{ asset('storage/' . $news->img_article) }}" alt="Current Image" width="50">

                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="image">Vedio</label>
                            <input type="file" name="vedio" class="form-control" />
                            <img src="{{ asset('storage/' . $news->vedio) }}" alt="Current video" height="60">
                            <video src="{{ asset('storage/' . $news->vedio)  }}" width="320" height="240" controls="controls"></video>
                        </div>


                        <div class="form-group col-6 mb-3">
                        <label for="statu_id" class="form-label">{{__('admin.Status')}}</label>
                        <select id="statu_id" name="statu_id" class="form-control">
                            <option value="" disabled selected>{{__('admin.Choose')}}</option>
                            @foreach ($status as $statu)
                                <option value="{{$statu->id}}" @selected( $news->statu_id == $statu->id)>{{$statu->name_en}}</option>
                            @endforeach
                        </select>
                    </div>


                        <div class="form-group col-6 mb-3">
                        <label for="category_id" class="form-label">{{__('admin.Categories')}}</label>
                        <select id="category_id" name="category_id" class="form-control">
                            <option value="" disabled selected>{{__('admin.Choose')}}</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}" @selected( $news->category_id ==$category->id)>{{$category->name_en}}</option>
                            @endforeach
                        </select>
                    </div>


                        <div class="form-group col-6 mb-3">
                        <label for="new_place_id" class="form-label">{{__('admin.NewPlace')}}</label>
                        <select id="new_place_id" name="new_place_id" class="form-control">
                            <option value="" disabled selected>{{__('admin.Choose')}}</option>
                            @foreach ($newplaces as  $newplace)
                            <option value="{{$newplace->id}}" @selected( $news->new_place_id == $newplace->id)>{{$newplace->name_en}}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group col-6 mb-3">
                        <label for="publisher_id" class="form-label">{{__('admin.Publisher')}}</label>
                        <select id="publisher_id" name="publisher_id" class="form-control">
                            <option value="" disabled selected>{{__('admin.Choose')}}</option>
                            @foreach ($publishers as  $publisher)
                            <option value="{{$publisher->id}}" @selected( $news->publisher_id == $publisher->id)>{{$publisher->name}}</option>
                            @endforeach
                        </select>
                    </div>


                        


                    </div>