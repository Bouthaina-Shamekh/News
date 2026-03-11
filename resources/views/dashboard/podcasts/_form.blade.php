@php
$name = 'name_' . app()->getLocale();
@endphp

<div class="row">

<div class="form-group col-6 mb-3">
<x-form.input name="title_ar"
label="{{ __('admin.Title_AR') }}"
type="text"
required
:value="$podcasts->title_ar"/>
</div>

<div class="form-group col-6 mb-3">
<x-form.input name="title_en"
label="{{ __('admin.Title_EN') }}"
type="text"
required
:value="$podcasts->title_en"/>
</div>

<div class="form-group col-12 mb-3">
<label>{{ __('admin.Text_AR') }}</label>

<textarea name="text_ar"
class="form-control mytextarea">

{{ $podcasts->text_ar }}

</textarea>

</div>

<div class="form-group col-12 mb-3">
<label>{{ __('admin.Text_EN') }}</label>

<textarea name="text_en"
class="form-control mytextarea">

{{ $podcasts->text_en }}

</textarea>

</div>

<div class="form-group col-6 mb-3">

<label>{{__('admin.Categories')}}</label>

<select name="category_id"
class="form-control"
required>

<option value="">{{__('admin.Choose')}}</option>

@foreach($categories as $category)

<option value="{{ $category->id }}"
@selected($podcasts->category_id == $category->id)>

{{ $category->$name }}

</option>

@endforeach

</select>

</div>

<div class="form-group col-6 mb-3">

<label>{{__('admin.Image View')}}</label>

<input type="file"
name="img_view"
class="form-control">

@if($podcasts->img_view)

<img src="{{ asset('storage/'.$podcasts->img_view) }}"
width="80">

@endif

</div>

</div>

<hr>

<h5 class="mb-3">
{{__('admin.Podcast Episodes')}}
</h5>

<div id="episodes-wrapper">

@if(isset($episodes))

@foreach($episodes as $episode)

<div class="card mb-3">

<div class="card-body">

<div class="row">

<div class="col-6 mb-3">

<input type="text"
name="episodes[title_ar][]"
class="form-control"
value="{{ $episode->title_ar }}"
placeholder="Title AR">

</div>

<div class="col-6 mb-3">

<input type="text"
name="episodes[title_en][]"
class="form-control"
value="{{ $episode->title_en }}"
placeholder="Title EN">

</div>

<div class="col-4 mb-3">

<input type="date"
name="episodes[date][]"
class="form-control"
value="{{ $episode->date }}">

</div>

<div class="col-4 mb-3">

<input type="text"
name="episodes[time][]"
class="form-control"
value="{{ $episode->time }}"
placeholder="Duration">

</div>

<div class="col-4 mb-3">

<select name="episodes[type][]"
class="form-control">

<option value="audio"
@selected($episode->type=='audio')>
Audio
</option>

<option value="video"
@selected($episode->type=='video')>
Video
</option>

</select>

</div>

<div class="col-6 mb-3">

<input type="file"
name="episodes[audio][]"
class="form-control">

</div>

<div class="col-6 mb-3">

<input type="file"
name="episodes[vedio][]"
class="form-control">

</div>

</div>

</div>

</div>

@endforeach

@endif

</div>

<button type="button"
class="btn btn-success"
id="addEpisode">

+ {{__('admin.Add Episode')}}

</button>


@push('scripts')

<script>

$('#addEpisode').click(function(){

$('#episodes-wrapper').append(`

<div class="card mb-3">

<div class="card-body">

<div class="row">

<div class="col-6 mb-3">
<input type="text"
name="episodes[title_ar][]"
class="form-control"
placeholder="Title AR">
</div>

<div class="col-6 mb-3">
<input type="text"
name="episodes[title_en][]"
class="form-control"
placeholder="Title EN">
</div>

<div class="col-4 mb-3">
<input type="date"
name="episodes[date][]"
class="form-control">
</div>

<div class="col-4 mb-3">
<input type="text"
name="episodes[time][]"
class="form-control"
placeholder="Duration">
</div>

<div class="col-4 mb-3">

<select name="episodes[type][]"
class="form-control">

<option value="audio">Audio</option>
<option value="video">Video</option>

</select>

</div>

<div class="col-6 mb-3">
<input type="file"
name="episodes[audio][]"
class="form-control">
</div>

<div class="col-6 mb-3">
<input type="file"
name="episodes[vedio][]"
class="form-control">
</div>

</div>

</div>

</div>

`);

});

</script>

@endpush