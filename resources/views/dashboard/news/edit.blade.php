<x-dashboard-layout>
    @push('styles')
        <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        @can('view', 'App\Models\Nw')
        <li class="breadcrumb-item"><a href="{{route('dashboard.nw.index')}}">{{__('admin.News')}}</a></li>
        @endcan
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Edit News')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">
                @can('edit', 'App\Models\Nw')
                <div class="card-header">
                    <h5>{{__('admin.Edit News')}}</h5>
                </div>
                 @endcan
                 @can('edit', 'App\Models\Nw')
                <div class="card-body">
                    <form action="{{route('dashboard.nw.update',$news->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.news._form')
                        <div class="col-span-12 text-left">
                            <a href="{{route('dashboard.nw.index')}}" class="btn btn-secondary">
                                {{__('admin.Back')}}
                            </a>
                            <button type="submit" class="btn btn-primary">
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
