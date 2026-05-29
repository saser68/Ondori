@extends('layouts.app')

@section('title', 'Colección Hombre - Ondori')

@section('content')

    <!-- contenido principal -->
<main class="py-12">
        <div class="max-w-7xl mx-auto px-4">
            <!-- estructura con sidebar para filtros -->
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- filtros laterales -->
                <aside class="lg:w-64 flex-shrink-0">
                    <!-- sticky para mejor ux al scroll -->
                    <div class="bg-gray-50 p-6 rounded-lg sticky top-24">
                        <h2 class="text-lg font-bold mb-4 text-gray-900">
                            <i class="fas fa-filter mr-2"></i>Filtrar por
                        </h2>
                        
                        <!-- formulario de filtros get -->
                        <form action="{{ url()->current() }}" method="GET" class="space-y-4">
                            <!-- tipo de prenda -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Tipo</label>
                                <select name="tipo" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-black focus:border-black text-sm">
                                    <option value="">Todo</option>
                                    <option value="Sudadera" {{ request('tipo') == 'Sudadera' ? 'selected' : '' }}>Sudaderas</option>
                                    <option value="Camiseta" {{ request('tipo') == 'Camiseta' ? 'selected' : '' }}>Camisetas</option>
                                    <option value="Chaqueta" {{ request('tipo') == 'Chaqueta' ? 'selected' : '' }}>Chaquetas</option>
                                </select>
                            </div>

                            <!-- talla -->
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

                            <!-- color -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-2">Color</label>
                                <select name="color" class="w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Todos</option>
                                    <!-- Mantiene el color seleccionado -->
                                    <option value="Negro" {{ request('color') == 'Negro' ? 'selected' : '' }}>Negro</option>
                                    <option value="Blanco" {{ request('color') == 'Blanco' ? 'selected' : '' }}>Blanco</option>
                                    <option value="Marrón" {{ request('color') == 'Marrón' ? 'selected' : '' }}>Marrón</option>
                                    <option value="Arena" {{ request('color') == 'Arena' ? 'selected' : '' }}>Arena</option>
                                </select>
                            </div>

                            <!-- filtro por precio maximo -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-1">Precio Máx (€)</label>
                                <!-- Mantiene el valor ingresado usando request('precio_max') -->
                                <input type="number" name="precio_max" placeholder="Ej: 50" 
                                       value="{{ request('precio_max') }}" 
                                       class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <!-- botones de accion -->
                            <div class="flex gap-2 pt-2">
                                <!-- boton principal para aplicar filtros -->
                                <button type="submit" class="flex-1 bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 transition text-sm">
                                    <i class="fas fa-filter mr-2"></i>Filtrar
                                </button>
                                <!-- boton limpiar aparece solo si hay filtros activos -->
                                @if(request()->filled(['tipo', 'talla', 'color', 'precio_max']))
                                    <a href="{{ url()->current() }}" class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition text-sm text-center">
                                        <i class="fas fa-times mr-2"></i>Limpiar
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </aside>

                <!-- contenido principal lista de productos -->
                <div class="flex-1">
                    <!-- titulo y descripcion de la seccion -->
                    <div class="mb-12">
                        <h1 class="text-4xl font-bold mb-2">Colección Hombre</h1>
                        <p class="text-gray-600">Explora lo último en moda masculina.</p>
                        
                        <!-- indicador de filtros activos -->
                        @if(request()->filled(['tipo', 'talla', 'color', 'precio_max']))
                            <div class="mt-4 flex items-center gap-2 text-sm text-gray-600">
                                <i class="fas fa-filter"></i>
                                <span>Filtros activos:</span>
                                <!-- muestra cada filtro activo como etiqueta -->
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

                    <!-- grid de productos adaptativo en desktop y movil -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                
                {{-- bucle de productos, recorre todos los productos de la base de datos --}}
                @forelse($productos as $producto)
                    <!-- Tarjeta individual de producto con flexbox para alinear botones -->
                    <div class="product-card flex flex-col h-full">
                        <!-- Contenedor de la imagen con efectos hover -->
                        <div class="product-image-container">
                            {{-- Imagen del producto usando la ruta de la base de datos --}}
                            <img src="{{ asset($producto->foto) }}" 
                                 alt="{{ $producto->nombre }}" 
                                 class="product-image">
                        </div>
                        
                        <!-- Nombre del producto -->
                        <h3 class="font-semibold text-lg mt-4">{{ $producto->nombre }}</h3>
                        <!-- Descripción con valor por defecto si está vacía -->
                        <p class="text-gray-500 text-sm mb-2">{{ $producto->descripcion ?? 'Colección Urbana' }}</p>
                        
                        <!-- Contenedor de precio y botones (mt-auto para alinear abajo) -->
                        <div class="mt-auto">
                            <!-- Precio formateado con 2 decimales -->
                            <span class="text-xl font-bold">€{{ number_format($producto->precio, 2) }}</span>
                            
                            <!-- Botones de acción -->
                            <div class="flex gap-2 mt-3">
                                <!-- Enlace a vista del producto individual usando id_producto -->
                                <a href="/vistaProducto/{{ $producto->id_producto }}" class="btn-primary text-sm flex-1 text-center">Ver más</a>
                                
                                <!-- Botón de añadir al carrito -->
                                <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $producto->id_producto }}">
                                    <input type="hidden" name="product_table" value="Hombre">
                                    <input type="hidden" name="product_name" value="{{ $producto->nombre }}">
                                    <input type="hidden" name="product_price" value="{{ $producto->precio }}">
                                    <input type="hidden" name="product_image" value="{{ $producto->foto }}">
                                    <button type="submit" class="btn-secondary text-sm w-full">
                                        <i class="fas fa-cart-plus mr-1"></i>
                                        Añadir
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Mensaje si no hay productos en la base de datos -->
                    <div class="col-span-full py-20 text-center">
                        <p class="text-gray-500">No hay productos en la tabla 'Hombre' de tu base de datos.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </main>

    @endsection
