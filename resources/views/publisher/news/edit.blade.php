<x-publisher-layout>
    @push('styles')
        <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('publisher.home')}}">{{__('admin.Home')}}</a></li>

        <li class="breadcrumb-item"><a href="{{route('publisher.nw.index')}}">{{__('admin.News')}}</a></li>

        <li class="breadcrumb-item" aria-current="page">{{__('admin.Edit News')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h5>{{__('admin.Edit News')}}</h5>
                </div>

                <div class="card-body">
                    <form action="{{route('publisher.nw.update',$news->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('publisher.news._form')
                        <div class="row justify-content-end mt-3">
                            <a href="{{route('publisher.nw.index')}}" class="btn btn-secondary col-1 mr-3">
                                {{__('admin.Back')}}
                            </a>
                            <button type="submit" class="btn btn-primary col-1  mr-3">
                                {{__('admin.Update')}}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    </x-publisher-layout>
