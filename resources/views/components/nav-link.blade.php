@props(['active' => false])

<a {{ $attributes }} class="{{ $active ? 'border-b-2 border-gray-900 text-gray-900' : 'border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none">
    {{ $slot }}
</a>
