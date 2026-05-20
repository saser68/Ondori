@props(['id', 'type' => 'text', 'name'])
<input 
    id="{{ $id }}" 
    type="{{ $type }}" 
    name="{{ $name ?? $id }}"
    {{ $attributes }}
>
