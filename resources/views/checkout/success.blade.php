@extends('layouts.app')

@section('title', 'Pedido Confirmado - Ondori')

@section('content')
    <main class="max-w-4xl mx-auto px-4 pt-24 pb-8">
        
        <!-- Success Message -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">¡Pedido Confirmado!</h1>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow-sm p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Detalles del Pedido</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">Información del Pedido</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Número de Pedido:</span>
                            <span class="font-medium">{{ $order['id'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Fecha:</span>
                            <span class="font-medium">{{ date('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Método de Pago:</span>
                            <span class="font-medium">{{ $order['payment_method'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Método de Envío:</span>
                            <span class="font-medium">{{ $order['shipping'] }}</span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-semibold text-gray-900 mb-3">Resumen del Costo</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium">€{{ number_format($order['subtotal'], 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Impuestos (21%):</span>
                            <span class="font-medium">€{{ number_format($order['tax'], 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Envío:</span>
                            <span class="font-medium text-green-600">{{ $order['shipping'] }}</span>
                        </div>
                        <div class="border-t pt-2 mt-2">
                            <div class="flex justify-between">
                                <span class="font-semibold text-lg">Total:</span>
                                <span class="font-semibold text-lg">€{{ number_format($order['total'], 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-blue-50 rounded-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">¿Qué sucede ahora?</h2>
            
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-4">1</div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Confirmación por Email</h3>
                        <p class="text-gray-600">Hemos enviado un email detallado con toda la información de tu pedido</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-4">2</div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Preparación del Pedido</h3>
                        <p class="text-gray-600">Tu pedido será preparado en nuestro almacén dentro de 24-48 horas</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-4">3</div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Envío</h3>
                        <p class="text-gray-600">Recibirás tu pedido en 3-5 días hábiles. Te enviaremos un email con el número de seguimiento</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center bg-black text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
                <i class="fas fa-user mr-2"></i>
                Ir a Mi Cuenta
            </a>
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center border border-gray-300 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Seguir Comprando
            </a>
        </div>

    </main>
@endsection
