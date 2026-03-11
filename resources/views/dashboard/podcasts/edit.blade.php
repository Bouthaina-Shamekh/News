<x-dashboard-layout>

<x-slot:breadcrumbs>

<li class="breadcrumb-item">
<a href="{{route('dashboard.home')}}">{{__('admin.Home')}}</a>
</li>

<li class="breadcrumb-item">
<a href="{{route('dashboard.podcast.index')}}">
{{__('admin.Podcasts')}}
</a>
</li>

<li class="breadcrumb-item">
{{__('admin.Edit Podcast')}}
</li>

</x-slot:breadcrumb>

<div class="col-span-12">

<div class="card">

@can('edit','App\Models\Podcast')

<div class="card-header">

<h5>{{__('admin.Edit Podcast')}}</h5>

</div>

<div class="card-body">

<form action="{{route('dashboard.podcast.update',$podcasts->id)}}"
method="post"
enctype="multipart/form-data">

@csrf
@method('PUT')

@include('dashboard.podcasts._form')

<div class="col-span-12 text-left">

<a href="{{route('dashboard.podcast.index')}}"
class="btn btn-secondary">

{{__('admin.Back')}}

</a>

<button type="submit"
class="btn btn-primary">

{{__('admin.Update')}}

</button>

</div>

</form>

</div>

@endcan

</div>

</div>

</x-dashboard-layout>