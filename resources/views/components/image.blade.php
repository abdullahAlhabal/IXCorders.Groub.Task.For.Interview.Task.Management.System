@props(['src', 'alt', "name"])

<img {{ $attributes->merge(['class' => 'rounded-full w-96 h-96']) }} src="{{ $src }}" alt="{{ $alt }}" name="{{ $name }}">
