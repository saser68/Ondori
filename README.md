# Ondori - Tienda Online de Moda

Plataforma de comercio electrónico construida con **Laravel 12** y **Tailwind CSS**.

## 🚀 Características

- ✅ Catálogo de productos (Hombre, Mujer, Ofertas)
- 🛒 Carrito de compras con sesión
- 👤 Autenticación de usuarios
- 🔐 Panel de administración
- 📧 Confirmación de pedidos por email
- 💳 Sistema de pagos (próxmamente)
- 📱 Totalmente responsive

## 📋 Requisitos

- PHP 8.2+
- MySQL/MariaDB
- Composer
- Node.js + npm

## 🔧 Instalación

```bash
# Clonar repositorio
git clone <repo-url>
cd Ondori

# Instalar dependencias
composer install
npm install

# Configurar ambiente
cp .env.example .env
php artisan key:generate

# Setup BD
php artisan migrate --seed

# Build assets
npm run build
```

## ▶️ Ejecutar

```bash
# Terminal 1 - Servidor
php artisan serve

# Terminal 2 - Assets
npm run dev
```

Acceder en: http://localhost:8000

## 📁 Estructura

```
app/
├── Http/Controllers/        # Controladores
├── Models/                  # Modelos de datos
├── Mail/                    # Clases de email
resources/
├── views/                   # Vistas Blade
│   ├── shop/               # Tienda
│   ├── auth/               # Autenticación
│   └── admin/              # Admin panel
```

## 🛠️ Tecnologías

- Laravel 12
- Tailwind CSS 3
- Blade Templates
- MySQL
- Vite

## 📝 TODO

- [ ] Sistema de pagos Stripe
- [ ] Reviews de productos
- [ ] Wishlist
- [ ] API REST
- [ ] Admin mejorado

## 📧 Contacto

Para problemas o sugerencias, contactar al equipo.

---

**Última actualización:** Mayo 2026

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
