<x-dashboard-layout>
    @push('styles')
    <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        @can('view', 'App\Models\Artical')
        <li class="breadcrumb-item"><a href="{{route('dashboard.articale.index')}}">{{__('admin.Articals')}}</a></li>
        @endcan
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Add Articals')}}</li>
        </x-slot:breadcrumb>
        <div class="col-span-12 xl:col-span-12">
            <div class="col-md-12">
                <div class="card">
                    {{-- @can('add new') --}}
                    <div class="card-header">
                        <h5>{{__('admin.Add Articals')}}</h5>
                    </div>
                    {{-- @endcan --}}
                    @can('create', 'App\\Models\Artical')
                    <div class="card-body">
                        <form action="{{route('dashboard.articale.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('dashboard.articales._form')
                            <div class="row justify-content-end mt-3">
                                <a href="{{route('dashboard.articale.index')}}" class="btn btn-secondary col-1 mr-3">
                                    {{__('admin.Back')}}
                                </a>
                                <button type="submit" class="btn btn-primary col-1  mr-3">
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