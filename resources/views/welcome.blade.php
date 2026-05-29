@extends('layouts.app')

@section('title', 'Ondori - Tienda de Moda')

@push('styles')
<style>
/* Hero Section */
.hero-section {
    position: relative;
    height: 100vh;
    overflow: hidden;
}

.hero-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-content {
    text-align: center;
    color: white;
    padding: 0 2rem;
}

.btn-primary {
    display: inline-block;
    padding: 1rem 2rem;
    background: #000;
    color: #fff;
    text-decoration: none;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #333;
    transform: translateY(-2px);
}

.btn-secondary {
    display: inline-block;
    padding: 1rem 2rem;
    background: transparent;
    color: #fff;
    text-decoration: none;
    border: 2px solid #fff;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: #fff;
    color: #000;
}

/* Product Cards */
.product-card {
    background: #fff;
    border-radius: 0.75rem;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
}

.product-image-container {
    position: relative;
    height: 280px;
    overflow: hidden;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

@media (hover: none) {
    .product-overlay {
        opacity: 1;
    }
}

.product-button {
    background: #000;
    color: #fff;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease;
}

.product-button:hover {
    background: #333;
}

.badge-discount {
    background: #ef4444;
    color: #fff;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 600;
}

/* Newsletter */
.newsletter {
    background: #f9fafb;
    padding: 4rem 0;
}

.newsletter-input {
    padding: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    font-size: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .hero-content p {
        font-size: 1rem;
    }
}
</style>
@endpush

@section('content')

    <main>

        {{-- hero section con imagen grande y llamada a la coleccion --}}
        <section class="hero-section">
            <div class="hero-image">
                <img src="{{ asset('img/Menu/tienda.png') }}" alt="Tienda Ondori">
            </div>
            <div class="hero-overlay">
                <div class="hero-content">
                    <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 tracking-tight">
                        La Moda que te Define
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-200 mb-8">
                        Colección de otoño-invierno con piezas únicas y sostenibles
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('mujeres') }}" class="btn-primary">
                            Comprar Ahora
                        </a>
                        <a href="#productos-destacados" class="btn-secondary">
                            Ver Colección
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- featured products que vienen del controlador --}}
        <section id="productos-destacados" class="py-20 px-4 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl font-bold text-center mb-4">Productos Destacados</h2>
                <p class="text-center text-gray-600 mb-16 max-w-2xl mx-auto">
                    Las piezas más queridas de nuestra colección
                </p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @forelse($productos as $producto)
                        {{-- tarjeta de producto con overlay y boton de carrito --}}
                        <div class="product-card bg-white rounded-xl shadow-sm overflow-hidden">
                            <div class="product-image-container relative">
                                <img src="{{ asset($producto->foto) }}" alt="{{ $producto->nombre }}" class="product-image">
                                <div class="product-overlay">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $producto->id_producto }}">
                                        <input type="hidden" name="product_table" value="Hombre">
                                        <input type="hidden" name="product_name" value="{{ $producto->nombre }}">
                                        <input type="hidden" name="product_price" value="{{ $producto->precio }}">
                                        <input type="hidden" name="product_image" value="{{ $producto->foto }}">
                                        <button type="submit" class="product-button">
                                            Añadir al Carrito
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="font-semibold text-lg mb-1">{{ $producto->nombre }}</h3>
                                <p class="text-gray-600 text-sm mb-2">Hombre • {{ $producto->tipoRopa ?? 'Colección' }}</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-xl font-bold">€{{ number_format($producto->precio, 2) }}</span>
                                    @if(isset($producto->precio_oferta) && $producto->precio_oferta > 0)
                                        <span class="text-gray-400 line-through" style="font-size: 0.9rem;">€{{ number_format($producto->precio_oferta, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center bg-white rounded-xl shadow-sm">
                            <p class="text-gray-600">No se encontraron productos destacados en este momento.</p>
                        </div>
                    @endforelse
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('hombres') }}" class="btn-primary" style="padding: 12px 24px;">
                        Explorar Colección Completa →
                    </a>
                </div>
            </div>
        </section>

        <!-- Newsletter -->
        <section class="py-20 px-4 bg-black text-white">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-4">Newsletter Ondori</h2>
                <p class="text-xl mb-8 text-gray-300">
                    Entérate primero de nuestros lanzamientos y promociones. Unos 2 correos al mes, promesa.
                </p>
                <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Tu correo electrónico" class="newsletter-input">
                    <button type="submit" class="bg-white text-black px-8 py-4 rounded-lg font-semibold hover:bg-gray-200 transition">
                        Suscribirse
                    </button>
                </form>
            </div>
        </section>
    </main>

@endsection
