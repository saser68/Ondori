<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Ondori</title>
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
            background: linear-gradient(135deg, #000 0%, #333 100%);
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
        .welcome-emoji {
            font-size: 4rem;
            text-align: center;
            margin-bottom: 20px;
        }
        .user-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: #000;
            margin-bottom: 10px;
        }
        .discount-box {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 30px 0;
        }
        .discount-code {
            font-size: 2rem;
            font-weight: 700;
            background: rgba(255,255,255,0.2);
            padding: 10px 20px;
            border-radius: 6px;
            display: inline-block;
            margin-top: 10px;
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
        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 30px 0;
        }
        .feature {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .feature-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            margin: 0 10px;
            font-size: 1.5rem;
            color: #666;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>ONDORI</h1>
            <p>Estilo que Define</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="welcome-emoji">🎉</div>
            
            <div class="user-name">
                ¡Hola, {{ $user->getNameAttribute() }}!
            </div>
            
            <p>¡Bienvenido a Ondori! Estamos emocionados de tenerte como parte de nuestra comunidad de moda.</p>
            
            <p>Tu cuenta ha sido creada exitosamente y ya puedes empezar a explorar nuestras increíbles colecciones de moda urbana y contemporánea.</p>

            <!-- Discount Box -->
            <div class="discount-box">
                <h3>🎁 Regalo de Bienvenida</h3>
                <p>Usa este código en tu primera compra</p>
                <div class="discount-code">BIENVENIDO10</div>
                <p><small>10% de descuento válido por 30 días</small></p>
            </div>

            <!-- Buttons -->
            <div class="buttons">
                <a href="{{ url('/hombres') }}" class="btn btn-primary">
                    👕 Ver Hombre
                </a>
                <a href="{{ url('/mujeres') }}" class="btn btn-secondary">
                    👗 Ver Mujer
                </a>
            </div>

            <!-- Features -->
            <div class="features">
                <div class="feature">
                    <div class="feature-icon">🚚</div>
                    <h4>Envío Gratis</h4>
                    <p>En pedidos +€50</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">🔄</div>
                    <h4>Devoluciones</h4>
                    <p>30 días</p>
                </div>
                <div class="feature">
                    <div class="feature-icon">💳</div>
                    <h4>Pago Seguro</h4>
                    <p>100% protegido</p>
                </div>
            </div>

            <p>Si tienes alguna pregunta, no dudes en contactarnos en <strong>hola@ondori.com</strong></p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Gracias por unirte a Ondori</strong></p>
            <p>Estamos aquí para ayudarte a encontrar tu estilo perfecto</p>
            
            <div class="social-links">
                <a href="#">📘</a>
                <a href="#">📷</a>
                <a href="#">🐦</a>
                <a href="#">📌</a>
            </div>
            
            <p><small>&copy; 2024 Ondori. Todos los derechos reservados.</small></p>
        </div>
    </div>
</body>
</html>
