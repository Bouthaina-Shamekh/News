<x-dashboard-layout>
@php
        $name = 'name_' . app()->getLocale();
        $title = 'title_' . app()->getLocale();
    @endphp

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('Ad')}}</li>
    </x-slot:breadcrumb>



<!-- Both borders table start -->
<div class="col-span-12">
    <div class="card table-card">
        <div class="card-header">
            <div class="sm:flex items-center justify-between">
                <h5 class="mb-3 sm:mb-0">{{__('Ad')}}</h5>
                <div>
                    <a href="{{route('dashboard.ad.create')}}" class="btn btn-primary" >
                        {{__('Add Ad')}}
                    </a>
                </div>
            </div>
        </div>
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
                        <th>{{__('Action')}}</th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($ads as $ad )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
            @if ( $ad->image)
                <img src="{{ asset('storage/' . $ad->image) }}" width="100" height="200" alt="Image">
            @else
                {{ __('No Image') }}
            @endif
        </td>
                                <td>{{$ad->title}}</td>
                                <td>{{$ad->owner}}</td>
                                <td>{{$ad->owner_phone}}</td>
                                <td>{{$ad->adplace->name_en}}</td>
                                <td>{{$ad->url}}</td>
                              
                                
                                <!-- <td><img width="30" src="{{ asset('uploads/categories/'.$ad->image) }}" alt=""></td> -->

                                <td>
                                    <a href="{{route('dashboard.ad.edit',$ad->id)}}" class="w-8 h-8 rounded-xl inline-flex items-center justify-center btn-link-secondary">
                                        <i class="ti ti-edit text-xl leading-none"></i>
                                    </a>
                                    <form action="{{route('dashboard.ad.destroy',$ad->id)}}" method="post">
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
    </div>
</div>

<!-- Both borders table end -->



</x-dashboard-layout>
