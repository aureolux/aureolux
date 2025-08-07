# 🛠️ Guía para Desarrolladores - AUREOLUX

## 📋 Contexto Técnico

Este documento proporciona toda la información necesaria para desarrolladores que trabajen en el proyecto AUREOLUX.

## 🏗️ Arquitectura del Proyecto

### Stack Principal
- **CMS**: WordPress 6.x
- **Tema**: Custom theme "aureolux" 
- **Build Tool**: Vite 5.4.x
- **JavaScript**: Vanilla JS (migrado desde React para simplicidad)
- **Estilos**: CSS puro (migrado desde Sass)
- **Control de Versiones**: Git

### Estructura de Directorios

```
aureolux/
├── wp-content/
│   └── themes/
│       └── aureolux/           # Tema personalizado
│           ├── src/             # Código fuente
│           │   ├── index.js     # Punto de entrada principal
│           │   ├── style.css    # Estilos globales
│           │   ├── index.html   # Demo page para desarrollo
│           │   └── blocks/      # Bloques Gutenberg
│           │       └── hero/    # Bloque Hero
│           │           ├── index.js
│           │           ├── block.json
│           │           └── style.css
│           ├── build/          # Archivos compilados (generado)
│           ├── package.json     # Dependencias npm
│           └── vite.config.js   # Configuración Vite
├── docs/                        # Documentación
├── setup-server.bat            # Script instalación WordPress
├── start-server.bat            # Script servidor PHP
└── install-php.bat             # Script instalación PHP
```

## 🚀 Configuración del Entorno

### Prerrequisitos

1. **Node.js** (v18+ recomendado)
2. **npm** o **yarn**
3. **PHP** 7.4+ (usar `install-php.bat` si no está instalado)
4. **Git**

### Instalación Paso a Paso

#### 1. Clonar Repositorio
```bash
git clone [REPO_URL]
cd aureolux
```

#### 2. Instalar WordPress (si no existe)
```bash
# Windows
setup-server.bat

# Manual
# Descargar WordPress y extraer en raíz del proyecto
```

#### 3. Configurar Tema
```bash
cd wp-content/themes/aureolux
npm install
```

#### 4. Desarrollo Local

**Opción A: Solo Frontend (Recomendado)**
```bash
npm run dev
# Servidor en http://localhost:5173 o 5174
```

**Opción B: WordPress Completo**
```bash
# Terminal 1: PHP Server
start-server.bat
# Servidor WordPress en http://localhost:8080

# Terminal 2: Vite
cd wp-content/themes/aureolux
npm run dev
```

## 💻 Flujo de Desarrollo

### Comandos Disponibles

```bash
# Desarrollo con HMR
npm run dev

# Build para producción
npm run build

# Preview de build
npm run preview
```

### Hot Module Replacement (HMR)

Vite proporciona HMR automático. Los cambios en:
- `src/index.js` - Se reflejan instantáneamente
- `src/style.css` - Se aplican sin recargar
- `src/index.html` - Requiere recarga manual

### Trabajando con Bloques

Los bloques Gutenberg están en `src/blocks/`. Estructura de un bloque:

```
blocks/
└── [nombre-bloque]/
    ├── index.js       # Lógica del bloque
    ├── block.json     # Metadata del bloque
    ├── editor.css     # Estilos del editor
    └── style.css      # Estilos frontend
```

## 🎨 Estilos y CSS

### Organización de Estilos

```css
/* src/style.css */

/* 1. Variables CSS */
:root {
  --color-primary: #d4af37;
  --color-secondary: #667eea;
}

/* 2. Reset/Base */
* { box-sizing: border-box; }

/* 3. Componentes */
.hero-wrapper { ... }

/* 4. Utilidades */
.text-center { ... }

/* 5. Responsive */
@media (max-width: 768px) { ... }
```

### Convenciones de Nomenclatura

- **BEM** para componentes: `.block__element--modifier`
- **Prefijos** para namespacing: `.aur-` para componentes custom
- **Utility classes**: `.u-` para utilidades

## 🔧 Configuración Vite

```javascript
// vite.config.js
import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  root: './src',
  build: {
    outDir: '../build',
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/index.js'),
      },
    },
  },
  server: {
    port: 5173,
    open: false,
  },
});
```

## 📦 Dependencias Principales

```json
{
  "dependencies": {
    "vite": "^5.4.19"
  },
  "devDependencies": {
    // Actualmente mínimas para simplicidad
  }
}
```

## 🐛 Debugging y Troubleshooting

### Problemas Comunes

#### Puerto 5173 en uso
```bash
# Vite automáticamente usa 5174, o especificar:
npm run dev -- --port 3000
```

#### Errores de compilación CSS
- Verificar sintaxis CSS válida
- No usar características Sass (migrado a CSS puro)

#### HMR no funciona
- Verificar que el navegador soporte WebSockets
- Limpiar caché del navegador
- Reiniciar servidor Vite

### Logs y Debugging

```javascript
// Usar console.log para debugging
console.log('[AUREOLUX]', 'Debug info');

// En desarrollo, activar modo verbose
if (import.meta.env.DEV) {
  console.debug('Development mode');
}
```

## 🚢 Deployment

### Build para Producción

```bash
npm run build
# Genera archivos en build/
```

### Checklist Pre-Deploy

- [ ] Ejecutar build sin errores
- [ ] Verificar todos los enlaces
- [ ] Optimizar imágenes
- [ ] Minificar CSS/JS
- [ ] Configurar caché headers
- [ ] SSL/HTTPS configurado
- [ ] Backup de base de datos

## 📝 Estándares de Código

### JavaScript
- ES6+ sintaxis moderna
- Funciones arrow para callbacks
- Destructuring cuando sea apropiado
- Comentarios JSDoc para funciones públicas

### CSS
- Mobile-first approach
- Variables CSS para theming
- Flexbox/Grid para layouts
- Transiciones suaves (300ms estándar)

### Git
- Commits semánticos: `feat:`, `fix:`, `docs:`, etc.
- Branches: `feature/`, `bugfix/`, `hotfix/`
- PR antes de merge a main

## 🔄 Estado Actual

### ✅ Implementado
- Entorno desarrollo con Vite
- Demo page funcional
- Bloque Hero básico
- HMR funcionando
- Estilos responsive

### 🚧 Por Hacer
- [ ] Integración completa WordPress
- [ ] Sistema de bloques dinámicos
- [ ] API endpoints para pre-orders
- [ ] Testing automatizado
- [ ] CI/CD pipeline

## 📚 Recursos Útiles

- [Vite Documentation](https://vitejs.dev/)
- [WordPress Block Editor Handbook](https://developer.wordpress.org/block-editor/)
- [CSS Tricks](https://css-tricks.com/)
- [MDN Web Docs](https://developer.mozilla.org/)

## 🤝 Contribuir

1. Fork el proyecto
2. Crear feature branch
3. Commit cambios
4. Push a branch
5. Abrir Pull Request

---

*Para consultas técnicas, revisar primero esta documentación y el README principal.*
