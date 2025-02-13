<x-dashboard-layout>
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Users')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12">
    <div class="card">
        <div class="card-header">
            <div class="sm:flex items-center justify-between">
                <h5 class="mb-3 mb-sm-0">{{__('admin.Users List')}}</h5>
                <div>
                    <a href="{{route('dashboard.users.create')}}" class="btn btn-primary">
                        {{__('admin.Add User')}}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive dt-responsive">
                <table class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('admin.Name')}}</th>
                            <th>{{__('admin.Email')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <div class="flex items-center w-44">
                                    {{-- <div class="shrink-0">
                                        <img src="{{ $user->image_url }}" alt="user image" class="rounded-full w-10" />
                                    </div> --}}
                                    <div class="grow ltr:ml-3 rtl:mr-3">
                                        <h6 class="mb-0">{{$user->name}}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{$user->email}}</td>
                            <td  class="d-flex">
                                <a href="{{route('dashboard.users.edit',$user->id)}}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                    <i class="ti ti-edit text-xl leading-none"></i>
                                </a>
                                <form action="{{route('dashboard.users.destroy',$user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary" title="{{__('Delete')}}">
                                        <i class="ti ti-trash text-xl leading-none"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{$users->links()}}
            </div>
        </div>
    </div>
    </div>

</x-dashboard-layout>
