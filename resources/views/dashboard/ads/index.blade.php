<x-dashboard-layout>
@php
        $name = 'name_' . app()->getLocale();
        $title = 'title_' . app()->getLocale();
    @endphp

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Ad')}}</li>
    </x-slot:breadcrumb>



<!-- Both borders table start -->
<div class="col-span-12">
    <div class="card table-card">
    @can('create', 'App\Models\Ad')
        <div class="card-header">
            <div class="sm:flex items-center justify-between">
                <h5 class="mb-3 sm:mb-0">{{__('admin.Ad')}}</h5>
                <div>
                    <a href="{{route('dashboard.ad.create')}}" class="btn btn-primary" >
                        {{__('admin.Add Ad')}}
                    </a>
                </div>
            </div>
        </div>
        @endcan

        @can('view', 'App\Models\Ad')
        <div class="card-body pt-3">
            <div class="table-responsive" style="margin: 0 15px;">
                <table class="table table-hover table-bordered" id="pc-dt-simple">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th></th>
                        <th>{{__('admin.Title')}}</th>
                        <th>{{__('admin.Owner')}}</th>
                        <th>{{__('admin.Owner Phone')}}</th>
                        <th>{{__('admin.Add Place')}}</th>
                        <th>{{__('admin.Url')}}</th>
                        <th>{{__('admin.From Date')}}</th>
                        <th>{{__('admin.To Date')}}</th>
                        <th>{{__('admin.Actions')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($ads as $ad )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if ($ad->image)
                                        <img src="{{ asset('storage/' . $ad->image) }}" width="100" alt="Non Image">
                                    @else
                                        {{ __('admin.No Image') }}
                                    @endif
                                </td>
                                <td>{{$ad->title}}</td>
                                <td>{{$ad->owner}}</td>
                                <td>{{$ad->owner_phone}}</td>
                                <td>{{$ad->adplace->name_en}}</td>
                                <td>{{$ad->url}}</td>
                                <td>{{$ad->date}}</td>
                                <td>{{$ad->end_date}}</td>
                                <td>
                                @can('edit', 'App\Models\Ad')
                                    <a href="{{route('dashboard.ad.edit',$ad->id)}}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                        <i class="ti ti-edit text-xl leading-none"></i>
                                    </a>
                                    @endcan
                                    <form action="{{route('dashboard.ad.destroy',$ad->id)}}" method="post" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary delete-form">
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
            {{$ads->links()}}
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
