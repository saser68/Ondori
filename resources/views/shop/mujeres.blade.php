@extends('layouts.app')

@section('title', 'Colección Mujer - Ondori')

@section('content')
<main class="py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <aside class="lg:w-64 flex-shrink-0">
                <div class="bg-gray-50 p-6 rounded-lg sticky top-24">
                    <h2 class="text-lg font-bold mb-4 text-gray-900">
                        <i class="fas fa-filter mr-2"></i>Filtrar por
                    </h2>

                    <form action="{{ url()->current() }}" method="GET" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Tipo</label>
                            <select name="tipo" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black text-sm">
                                <option value="">Todo</option>
                                <option value="Sudadera" {{ request('tipo') == 'Sudadera' ? 'selected' : '' }}>Sudaderas</option>
                                <option value="Camiseta" {{ request('tipo') == 'Camiseta' ? 'selected' : '' }}>Camisetas</option>
                                <option value="Chaqueta" {{ request('tipo') == 'Chaqueta' ? 'selected' : '' }}>Chaquetas</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Talla</label>
                            <select name="talla" class="w-full border-gray-300 rounded-md shadow-sm text-sm">
                                <option value="">Todas</option>
                                <option value="S" {{ request('talla') == 'S' ? 'selected' : '' }}>S</option>
                                <option value="M" {{ request('talla') == 'M' ? 'selected' : '' }}>M</option>
                                <option value="L" {{ request('talla') == 'L' ? 'selected' : '' }}>L</option>
                                <option value="XL" {{ request('talla') == 'XL' ? 'selected' : '' }}>XL</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Color</label>
                            <select name="color" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Todos</option>
                                <option value="Negro" {{ request('color') == 'Negro' ? 'selected' : '' }}>Negro</option>
                                <option value="Blanco" {{ request('color') == 'Blanco' ? 'selected' : '' }}>Blanco</option>
                                <option value="Marrón" {{ request('color') == 'Marrón' ? 'selected' : '' }}>Marrón</option>
                                <option value="Arena" {{ request('color') == 'Arena' ? 'selected' : '' }}>Arena</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Precio Máx (€)</label>
                            <input type="number" name="precio_max" placeholder="Ej: 50" value="{{ request('precio_max') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="flex gap-2 pt-2">
                            <button type="submit" class="flex-1 bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 transition text-sm">
                                <i class="fas fa-filter mr-2"></i>Filtrar
                            </button>
                            @if(request()->filled(['tipo', 'talla', 'color', 'precio_max']))
                                <a href="{{ url()->current() }}" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition text-sm text-center">
                                    <i class="fas fa-times mr-2"></i>Limpiar
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </aside>

            <div class="flex-1">
                <div class="mb-12">
                    <h1 class="text-4xl font-bold mb-2">Colección Mujer</h1>
                    <p class="text-gray-600">Elegancia, comodidad y sostenibilidad para cada día.</p>

                    @if(request()->filled(['tipo', 'talla', 'color', 'precio_max']))
                        <div class="mt-4 flex flex-wrap items-center gap-2 text-sm text-gray-600">
                            <i class="fas fa-filter"></i>
                            <span>Filtros activos:</span>
                            @if(request('tipo'))
                                <span class="bg-gray-200 px-2 py-1 rounded">{{ request('tipo') }}</span>
                            @endif
                            @if(request('talla'))
                                <span class="bg-gray-200 px-2 py-1 rounded">Talla: {{ request('talla') }}</span>
                            @endif
                            @if(request('color'))
                                <span class="bg-gray-200 px-2 py-1 rounded">{{ request('color') }}</span>
                            @endif
                            @if(request('precio_max'))
                                <span class="bg-gray-200 px-2 py-1 rounded">Max: €{{ request('precio_max') }}</span>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($productos as $producto)
                        <div class="product-card flex flex-col h-full">
                            <div class="product-image-container">
                                <img src="{{ asset($producto->foto) }}" alt="{{ $producto->nombre }}" class="product-image">
                            </div>

                            <h3 class="font-semibold text-lg mt-4">{{ $producto->nombre }}</h3>
                            <p class="text-gray-500 text-sm mb-2">{{ $producto->tipoRopa ?? 'Mujer' }}</p>

                            <div class="mt-auto">
                                <span class="text-xl font-bold">€{{ number_format($producto->precio, 2) }}</span>

                                <div class="flex gap-2 mt-3">
                                    <a href="/mujeres/{{ $producto->id_producto }}" class="btn-primary text-sm flex-1 text-center">Ver más</a>
                                    <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $producto->id_producto }}">
                                        <input type="hidden" name="product_name" value="{{ $producto->nombre }}">
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
                            <p class="text-gray-500">No hay productos en la tabla 'Mujer' de tu base de datos.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</main>
@endsection