<x-dashboard-layout>

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Ad Place')}}</li>
    </x-slot:breadcrumb>



<!-- Both borders table start -->
<div class="col-span-12">
    <div class="card table-card">
    @can('create', 'App\\Models\AdPlace')
        <div class="card-header">
            <div class="sm:flex items-center justify-between">
                <h5 class="mb-3 sm:mb-0">{{__('admin.Ad Place')}}</h5>
                <div>
                    <a href="{{route('dashboard.adplace.create')}}" class="btn btn-primary" >
                        {{__('admin.Create Adplace')}}
                    </a>
                </div>
            </div>
        </div>
        @endcan
        @can('view', 'App\\Models\AdPlace')
        <div class="card-body pt-3">
            <div class="table-responsive" style="margin: 0 15px;">
                <table class="table table-hover table-bordered" id="pc-dt-simple">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('admin.Name_AR')}}</th>
                        <th>{{__('admin.Name_EN')}}</th>

                        <th>{{__('admin.Actions')}}</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($adplaces as $adplace )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$adplace->name_ar}}</td>
                                <td>{{$adplace->name_en}}</td>

                                <td>
                                    <a href="{{route('dashboard.adplace.edit',$adplace->id)}}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                        <i class="ti ti-edit text-xl leading-none"></i>
                                    </a>
                                    <form action="{{route('dashboard.adplace.destroy',$adplace->id)}}" method="post" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="" title="{{__('Delete')}}">
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


@push('scripts')
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            const confirmMessage = @json(__('admin.confirm_delete'));
            if (!confirm(confirmMessage)) {
                e.preventDefault();
            }
        });
    });
</script>

    @endpush

</x-dashboard-layout>
