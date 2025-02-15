<x-dashboard-layout>

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('Hero NewPlace')}}</li>
    </x-slot:breadcrumb>



<!-- Both borders table start -->
<div class="col-span-12">
    <div class="card table-card">
        <div class="card-header">
            <div class="sm:flex items-center justify-between">
                <h5 class="mb-3 sm:mb-0">{{__('admin.NewPlace')}}</h5>
                @can('create', 'App\Models\NewPlace')
                <div>
                    <a href="{{route('dashboard.newplace.create')}}" class="btn btn-primary" >
                        {{__('admin.Add NewPlace')}}
                    </a>
                </div>
                @endcan
            </div>
        </div>
        @can('view', 'App\Models\NewPlace')
        <div class="card-body pt-3">
            <div class="table-responsive" style="margin: 0 15px;">
                <table class="table table-hover table-bordered" id="pc-dt-simple">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('admin.Name_AR')}}</th>
                        <th>{{__('admin.Name_EN')}}</th>
                       
                        <th>{{__('Action')}}</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($newplaces as $newplace )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                               

                                <td>{{$newplace->name_ar}}</td>
                                <td>{{$newplace->name_en}}</td>
                                
                               

                                <td>
                                    <a href="{{route('dashboard.newplace.edit',$newplace->id)}}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                        <i class="ti ti-edit text-xl leading-none"></i>
                                    </a>
                                    <form action="{{route('dashboard.newplace.destroy',$newplace->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary" title="{{__('Delete')}}">
                                            <i class="ti ti-trash text-xl leading-none"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endcan
    </div>
</div>

<!-- Both borders table end -->



</x-dashboard-layout>
