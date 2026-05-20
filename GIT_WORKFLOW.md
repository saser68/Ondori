# Git Workflow - Ondori

## Ramas

- `main` - Producción, solo merged PRs
- `develop` - Desarrollo, base para nuevas features
- `feature/*` - Nuevas funcionalidades
- `bugfix/*` - Correcciones de bugs
- `hotfix/*` - Urgencias en producción

## Commits

Usar convención conventional commits:

```
feat: agregar búsqueda de productos
fix: corregir validación de email
docs: actualizar README
style: formatear código
refactor: simplificar lógica de carrito
test: agregar tests para login
```

## Pull Requests

1. Crear rama desde `develop`
2. Hacer cambios
3. Push a origin
4. Crear PR con descripción clara
5. Code review
6. Merge a develop
7. Merge develop a main (solo releases)

## Releases

1. Crear tag: `v1.0.0`
2. Generar changelog
3. Merge a main
4. Deploy a producción

---

**Equipo:** Ondori Dev Team
