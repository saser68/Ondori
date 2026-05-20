@extends('layouts.app')

@section('title', 'Carrito de Compras - Ondori')

@section('content')
    <main class="max-w-7xl mx-auto px-4 pt-24 pb-8">
        
        <!-- Título del Carrito -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Mi Carrito</h1>
            <p class="text-gray-600">Última oportunidad para revisar antes de checkout</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-6">
                <p class="text-green-600">✓ {{ session('success') }}</p>
            </div>
        @endif

        <!-- Contenido del Carrito -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Lista de Productos -->
            <div class="lg:col-span-2">
                
                @if(empty($cart))
                    <!-- Carrito Vacío -->
                    <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                        <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tu carrito está vacío</h3>
                        <p class="text-gray-600 mb-6">Vuelve a nuestro catálogo y encuentra lo que buscas</p>
                        <a href="/" class="inline-flex items-center bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Ir al catálogo
                        </a>
                    </div>
                @else
                    <!-- Lista de Productos del Carrito -->
                    @foreach($cart as $productId => $item)
                    <div class="cart-item bg-white rounded-lg shadow-sm p-6 mb-4 hover:shadow-md transition">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-lg bg-gray-100">
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg text-gray-900">{{ $item['name'] }}</h3>
                                <p class="text-gray-500 text-sm mb-2">€{{ number_format($item['price'] * $item['quantity'], 2) }} total</p>
                                <div class="flex items-center gap-4">
                                    <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-gray-300 rounded-lg">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $productId }}">
                                        <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="px-3 py-1 text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-minus text-sm"></i>
                                        </button>
                                        <span class="px-4 py-1 text-gray-900 font-medium">{{ $item['quantity'] }}</span>
                                        <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-1 text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-plus text-sm"></i>
                                        </button>
                                    </form>
                                    <span class="text-lg font-bold text-gray-900">€{{ number_format($item['price'], 2) }}/ud</span>
                                </div>
                            </div>
                            <form action="{{ route('cart.remove') }}" method="POST" class="remove-btn">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $productId }}">
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Eliminar">
                                    <i class="fas fa-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach

                    <!-- Seguir Comprando -->
                    <div class="mt-6">
                        <a href="/" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Seguir navegando
                        </a>
                    </div>
                @endif

            </div>

            <!-- Resumen del Pedido -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Resumen del Pedido</h2>
                    
                    @if(!empty($cart))
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ count($cart) }} artículos)</span>
                            <span>€{{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Envío</span>
                            <span class="text-green-600">Gratis</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Impuestos</span>
                            <span>€{{ number_format($total * 0.21, 2) }}</span>
                        </div>
                        <div class="border-t pt-3">
                            <div class="flex justify-between text-lg font-bold text-gray-900">
                                <span>Total</span>
                                <span>€{{ number_format($total * 1.21, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Código de Descuento -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Código de descuento</label>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Introduce tu código" 
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black">
                            <button class="px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition">
                                Aplicar
                            </button>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="space-y-3">
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <input type="hidden" name="address" value="{{ auth()->user()->Telefono ?? 'Dirección por defecto' }}">
                            <input type="hidden" name="payment_method" value="Tarjeta">
                            <button type="submit" class="w-full bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
                                Proceder al Pago
                            </button>
                        </form>
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                                Vaciar Carrito
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="text-center text-gray-500">
                        <p>Añade productos para ver el resumen</p>
                    </div>
                    @endif

                    <!-- Métodos de Pago -->
                    <div class="mt-6 pt-6 border-t">
                        <p class="text-sm text-gray-600 mb-3">Métodos de pago aceptados:</p>
                        <div class="flex gap-3">
                            <i class="fab fa-cc-visa text-2xl text-gray-400"></i>
                            <i class="fab fa-cc-mastercard text-2xl text-gray-400"></i>
                            <i class="fab fa-cc-paypal text-2xl text-gray-400"></i>
                            <i class="fab fa-apple-pay text-2xl text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
@endsection