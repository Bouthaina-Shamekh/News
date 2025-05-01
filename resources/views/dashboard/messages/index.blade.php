<x-dashboard-layout>
@php
        $name = 'name_' . app()->getLocale();
        $title = 'title_' . app()->getLocale();
    @endphp
    <style>
        .title {
            width: 350px;
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            transition: width 0.5s;
        }
        .title:hover {
            width: 350px;
            overflow: visible;
            white-space: normal;
            text-overflow: clip;
        }
    </style>

    <x-slot:breadcrumbs>
        <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a></li>
        <li class="breadcrumb-item" aria-current="page">{{__('admin.Messages')}}</li>
    </x-slot:breadcrumb>



<!-- Both borders table start -->
<div class="col-span-12">
    <div class="card table-card">
    @can('create', 'App\Models\Message')
        <div class="card-header">
            <div class="sm:flex items-center justify-between">
                <h5 class="mb-3 sm:mb-0">{{__('admin.Messages')}}</h5>
            </div>
        </div>
        @endcan

        @can('view', 'App\Models\Message')
        <div class="card-body pt-3">
            <div class="table-responsive" style="margin: 0 15px;">
                <table class="table table-hover table-bordered" id="pc-dt-simple">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('admin.Sender Name')}}</th>
                        <th>{{__('admin.Email')}}</th>
                        <th>{{__('admin.Subject')}}</th>
                        <th>{{__('admin.Text')}}</th>
                        <th>{{__('admin.Date')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$message->fristname . ' ' . $message->lastname}}</td>
                                <td>{{$message->email}}</td>
                                <td>{{$message->subject}}</td>
                                <td class="title">{{$message->msg}}</td>
                                <td>{{$message->addDate}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $messages->links() }}
            </div>
        </div>
        @endcan
    </div>
</div>

<!-- Both borders table end -->



</x-dashboard-layout>
