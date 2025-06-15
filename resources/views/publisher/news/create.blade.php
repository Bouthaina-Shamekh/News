<x-publisher-layout>
    @push('styles')
    <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('dashboard.nw.index')}}">{{__('admin.News')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Add News')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{__('admin.Add News')}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('publisher.nw.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('publisher.news._form')
                        <div class="col-span-12 text-right">
                            <a href="{{route('publisher.nw.index')}}" class="btn btn-secondary">
                                {{__('admin.Back')}}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{$btn_label ?? __('admin.Add')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-publisher-layout>