<x-dashboard-layout>
    @push('styles')
    <link rel="stylesheet" href="{{asset('assets-dashboard/css/media.css')}}">


    @endpush
    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        @can('view', 'App\Models\About')
        <li class="breadcrumb-item"><a href="{{route('dashboard.about.index')}}">{{__('admin.About')}}</a></li>
        @endcan
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Add About')}}</li>
        </x-slot:breadcrumb>
        <div class="col-span-12 xl:col-span-12">
            <div class="col-md-12">
                <div class="card">
                @can('create', 'App\Models\About')
                    <div class="card-header">
                        <h5>{{__('admin.Add About')}}</h5>
                    </div>
                   @endcan 
                    @can('create', 'App\Models\About')
                    <div class="card-body">
                        <form action="{{route('dashboard.about.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('dashboard.abouts._form')
                            <div class="row justify-content-end mt-3">
                                <a href="{{route('dashboard.about.index')}}" class="btn btn-secondary col-md-1 col-sm-3 mr-3">
                                    {{__('admin.Back')}}
                                </a>

                               <button type="submit" class="btn btn-primary col-md-1 col-sm-3  mr-3">
                                    {{$btn_label ?? __('admin.Add')}}
                                </button>
                            </div>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
        </div>

        @push('scripts')
    <!-- Include jQuery first -->

  
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.
min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
      selector: '#mytextarea'
    });
  </script> -->
    @endpush
</x-dashboard-layout>