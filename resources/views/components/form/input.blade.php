@props([
    'type' => 'text',
    'value' => '',
    'name',
    'label'=>'',
    're' => false
])
@if ($label)
    <label  class="form-label" for="{{$name}}">
        {{ $label }}
        @if($re)
            <span style="color: red">*</span>
        @endif
    </label>
@endif

<input
    type="{{$type}}"
    id="{{$name}}"
    name="{{$name}}"
    value="{{old($name, $value)}}"
    {{$attributes->class([
        'form-control',
        'is-invalid' => $errors->has($name)
    ])}}
/>

{{-- Validation --}}
@error($name)
    <div class="invalid-feedback">
        {{$message}}
    </div>
@enderror
