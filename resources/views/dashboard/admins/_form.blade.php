<div class="row">
    <div class="form-group col-6 mb-3">
        <x-form.input name="name" label="{{__('Name')}}" placeholder="{{__('Enter Name')}}" required :value="$admin->name" />
    </div>
    <div class="form-group col-6 mb-3">
        <x-form.input type="email" name="email" label="{{__('Email')}}" placeholder="{{__('Enter Email')}}" required :value="$admin->email" />
    </div>
    <div class="form-group col-6 mb-3">
        <label for="password">{{__('Password')}}</label>
        <input type="password" name="password" label="{{__('Password')}}" placeholder="{{__('Enter Password')}}" class="form-control"  @required($admin->id == null)>
    </div>
    <div class="form-group col-6 mb-3">
        <label for="status" class="form-label">{{__('Status')}}</label>
        <select name="status" id="status" class="form-control">
            <option value="active" @selected($admin->status == 'active')>{{__('active')}}</option>
            <option value="archive" @selected($admin->status == 'archive')>{{__('archive')}}</option>
        </select>
    </div>
    <div class="form-group col-6">
        <x-form.input name="avatarFile" label="{{__('Avatar')}}" type="file" accept="image/*" />
        @if ($admin->avatar != null)
            <img src="{{$admin->avatar_url}}" alt="img...." width="100px" class="mt-3">
        @endif
    </div>

    {{-- <div class="col-span-12 md:col-span-4 mb-4">
        <label class="form-label" for="inputState">{{__('Role Name')}}</label>
        {!! Form::select('roles_name[]', $roles,[], array('class' => ['form-control','basic-multiple'],'multiple')) !!}
      </div> --}}

      <div class="col-span-12 md:col-span-4 mb-4">
        <label class="form-label" for="inputState">{{ __('Role Name') }}</label>
        <select id="roles_name" class="form-select basic-multiple" name="roles_name[]" multiple>
            @foreach ($roles as $role)
                <option value="{{$role}}" @selected($admin->roles->where('name',$role)->first() != null)>{{$role}}</option>
            @endforeach
        </select>
    </div>



</div>
<hr class="mt-3">
<div class="row justify-content-end mt-3">
    <a href="{{route('dashboard.admins.index')}}" class="btn btn-secondary col-1 mr-3">
        {{__('Back')}}
    </a>
    <button type="submit" class="btn btn-primary col-1  mr-3">
        {{$btn_label ?? __('Add')}}
    </button>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.basic-multiple').select2();
        });
    </script>
    @endpush
