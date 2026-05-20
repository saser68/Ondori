# 📁 Estructura del Proyecto Ondori

> Proyecto de tienda online de moda. Construido con Laravel 11 + Tailwind CSS + Vite

## 📂 Organización de Archivos

### 🎨 Vistas (resources/views/)
```
views/
├── 📄 welcome.blade.php              # Landing page - hero + featured products
├── 📁 auth/                         # Autenticación (login/register)
│   ├── 📄 login.blade.php           # Formulario de login
│   └── 📄 register.blade.php        # Registro de nuevos usuarios
├── 📁 layouts/                      # Layouts base
│   ├── 📄 app.blade.php             # Layout principal (header + footer)
│   └── 📁 partials/                 # Componentes reutilizables
│       ├── 📄 header.blade.php      # Navegación y carrito
│       └── 📄 footer.blade.php      # Pie de página
├── 📁 shop/                         # Sección de tienda
│   ├── 📄 hombres.blade.php         # Catálogo de hombres
│   ├── 📄 mujeres.blade.php         # Catálogo de mujeres
│   ├── 📄 vistaProducto.blade.php   # Detalles del producto
│   └── 📄 carrito.blade.php        # Carrito de compras
├── 📁 admin/                       # Panel administración
│   └── 📄 dashboard.blade.php      # Panel usuario
├── 📁 checkout/                    # Proceso de compra
│   └── 📄 success.blade.php        # Página éxito
├── 📁 emails/                      # Plantillas email
│   ├── 📄 welcome.blade.php        # Email bienvenida
│   └── 📄 purchase-confirmation.blade.php # Email confirmación
└── 📁 components/                  # Componentes Blade
```

### 🧠 Controladores (app/Http/Controllers/)
```
Controllers/
├── 📁 Auth/
│   └── 📄 RegisterController.php   # Registro usuarios
├── 📄 CartController.php           # Gestión carrito
├── 📄 ProfileController.php        # Perfil usuario
└── 📄 ... (otros controladores)
```

### 📧 Emails (app/Mail/)
```
Mail/
├── 📄 WelcomeEmail.php             # Email bienvenida
└── 📄 PurchaseConfirmation.php     # Email confirmación compra
```

### 🛣️ Rutas (routes/)
```
web.php
├── 🏠 Rutas generales              # /, /dashboard
├── 🔐 Rutas autenticación          # /login, /register
├── 🛒 Rutas carrito                # /carrito, /cart/*
├── 🛍️ Rutas tienda                 # /hombres, /mujeres
└── 💳 Rutas checkout               # /checkout
```

## 🎯 Funcionalidades Implementadas

### ✅ Sistema de Autenticación
- **Login/Registro** → Funciona con tabla `Usuarios`
- **Dashboard** → Panel personal de usuario
- **Sesiones** → Gestión automática de Laravel

### ✅ Sistema de Carrito
- **Añadir productos** → Desde cualquier página
- **Gestión cantidades** → Botones +/-
- **Eliminar productos** → Individual o vaciar
- **Contador dinámico** → En header

### ✅ Sistema de Emails
- **Bienvenida** → Al registrarse (con descuento 10%)
- **Confirmación compra** → Detalles del pedido
- **Diseños HTML** → Modernos y responsive

### ✅ Estructura Organizada
- **Separación por módulos** → shop/, admin/, auth/
- **Nomenclatura clara** → Nombres descriptivos
- **Componentes reutilizables** → partials/

## 🔄 Flujo Completo

### 📝 Registro → Login → Compra
```
👤 Usuario se registra
   ↓
📧 Email bienvenida (descuento 10%)
   ↓
🔐 Login automático
   ↓
🛍️ Navega y añade productos
   ↓
🛒 Procesa checkout
   ↓
📧 Email confirmación (detalles pedido)
   ↓
✅ Página éxito
```

## 🚀 Características Técnicas

### 🔧 Laravel 12
- **Sesiones** → Gestión carrito
- **Auth** → Sistema autenticación
- **Mail** → Envío emails
- **Blade** → Plantillas

### 💾 Base de Datos
- **Tabla Usuarios** → Tu BD XAMPP existente
- **No migraciones** → Trabaja directo con tu BD
- **Campos personalizados** → ID_USUario, Email, Password

### 🎨 Frontend
- **Tailwind CSS** → Estilos modernos
- **Font Awesome** → Iconos
- **Responsive** → Mobile-first
- **Componentes** → Reutilizables

## 📁 Archivos Clave

### 🎯 Para Modificar
- **📄 routes/web.php** → Añadir/Modificar rutas
- **📄 app/Http/Controllers/** → Lógica negocio
- **📄 resources/views/shop/** → Tienda
- **📄 resources/views/admin/** → Panel admin
- **📄 .env** → Configuración (Gmail, BD)

### 🔧 Configuración
- **📄 .env** → MAIL_* para emails
- **📄 config/mail.php** → Configuración email
- **📄 database/seeders/** → Datos de prueba

## 🎨 Diseño y UX

### ✅ Características
- **Diseño minimalista** → Limpio y moderno
- **Colores corporativos** → Negro y blancos
- **Tipografía clara** → Legibilidad máxima
- **Animaciones suaves** → UX fluida
- **Feedback visual** → Mensajes éxito/error

### 📱 Responsive
- **Mobile-first** → Adaptado a móviles
- **Breakpoints** → sm, md, lg, xl
- **Navegación táctil** → Botones grandes
- **Optimizado** → Rápido y ligero

---

🎉 **¡Proyecto completamente funcional y organizado!** 🎊
