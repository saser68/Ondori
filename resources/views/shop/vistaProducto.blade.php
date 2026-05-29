<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ondori - {{ $producto->nombre }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .btn-buy { 
            background: #000; 
            color: white; 
            padding: 15px 30px; 
            border-radius: 5px; 
            font-weight: bold; 
            text-align: center;
            transition: background 0.3s;
            width: 100%;
            display: block;
        }

        .btn-buy:hover {
            background: #333;
        }

        .product-main-image {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            background: #f5f5f5;
        }

        .badge {
            background: #f3f4f6;
            color: #374151;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>
</head>

<body class="bg-white text-gray-900">
    {{-- plantilla de producto individual con imagen, detalle y tallas --}}

    <header class="w-full bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col gap-4 md:flex-row md:justify-between md:items-center h-auto md:h-16">
                <a href="{{ $backUrl ?? url('/hombres') }}" class="text-gray-500 hover:text-black transition inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Volver a la colección
                </a>
                <a href="/" class="font-bold text-2xl tracking-tight">Ondori</a>
                <div class="text-right">
                    <i class="fas fa-shopping-cart text-lg"></i>
                </div>
            </div>
        </div>
    </header>

    <main class="py-12 max-w-7xl mx-auto px-4">
        {{-- cuerpo principal con imagen y detalles del producto --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            
            <div class="sticky top-24">
                <img src="{{ asset($producto->foto) }}" alt="{{ $producto->nombre }}" class="product-main-image">
            </div>

            <div class="flex flex-col space-y-6">
                <div>
                    <div class="flex gap-2 mb-4">
                        <span class="badge">{{ $producto->tipoRopa ?? 'Oferta' }}</span>
                        <span class="badge">{{ $producto->color ?? 'Ondori' }}</span>
                    </div>
                    <h1 class="text-4xl font-bold mb-2">{{ $producto->nombre }}</h1>
                    <p class="text-2xl font-light text-gray-800">€{{ number_format($producto->precio, 2) }}</p>
                </div>

                <div class="border-t border-b py-6">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-3">Descripción</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $producto->descripcion ?? 'Esta prenda exclusiva de Ondori combina comodidad y estilo urbano. Fabricada con materiales de alta calidad para durar toda la temporada.' }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-bold uppercase mb-3">Selecciona tu Talla</label>
                    {{-- tallas separadas por comas, se muestran como botones --}}
                    <div class="flex gap-3">
                        @foreach(explode(',', $producto->talla) as $t)
                            <button class="border-2 border-gray-200 hover:border-black w-12 h-12 flex items-center justify-center font-bold transition rounded">
                                {{ trim($t) }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <form action="{{ route('cart.add') }}" method="POST" class="pt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $producto->id_producto }}">
                    <input type="hidden" name="product_table" value="{{ $productTable ?? 'Hombre' }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-buy shadow-xl">
                        AÑADIR AL CARRITO
                    </button>
                    <p class="text-center text-xs text-gray-400 mt-4">
                        <i class="fas fa-truck mr-1"></i> Envío gratuito en pedidos superiores a 50€
                    </p>
                </form>
            </div>

        </div>
    </main>

    {{-- footer minimal para la vista de producto --}}
    <footer class="bg-gray-900 text-white py-8 mt-20 text-center">
        <p class="text-gray-400 text-sm">&copy; 2026 Ondori. Calidad Garantizada.</p>
    </footer>

</body>
</html>
