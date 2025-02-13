<x-dashboard-layout>
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('dashboard.admins.index')}}">{{__('Admins')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('Edit Admin')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{__('Edit Admin') . " : " . $admin->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('dashboard.admins.update',$admin->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.admins._form')
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-dashboard-layout>
