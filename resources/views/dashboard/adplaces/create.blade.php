<x-dashboard-layout>
    @push('styles')
    <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        @can('view', 'App\\Models\AdPlace')
        <li class="breadcrumb-item"><a href="{{route('dashboard.adplace.index')}}">{{__('admin.AdPlace')}}</a></li>
        @endcan
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Add AdPlace')}}</li>
        </x-slot:breadcrumb>
        <div class="col-span-12 xl:col-span-12">
            <div class="col-md-12">
                <div class="card">
                    {{-- @can('add adplace') --}}
                    <div class="card-header">
                        <h5>{{__('admin.Add AdPlace')}}</h5>
                    </div>
                    {{-- @endcan --}}
                    @can('create', 'App\\Models\AdPlace')
                    <div class="card-body">
                        <form action="{{route('dashboard.adplace.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('dashboard.adplaces._form')
                            <div class="row justify-content-end mt-3">
                                <a href="{{route('dashboard.adplace.index')}}" class="btn btn-secondary col-1 mr-3">
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