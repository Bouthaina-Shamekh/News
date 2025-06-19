<x-dashboard-layout>
    @push('styles')
    <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        @can('view', 'App\Models\Status')
        <li class="breadcrumb-item"><a href="{{route('dashboard.status.index')}}">{{__('admin.Status')}}</a></li>
        @endcan
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Add Status')}}</li>
        </x-slot:breadcrumb>
        <div class="col-span-12 xl:col-span-12">
            <div class="col-md-12">
                <div class="card">
                @can('create', 'App\Models\Status')
                    <div class="card-header">
                        <h5>{{__('admin.Add Status')}}</h5>
                    </div>
                    @endcan 
                    @can('create', 'App\Models\Status')
                    <div class="card-body">
                        <form action="{{route('dashboard.status.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('dashboard.status._form')
                            <div class="col-span-12 text-left">
                                <a href="{{route('dashboard.status.index')}}" class="btn btn-secondary">
                                    {{__('admin.Back')}}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{$btn_label ?? __('admin.Add')}}
                                </button>
                            </div>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
        </div>

</x-dashboard-layout>