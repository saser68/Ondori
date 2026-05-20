<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pedido - Ondori</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
        }
        .success-emoji {
            font-size: 4rem;
            text-align: center;
            margin-bottom: 20px;
        }
        .order-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
        .order-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #28a745;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }
        .products-table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
        }
        .products-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        .total-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .total-row.grand-total {
            font-size: 1.2rem;
            font-weight: 700;
            color: #000;
            border-top: 2px solid #dee2e6;
            padding-top: 10px;
        }
        .shipping-info {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2196f3;
        }
        .buttons {
            display: flex;
            gap: 15px;
            margin: 30px 0;
        }
        .btn {
            flex: 1;
            padding: 15px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            transition: transform 0.2s;
        }
        .btn-primary {
            background: #000;
            color: white;
        }
        .btn-secondary {
            background: #f8f9fa;
            color: #000;
            border: 2px solid #000;
        }
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .timeline {
            margin: 30px 0;
        }
        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .timeline-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #28a745;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .timeline-content {
            flex: 1;
        }
        .timeline-title {
            font-weight: 600;
            margin-bottom: 2px;
        }
        .timeline-desc {
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>✅ ¡Pedido Confirmado!</h1>
            <p>Tu compra en Ondori ha sido procesada</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="success-emoji">🎉</div>
            
            <div class="order-info">
                <div class="order-number">Pedido #{{ $order['id'] ?? 'ORD-' . date('YmdHis') }}</div>
                <p><strong>Fecha:</strong> {{ date('d/m/Y H:i') }}</p>
                <p><strong>Cliente:</strong> {{ $user->getNameAttribute() }}</p>
                <p><strong>Email:</strong> {{ $user->getEmailAttribute() }}</p>
            </div>

            <h3>📦 Productos Comprados</h3>
            
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="product-image">
                                <div style="margin-left: 10px;">
                                    <strong>{{ $item['name'] }}</strong>
                                </div>
                            </div>
                        </td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>€{{ number_format($item['price'], 2) }}</td>
                        <td>€{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total Section -->
            <div class="total-section">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span>€{{ number_format($order['subtotal'] ?? 0, 2) }}</span>
                </div>
                <div class="total-row">
                    <span>Envío:</span>
                    <span style="color: #28a745;">{{ $order['shipping'] ?? 'Gratis' }}</span>
                </div>
                <div class="total-row">
                    <span>Impuestos (21%):</span>
                    <span>€{{ number_format($order['tax'] ?? 0, 2) }}</span>
                </div>
                <div class="total-row grand-total">
                    <span>Total:</span>
                    <span>€{{ number_format($order['total'] ?? 0, 2) }}</span>
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="shipping-info">
                <h3>🚚 Información de Envío</h3>
                <p><strong>Dirección:</strong> {{ $order['address'] ?? 'Tu dirección registrada' }}</p>
                <p><strong>Método de envío:</strong> Estándar (3-5 días hábiles)</p>
                <p><strong>Costo:</strong> Gratis</p>
            </div>

            <!-- Timeline -->
            <div class="timeline">
                <h3>📋 Estado de tu Pedido</h3>
                
                <div class="timeline-item">
                    <div class="timeline-icon">✓</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Pedido Confirmado</div>
                        <div class="timeline-desc">Tu pedido ha sido recibido y procesado</div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon" style="background: #6c757d;">⏳</div>
                    <div class="timeline-content">
                        <div class="timeline-title">En Preparación</div>
                        <div class="timeline-desc">Tu pedido está siendo preparado en nuestro almacén</div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon" style="background: #6c757d;">🚚</div>
                    <div class="timeline-content">
                        <div class="timeline-title">En Camino</div>
                        <div class="timeline-desc">Tu pedido ha sido enviado y está en camino</div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-icon" style="background: #6c757d;">📦</div>
                    <div class="timeline-content">
                        <div class="timeline-title">Entregado</div>
                        <div class="timeline-desc">Tu pedido ha sido entregado correctamente</div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="buttons">
                <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                    👤 Mi Cuenta
                </a>
                <a href="{{ url('/carrito') }}" class="btn btn-secondary">
                    🛒 Seguir Comprando
                </a>
            </div>

            <p>Si tienes alguna pregunta sobre tu pedido, no dudes en contactarnos en <strong>hola@ondori.com</strong> o llama al <strong>+34 900 123 456</strong>.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>¡Gracias por tu compra en Ondori!</strong></p>
            <p>Esperamos que disfrutes tus productos</p>
            
            <p><small>&copy; 2024 Ondori. Todos los derechos reservados.</small></p>
        </div>
    </div>
</body>
</html>
