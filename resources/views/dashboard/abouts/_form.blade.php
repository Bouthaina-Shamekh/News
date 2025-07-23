<div class="row">

    <div class="form-group col-6 mb-3">
        <label for="about_ar" class="form-label">{{ __('admin.about_ar') }}<span style="color: red">*</span></label>
        <textarea name="about_ar" id="mytextarea" rows="3" class="form-control" required>{{ $abouts->about_ar }}</textarea>
    </div>

    <div class="form-group col-6 mb-3">
        <label for="about_en" class="form-label">{{ __('admin.about_en') }}<span style="color: red">*</span></label>
        <textarea name="about_en" id="mytextarea" rows="3" class="form-control" required>{{ $abouts->about_en }}</textarea>
    </div>


    <div class="form-group col-6 mb-3">
        <label for="objective_ar" class="form-label">{{ __('admin.objective_ar') }}<span
                style="color: red">*</span></label>
        <textarea name="objective_ar" id="mytextarea" rows="3" class="form-control" required>{{ $abouts->objective_ar }}</textarea>
    </div>


    <div class="form-group col-6 mb-3">
        <label for="objective_en" class="form-label">{{ __('admin.objective_en') }}<span
                style="color: red">*</span></label>
        <textarea name="objective_en" id="mytextarea" rows="3" class="form-control" required>{{ $abouts->objective_en }}</textarea>
    </div>

    <div class="form-group col-6 mb-3">
        <label for="mission_ar" class="form-label">{{ __('admin.mission_ar') }}<span style="color: red">*</span></label>
        <textarea name="mission_ar" id="mytextarea" rows="3" class="form-control" required>{{ $abouts->mission_ar }}</textarea>
    </div>

    <div class="form-group col-6 mb-3">
        <label for="mission_en" class="form-label">{{ __('admin.mission_en') }}<span
                style="color: red">*</span></label>
        <textarea name="mission_en" id="mytextarea" rows="3" class="form-control" required>{{ $abouts->mission_en }}</textarea>
    </div>

    <div class="form-group col-6 mb-3">
        <label for="vission_ar" class="form-label">{{ __('admin.vission_ar') }}<span
                style="color: red">*</span></label>
        <textarea name="vission_ar" id="mytextarea" rows="3" class="form-control" required>{{ $abouts->vission_ar }}</textarea>
    </div>

    <div class="form-group col-6 mb-3">
        <label for="vission_en" class="form-label">{{ __('admin.vission_en') }}<span
                style="color: red">*</span></label>
        <textarea name="vission_en" id="mytextarea" rows="3" class="form-control" required>{{ $abouts->vission_en }}</textarea>
    </div>

    <div class="form-group col-6 mb-3">
        <label for="goal_ar" class="form-label">{{ __('admin.goal_ar') }}<span style="color: red">*</span></label>
        <textarea name="goal_ar" id="mytextarea" rows="3" class="form-control" required>{{ $abouts->goal_ar }}</textarea>
    </div>

    <div class="form-group col-6 mb-3">
        <label for="goal_en" class="form-label">{{ __('admin.goal_en') }}<span style="color: red">*</span></label>
        <textarea name="goal_en" id="mytextarea" rows="3" class="form-control" required>{{ $abouts->goal_en }}</textarea>
    </div>




    <div class="form-group col-6 mb-3">
        <label for="image">{{ __('admin.Image') }}</label>
        <input type="file" name="image" class="form-control" />
        <span class="text-muted">{{ __('admin.Size Image') }}: 16:9, 1:1</span>
        <div class="d-flex align-items-center justify-content-between mt-3" id="imgAbout">
            <img src="{{ asset('storage/' . $abouts->image) }}" alt="Current Image" width="60">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('imgAbout')"><i class="fa fa-trash"></i></button>
        </div>

    </div>
</div>
@push('scripts')
    <script>
        const id = "{{ $abouts->id }}";
        $.ajax({
            url: `{{ route('dashboard.about.removeImage', ':id') }}`.replace(':id', id),
            type: 'POST',
            data: {
                name: name,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $(`#${name}`).remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    </script>
@endpush
