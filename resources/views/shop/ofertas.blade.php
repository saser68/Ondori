@extends('layouts.app')

@section('title', 'Ofertas - Ondori')

@section('content')
<main class="py-12">
    <div class="max-w-7xl mx-auto px-4">

        {{-- Cabecera de la sección --}}
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-bold mb-2">Ofertas</h1>
            <p class="text-gray-600">Descubre 3 productos seleccionados al azar. ¡Vuelve pronto para ver nuevas sorpresas!</p>
        </div>

        {{-- Grid de 3 productos aleatorios --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($productos as $producto)
                <div class="product-card flex flex-col h-full">

                    {{-- Imagen del producto --}}
                    <div class="product-image-container">
                        <img src="/{{ $producto->foto }}"
                             alt="{{ $producto->nombre }}"
                             class="product-image">
                    </div>

                    {{-- Nombre y tipo de prenda --}}
                    <h3 class="font-semibold text-lg mt-4">{{ $producto->nombre }}</h3>
                    <p class="text-gray-500 text-sm mb-2">{{ $producto->tipoRopa ?? 'Hombre' }}</p>

                    {{-- Precio y botones de acción --}}
                    <div class="mt-auto">
                        <span class="text-xl font-bold">€{{ number_format($producto->precio, 2) }}</span>

                        <div class="flex gap-2 mt-3">
                            <a href="/hombres/{{ $producto->id_producto }}"
                               class="btn-primary text-sm flex-1 text-center">
                                Ver más
                            </a>

                            <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="product_id"    value="{{ $producto->id_producto }}">
                                <input type="hidden" name="product_name"  value="{{ $producto->nombre }}">
                                <input type="hidden" name="product_price" value="{{ $producto->precio }}">
                                <input type="hidden" name="product_image" value="{{ $producto->foto }}">
                                <button type="submit" class="btn-secondary text-sm w-full">
                                    <i class="fas fa-cart-plus mr-1"></i>Añadir
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-500">No hay productos disponibles en este momento.</p>
                </div>
            @endforelse
        </div>

        {{-- Enlace para recargar y ver nuevas ofertas --}}
        <div class="mt-12 text-center">
            <a href="{{ route('ofertas') }}"
               class="inline-block bg-black text-white px-8 py-3 rounded-md hover:bg-gray-800 transition font-medium">
                <i class="fas fa-sync-alt mr-2"></i>Ver otras ofertas
            </a>
        </div>

    </div>
</main>
@endsection
