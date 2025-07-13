<x-publisher-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets-dashboard/css/media.css') }}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{ route('publisher.home') }}">{{ __('admin.Home') }}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{ __('admin.My_account') }}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('admin.My_account') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('publisher.profile.update') }}" method="post"
                        enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6 mb-3">
                                <x-form.input name="name" label="{{ __('admin.Name') }}" :re="true"
                                    type="text" placeholder="{{ __('admin.enter publisher name') }}" required
                                    :value="$publisher->name" />
                            </div>

                            <div class="form-group col-6 mb-3">
                                <x-form.input name="email" label="{{ __('admin.Email') }}" :re="true"
                                    type="email" placeholder="{{ __('admin.enter publisher email') }}" required
                                    :value="$publisher->email" />
                            </div>

                            <div class="form-group col-6 mb-3">
                                @if ($publisher->id == null)
                                    <x-form.input name="password" label="{{ __('admin.Password') }}"
                                        :re="true" type="password" autocomplete="new-password"
                                        placeholder="{{ __('admin.enter publisher password') }}" required />
                                @else
                                    <x-form.input name="password" label="{{ __('admin.Password') }}"
                                        type="password" autocomplete="new-password"
                                        placeholder="{{ __('admin.enter publisher password') }}" />
                                @endif
                            </div>

                            <div class="form-group col-6 mb-3">
                                <x-form.input name="phone" label="{{ __('admin.Phone') }}" :re="true"
                                    type="text" placeholder="{{ __('admin.enter publisher phone') }}" required
                                    :value="$publisher->phone" />
                            </div>

                            <div class="form-group col-6 mb-3">
                                <x-form.input name="birth_of_date" label="{{ __('admin.Birth of Date') }}"
                                    :re="true" type="date" placeholder="mm/dd/yyyy" required
                                    :value="$publisher->birth_of_date" />
                            </div>
                            <div class="form-group col-6 mb-3">
                                <x-form.input name="address" label="{{ __('admin.Address') }}" :re="true"
                                    type="text" placeholder="{{ __('admin.enter publisher address') }}" required
                                    :value="$publisher->address" />
                            </div>
                            <input type="hidden" name="visit" value="{{ $publisher->visit ?? 0 }}">
                            <div class="form-group col-6 mb-3">
                                <label for="image">{{ __('admin.Image') }}</label>
                                <input type="file" name="imageFile" class="form-control" />
                                <span class="text-muted">{{ __('admin.Size Image') }}: 1:1</span>
                                @if ($publisher->image)
                                    <img src="{{ asset('storage/' . $publisher->image) }}" alt="Current Image"
                                        width="60">
                                @endif
                            </div>
                            <div class="form-group col-6 mb-3">
                                <label for="attachments">{{ __('admin.Attachments') }}</label>
                                <input type="file" name="attachmentsFile" class="form-control" />
                                @if ($publisher->attachments)
                                    <img src="{{ asset('storage/' . $publisher->attachments) }}"
                                        alt="Current Attachment" height="60">
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="content_en" class="form-label">{{ __('admin.About') }}<span
                                    style="color: red">*</span></label>
                            <textarea name="about" id="mytextarea" rows="1" class="form-control" required>{{ $publisher->about }}</textarea>
                        </div>

                        <div class="col-span-12 text-left">
                            <button type="submit" class="btn btn-primary col-md-1 col-sm-3  mr-3">
                                {{ __('admin.Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-publisher-layout>
