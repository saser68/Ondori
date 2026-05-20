@extends('layouts.app')

@section('title', 'Resultados de búsqueda - Ondori')

@section('content')
<main class="py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-4xl font-bold mb-2">Resultados de búsqueda</h1>
            <p class="text-gray-600">Búsqueda: <span class="font-semibold">{{ $query ?: 'Ninguna consulta' }}</span></p>
            <p class="text-sm text-gray-500 mt-2">{{ $total }} producto{{ $total === 1 ? '' : 's' }} encontrado{{ $total === 1 ? '' : 's' }}.</p>
        </div>

        @if($query && $total === 0)
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-md mb-8">
                <p class="text-yellow-700">No se han encontrado productos con ese criterio. Prueba con otro término.</p>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($productos as $producto)
                <div class="product-card flex flex-col h-full bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="product-image-container">
                        <img src="{{ asset($producto->foto) }}" alt="{{ $producto->nombre }}" class="product-image">
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <div class="flex items-center justify-between mb-3">
                            <span class="badge">{{ $producto->category === 'hombres' ? 'Hombre' : 'Mujer' }}</span>
                            <span class="text-gray-500 text-sm">{{ $producto->color ?? 'Color desconocido' }}</span>
                        </div>
                        <h2 class="text-xl font-semibold mb-2">{{ $producto->nombre }}</h2>
                        <p class="text-gray-500 text-sm mb-4">{{ $producto->descripcion ?? 'Sin descripción disponible' }}</p>
                        <div class="mt-auto flex items-center justify-between gap-2">
                            <span class="text-lg font-bold">€{{ number_format($producto->precio, 2) }}</span>
                            <a href="{{ $producto->url }}" class="btn-primary text-sm px-4 py-2">Ver más</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white rounded-xl shadow-sm">
                    <p class="text-gray-600">Introduce un término de búsqueda y encuentra tu próxima prenda.</p>
                </div>
            @endforelse
        </div>
    </div>
</main>
@endsection
