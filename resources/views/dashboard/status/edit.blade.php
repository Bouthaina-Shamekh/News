<x-dashboard-layout>
    @push('styles')
        <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        @can('view', 'App\Models\Statu')
        <li class="breadcrumb-item"><a href="{{route('dashboard.status.index')}}">{{__('admin.Status')}}</a></li>
        @endcan
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Edit Status')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">
                @can('edit', 'App\Models\Statu')
                <div class="card-header">
                    <h5>{{__('admin.Edit Status')}}</h5>
                </div>
                 @endcan
                 @can('edit', 'App\Models\Statu')
                <div class="card-body">
                    <form action="{{route('dashboard.status.update',$status->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.status._form')
                        <div class="col-span-12 text-left">
                            <a href="{{route('dashboard.status.index')}}" class="btn btn-secondary">
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