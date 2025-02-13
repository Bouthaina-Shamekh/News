<x-dashboard-layout>
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('Profile')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{__('Your Profile')}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('dashboard.users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-6 mb-3">
                                <x-form.input name="name" label="{{__('Name')}}" placeholder="{{__('Enter Name')}}" required :value="$user->name" />
                            </div>
                            <div class="form-group col-6 mb-3">
                                <x-form.input type="email" name="email" label="{{__('Email')}}" placeholder="{{__('Enter Email')}}" required :value="$user->email" />
                            </div>
                            <div class="form-group p-3 col-6">
                                <x-form.input type="password" label="{{__('Password')}}" name="password" placeholder="****"  />
                            </div>
                            <div class="form-group p-3 col-6">
                                <x-form.input type="password" label="{{__('Confirm Password')}}"  name="confirm_password" placeholder="****"/>
                            </div>
                        </div>
                        <div class="row justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary col-1  mr-3">
                                {{__('Update')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-dashboard-layout>
