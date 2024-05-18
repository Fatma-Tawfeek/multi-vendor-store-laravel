@props(['name', 'value' => '', 'type' => 'text'])
<input 
type="{{ $type ?? 'text' }}" 
{{-- @class(['form-control' , 'is-invalid' => $errors->has($name)])  --}}
name="{{ $name }}" 
id="{{ $name }}" 
placeholder="Enter {{ $name }}" 
value="{{ old($name, $value) }}"
{{ $attributes->class(['form-control' , 'is-invalid' => $errors->has($name)]) }}>

@error($name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror
