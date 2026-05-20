import './bootstrap';
import Alpine from 'alpinejs';

// Inicializar Alpine para componentes reactivos
window.Alpine = Alpine;
Alpine.start();

// Custom scripts
console.log('Ondori - Tienda Online de Moda');

// TODO: Agregar validación de formularios más robusta
// TODO: Implementar carrito persistente en localStorage

// Event listeners
document.addEventListener('DOMContentLoaded', () => {
    // Inicialización cuando el DOM está listo
    initializeEventListeners();
});

function initializeEventListeners() {
    // Agregar listeners a elementos dinámicos aquí
}

