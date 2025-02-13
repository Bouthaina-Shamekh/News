<x-dashboard-layout>
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('Admins')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12">
    <div class="card">
        <div class="card-header">
            <div class="sm:flex items-center justify-between">
                <h5 class="mb-3 mb-sm-0">{{__('Admins List')}}</h5>
                <div>
                    <a href="{{route('dashboard.admins.create')}}" class="btn btn-primary">
                        {{__('Add Admin')}}
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
                            <th  class="text-center">{{__('Active')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Last Activity')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            @if ($admin->last_activity >= now()->subMinutes(5))
                                <td class="text-center">
                                    <i class="fas fa-circle text-success bg-success rounded-circle"></i>
                                </td>
                            @else
                                <td class="text-center">
                                    <i class="far fa-circle"></i>
                                </td>
                            @endif
                            <td>
                                <div class="flex items-center w-44">
                                    <div class="shrink-0">
                                        <img src="{{ $admin->avatar_url }}" alt="admin image" class="rounded-full w-10" />
                                    </div>
                                    <div class="grow ltr:ml-3 rtl:mr-3">
                                        <h6 class="mb-0">{{$admin->name}}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>{{$admin->email}}</td>
                            <td>{{$admin->last_activity}}</td>
                            <td  class="d-flex">
                                <a href="{{route('dashboard.admins.edit',$admin->id)}}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                    <i class="ti ti-edit text-xl leading-none"></i>
                                </a>
                                <form action="{{route('dashboard.admins.destroy',$admin->id)}}" method="post">
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
        </div>
    </div>
    </div>

</x-dashboard-layout>
