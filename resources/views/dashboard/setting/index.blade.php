<x-dashboard-layout>
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ __('admin.Home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.setting.index') }}">{{ __('admin.Settings') }}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{ __('admin.Create Settings') }}</li>
        </x-slot:breadcrumb>
        <div class="col-span-12 xl:col-span-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('admin.Create Settings') }}</h5>
                        @if ($errors->any())
                        <div>
                            @foreach ($errors->all() as $err)
                            <div class="alert alert-danger" role="alert">
                                {{ $err }}
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="card-body">

                        @can('edit', 'App\Models\Setting')
                        <div class="card-body">


                            <form action="{{ route('dashboard.setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf




                                <div class="mb-4">
                                    <label class="form-label">{{ __('admin.Site_ar') }}<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" placeholder="site_ar" name="site_ar" value="{{ old('site_ar', $settings['site_ar'] ?? '') }}" />
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ __('admin.Site_en') }}<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" placeholder="site_en" name="site_en" value="{{ old('site_en', $settings['site_en'] ?? '') }}" />
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ __('instagram') }}</label>
                                    <input type="text" class="form-control" placeholder="instagram" name="instagram" value="{{ old('instagram', $settings['instagram'] ?? '') }}" />
                                </div>


                                <div class="mb-4">
                                    <label class="form-label">{{ __('Facebook') }}</label>
                                    <input type="text" class="form-control" placeholder="Facebook" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}" />
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ __('Youtube') }}</label>
                                    <input type="text" class="form-control" placeholder="youtube" name="youtube" value="{{ old('youtube', $settings['youtube'] ?? '') }}" />
                                </div>


                                <div class="mb-4">
                                    <label class="form-label">{{ __('admin.Phone') }}<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" placeholder="phone" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" />
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ __('admin.Contact Email') }}<span style="color: red">*</span></label>
                                    <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" />
                                </div>



                                <div div class="mb-4">
                                    <label class="form-label">{{ __('admin.Title_EN') }}<span style="color: red">*</span></label>
                                    <textarea id="mytextarea" rows="5" class="form-control" name="titel_en">{{ old('titel_en', $settings['titel_en'] ?? '') }}</textarea>
                                </div>

                                <div div class="mb-4">
                                    <label class="form-label">{{ __('admin.Title_AR') }}<span style="color: red">*</span></label>
                                    <textarea id="mytextarea" rows="5" class="form-control" name="titel_ar">{{ old('titel_ar', $settings['titel_ar'] ?? '') }}</textarea>
                                </div>



                                <div class="mb-4">
                                    <label class="form-label">{{ __('admin.about_en') }}<span style="color: red">*</span></label>
                                    <textarea id="mytextarea" name="about_en" rows="10">{{ old('about_en', $settings['about_en'] ?? '') }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ __('admin.about_ar') }}<span style="color: red">*</span></label>
                                    <textarea id="mytextarea" name="about_ar" rows="10">{{ old('about_ar', $settings['about_ar'] ?? '') }}</textarea>
                                </div>



                                <div class="mb-4">
                                    <label class="form-label">{{ __('admin.Logo') }}<span style="color: red">*</span></label>
                                    <input type="file" class="form-control" name="logo" />

                                    <?php
                                    $logos = App\Models\Setting::Where('key', 'logo')->first();
                                    ?>
                                    @if($logos)
                                    <div class="d-flex align-items-center justify-content-between mt-3" id="logo">
                                        <img src="{{ asset('uploads/logos/' . $logos->value) }}" alt="Current Image" width="50">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('logo')"><i class="fa fa-trash"></i></button>
                                    </div>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">{{ __('admin.Logo Icon') }}</label>
                                    <input type="file" class="form-control" name="logo_icon" />

                                    <?php
                                    $logo_icon = App\Models\Setting::Where('key', 'logo_icon')->first();
                                    ?>
                                    @if($logo_icon)
                                    <div class="d-flex align-items-center justify-content-between mt-3" id="logo_icon">
                                        <img src="{{ asset('uploads/logos/' . $logo_icon->value) }}" alt="Current Image" width="50">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeImage('logo_icon')"><i class="fa fa-trash"></i></button>
                                    </div>
                                    @endif
                                </div>


                                <button type="submit" class="btn btn-primary mb-4">{{ __('admin.Update') }}</button>
                            </form>

                        </div>
                        @endcan

                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js" referrerpolicy="origin"></script>

        <script>
            tinymce.init({
                selector: '#mytextarea'
            });

        </script>
        <script>
            function removeImage(name) {
                $.ajax({
                    url: `{{ route('dashboard.setting.removeImage') }}`,
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
            }
        </script>

        @endpush


</x-dashboard-layout>
