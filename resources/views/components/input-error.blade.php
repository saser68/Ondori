@props(['messages'])
@if ($messages && $messages->isNotEmpty())
    @foreach ($messages as $message)
        <p {{ $attributes }}>{{ $message }}</p>
    @endforeach
@endif
