<x-dashboard-layout>
    @push('styles')
        <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        @can('view', 'App\Models\Publisher')
        <li class="breadcrumb-item"><a href="{{route('dashboard.publisher.index')}}">{{__('admin.Publisher')}}</a></li>
        @endcan
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Edit Publisher')}}</li>
    </x-slot:breadcrumb>
    <div class="col-span-12 xl:col-span-12">
        <div class="col-md-12">
            <div class="card">
                @can('edit', 'App\Models\Publisher')
                <div class="card-header">
                    <h5>{{__('admin.Edit Publisher')}}</h5>
                </div>
                 @endcan
                 @can('edit', 'App\Models\Publisher')
                <div class="card-body">
                    <form action="{{route('dashboard.publisher.update',$publishers->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('dashboard.publishers._form')
                        <div class="row justify-content-end mt-3">
                            <a href="{{route('dashboard.publisher.index')}}" class="btn btn-secondary col-1 mr-3">
                                {{__('admin.Back')}}
                            </a>
                            <button type="submit" class="btn btn-primary col-1  mr-3">
                                {{__('admin.Update')}}
                            </button>
                        </div>
                    </form>
                </div>
                @endcan
            </div>
        </div>
    </div>




    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.
                      min.js" referrerpolicy="origin"></script>

        <script>
            tinymce.init({
                selector: '#mytextarea'
            });
        </script>
        @endpush

    </x-dashboard-layout>