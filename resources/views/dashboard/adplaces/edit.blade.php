<x-dashboard-layout>
    @push('styles')
        <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        @can('view', 'App\Models\AdPlace')
        <li class="breadcrumb-item"><a href="{{route('dashboard.adplace.index')}}">{{__('admin.AdPlace')}}</a></li>
        @endcan
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Edit AdPlace')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">
                @can('edit', 'App\Models\AdPlace')
                <div class="card-header">
                    <h5>{{__('admin.Edit AdPlace')}}</h5>
                </div>
                 @endcan
                 @can('edit', 'App\Models\AdPlace')
                <div class="card-body">
                    <form action="{{route('dashboard.adplace.update',$adplaces->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.adplaces._form')
                        <div class="row justify-content-end mt-3">
                            <a href="{{route('dashboard.adplace.index')}}" class="btn btn-secondary col-md-1 col-sm-3 mr-3">
                                {{__('admin.Back')}}
                            </a>
                            <button type="submit" class="btn btn-primary col-md-1 col-sm-3  mr-3">
                                {{__('admin.Update')}}
                            </button>
                        </div>
                    </form>
                </div>
                @endcan
            </div>
        </div>
    </div>

    </x-dashboard-layout>