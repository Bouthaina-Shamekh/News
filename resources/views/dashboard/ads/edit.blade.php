<x-dashboard-layout>
    @push('styles')
        <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        @can('view', 'App\Models\Ad')
        <li class="breadcrumb-item"><a href="{{route('dashboard.category.index')}}">{{__('admin.Ad')}}</a></li>
        @endcan
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Edit Ad')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">
                @can('edit', 'App\Models\Ad')
                <div class="card-header">
                    <h5>{{__('admin.Edit Ad')}}</h5>
                </div>
                 @endcan
                 @can('edit', 'App\Models\Ad')
                <div class="card-body">
                    <form action="{{route('dashboard.ad.update',$ads->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.ads._form')
                        <div class="row justify-content-end mt-3">
                            <a href="{{route('dashboard.ad.index')}}" class="btn btn-secondary col-md-1 col-sm-3 mr-3">
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