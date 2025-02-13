<div class="row">

                     <div class="form-group col-6 mb-3">
                            <label for="about_ar" class="form-label">{{__('admin.about_ar')}}</label>
                            <textarea name="about_ar" id="mytextarea" rows="3" class="form-control" required>{{$abouts->about_ar}}</textarea>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="about_en" class="form-label">{{__('admin.about_en')}}</label>
                            <textarea name="about_en" id="mytextarea" rows="3" class="form-control" required>{{$abouts->about_en}}</textarea>
                        </div>


                        <div class="form-group col-6 mb-3">
                            <label for="objective_ar" class="form-label">{{__('admin.objective_ar')}}</label>
                            <textarea name="objective_ar" id="mytextarea" rows="3" class="form-control" required>{{$abouts->objective_ar}}</textarea>
                        </div>


                        <div class="form-group col-6 mb-3">
                            <label for="objective_en" class="form-label">{{__('admin.objective_en')}}</label>
                            <textarea name="objective_en" id="mytextarea" rows="3" class="form-control" required>{{$abouts->objective_en}}</textarea>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="mission_ar" class="form-label">{{__('admin.mission_ar')}}</label>
                            <textarea name="mission_ar" id="mytextarea" rows="3" class="form-control" required>{{$abouts->mission_ar}}</textarea>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="mission_en" class="form-label">{{__('admin.mission_en')}}</label>
                            <textarea name="mission_en" id="mytextarea" rows="3" class="form-control" required>{{$abouts->mission_en}}</textarea>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="vission_ar" class="form-label">{{__('admin.vission_ar')}}</label>
                            <textarea name="vission_ar" id="mytextarea" rows="3" class="form-control" required>{{$abouts->vission_ar}}</textarea>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="vission_en" class="form-label">{{__('admin.vission_en')}}</label>
                            <textarea name="vission_en" id="mytextarea" rows="3" class="form-control" required>{{$abouts->vission_en}}</textarea>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="goal_ar" class="form-label">{{__('admin.goal_ar')}}</label>
                            <textarea name="goal_ar" id="mytextarea" rows="3" class="form-control" required>{{$abouts->goal_ar}}</textarea>
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="goal_en" class="form-label">{{__('admin.goal_en')}}</label>
                            <textarea name="goal_en" id="mytextarea" rows="3" class="form-control" required>{{$abouts->goal_en}}</textarea>
                        </div>




<div class="form-group col-6 mb-3">
<label for="image">Image</label>
<input type="file" name="image" class="form-control" />

<img src="{{ asset('uploads/about/' . $abouts->image) }}" alt="Current Image" height="60">

</div>


</div>