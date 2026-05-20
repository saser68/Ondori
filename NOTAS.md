# Notas de Desarrollo - Ondori

## Estado Actual

### ✅ Completado
- [x] Estructura base del proyecto con Laravel 12
- [x] Autenticación básica
- [x] Catálogo de productos (3 categorías)
- [x] Carrito de compras con sesión
- [x] Panel de administrador
- [x] Vistas responsive con Tailwind
- [x] Base de datos con migraciones

### 🔄 En Progreso
- [ ] Sistema de pagos (Stripe)
- [ ] Email de confirmación de pedidos
- [ ] Validación mejorada de formularios

### 📋 Por Hacer
- [ ] Reviews y ratings de productos
- [ ] Wishlist de usuarios
- [ ] Sistema de búsqueda avanzado
- [ ] Filtros de precios (rango)
- [ ] API REST para mobile
- [ ] Dashboard de estadísticas mejorado
- [ ] Tests unitarios (solo tenemos ejemplos)

## Problemas Conocidos

1. **BD Legacy**: Los nombres de las tablas y campos no siguen convenciones de Laravel
   - Solución: Usar $table y accesores en los modelos
   - Status: ✅ Implementado

2. **Contraseñas**: Las contraseñas en la BD deben ser siempre hasheadas
   - Actualmente algunos admin tienen contraseñas sin hash
   - Revisar y actualizar en producción

3. **Filtros en Hombres/Mujeres**: Los filtros GET funcionan pero necesitan validación
   - TODO: Agregar sanitización de inputs

## Notas Técnicas

- Usamos Tailwind CDN en desarrollo, en producción está built con Vite
- El carrito se guarda en sesión (no en BD) - cambiar para persistencia
- Los emails están configurados para usar `log` en desarrollo
- No hay rate limiting en endpoints de carrito
- Las imágenes de productos están en `/public/img/` - considerar usar storage

## Próximas Reuniones

- Confirmar lista de productos finales
- Definir paleta de colores definitiva
- Planear integración con Stripe

---

**Última actualización:** 19/05/2026  
**Desarrollador:** Equipo Ondori
