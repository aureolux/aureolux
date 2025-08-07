# 🌟 AUREOLUX - Proyecto WordPress Landing Page

## 📋 Resumen Ejecutivo

**AUREOLUX** es una landing page de preventa para máscaras LED faciales antiedad, desarrollada en WordPress. El objetivo es validar la aceptación del mercado español antes del lanzamiento oficial.

### 🎯 Objetivo Principal
Crear una landing page con opción de **pre-order** para medir el interés del mercado y ajustar la estrategia de lanzamiento según la respuesta obtenida.

---

## 🛍️ Información del Producto

### IDEATHERAPY Silicone LED Light Therapy Mask TLM-200K

#### Especificaciones Técnicas
- **Tecnología**: 3 en 1 chip LED (219 LEDs totales)
  - 415 nm (azul) - Control de acné
  - 630 nm (rojo) - Estimulación de colágeno
  - 830 nm (NIR) - Regeneración profunda
- **Cobertura**: Rostro (105 LEDs) + Cuello (114 LEDs)
- **Material**: Silicona médica flexible
- **Batería**: 4000 mAh, carga completa en 40 min
- **Peso**: 1.5 kg
- **Certificaciones**: FDA 510(k), CE, FCC, UK MDL
- **Garantía**: 1 año
- **Precio objetivo**: 120-200€ (segmento medio)

#### Beneficios Clave
✨ **Anti-edad visible**: Reduce arrugas y líneas de expresión  
🎯 **Control del acné**: Elimina bacterias y reduce inflamación  
💆 **Regeneración profunda**: Mejora circulación y repara tejidos  
🏠 **Tratamiento spa en casa**: 10-20 minutos diarios  
✅ **Seguridad clínica**: Sin radiación UV, certificada FDA  

---

## 👥 Cliente Objetivo

### Perfil Principal: Mujer 30-70 años

#### Características
- **Edad core**: 40-60 años
- **Perfil**: Ya invierte en skincare y rutinas faciales
- **Busca**: Soluciones no invasivas para el envejecimiento
- **Preocupaciones**: Arrugas, firmeza, manchas, seguridad del tratamiento
- **Motivaciones**: Verse más joven, tecnología respaldada, autocuidado

#### Puntos de Dolor
- Signos visibles de envejecimiento
- Dudas sobre eficacia real de la tecnología LED
- Preocupación por seguridad (ojos, hiperpigmentación)
- Integración con rutina existente (retinol, ácidos)
- Necesidad de constancia (uso regular)

---

## 💻 Estructura Técnica

### Stack de Desarrollo
- **CMS**: WordPress
- **Ubicación**: `c:\Users\Usuario\aureolux`
- **Tema**: `wp-content/themes/aureolux`
- **Build Tool**: Vite
- **Lenguajes**: JavaScript vanilla + CSS
- **Control de versiones**: Git/GitHub

### Archivos Principales
```
aureolux/
├── wp-content/
│   └── themes/
│       └── aureolux/
│           ├── src/
│           │   ├── index.js      # Entrada principal
│           │   ├── style.css     # Estilos
│           │   ├── index.html    # Demo page
│           │   └── blocks/       # Bloques Gutenberg
│           │       └── hero/     # Bloque Hero
│           ├── package.json      # Dependencias
│           └── vite.config.js    # Config Vite
├── setup-server.bat              # Instalar WordPress
├── start-server.bat              # Iniciar servidor PHP
└── install-php.bat               # Instalar PHP Windows
```

---

## 🚀 Instrucciones de Instalación

### Requisitos Previos
- Node.js y npm instalados
- PHP (usar `install-php.bat` si no está instalado)
- Git

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone [URL_REPOSITORIO]
   cd aureolux
   ```

2. **Instalar WordPress** (si no existe)
   ```bash
   setup-server.bat
   ```

3. **Instalar dependencias del tema**
   ```bash
   cd wp-content/themes/aureolux
   npm install
   ```

4. **Iniciar servidor de desarrollo**
   ```bash
   npm run dev
   ```
   El servidor estará disponible en `http://localhost:5173` o `http://localhost:5174`

5. **Para servidor WordPress completo** (opcional)
   ```bash
   start-server.bat
   ```
   WordPress estará en `http://localhost:8080`

---

## 📝 Estrategia de Contenido

### Estructura AIDA para Copy

1. **Atención**: "¿Arrugas, flacidez o imperfecciones? Descubre la mascarilla de luz que los dermatólogos ya usan..."

2. **Interés**: "219 LED médicos combinan rojo, azul y NIR. Cada sesión impulsa tu colágeno un +200%..."

3. **Deseo**: "En solo 4 semanas tu reflejo mostrará un contorno más firme, poros cerrados..."

4. **Acción**: "Haz clic en 'Añadir al carrito' y llévate envío gratis + 1 año de garantía..."

### Elementos Clave de la Landing
- Hero section con propuesta de valor clara
- Beneficios respaldados científicamente
- Testimonios y prueba social
- FAQ sobre seguridad y uso
- CTA de pre-order prominente
- Contador de unidades/oferta limitada
- Certificaciones visibles (FDA, CE)

---

## 📊 Métricas de Éxito

### KPIs Principales
- Tasa de conversión pre-order
- Tiempo en página
- Tasa de rebote
- Clicks en CTA
- Formularios completados
- Compartidos en redes sociales

### Objetivos Fase Pre-lanzamiento
- [ ] Validar interés del mercado (mínimo 100 pre-orders)
- [ ] Identificar objeciones principales vía FAQ/soporte
- [ ] Ajustar precio según respuesta
- [ ] Recopilar testimonios early adopters

---

## 🔄 Estado Actual del Proyecto

### ✅ Completado
- Entorno de desarrollo configurado
- Servidor Vite funcionando
- Estructura base del tema WordPress
- Bloque Hero creado
- Estilos CSS implementados
- Demo page funcional

### 🚧 En Progreso
- Integración completa con WordPress
- Sistema de pre-order
- Pasarela de pago
- Páginas adicionales (FAQ, About, Testimonios)

### 📋 Próximos Pasos
1. Finalizar diseño de la landing completa
2. Implementar formulario de pre-order
3. Integrar pasarela de pago (Stripe/PayPal)
4. Configurar email marketing
5. Preparar campaña de lanzamiento
6. Testing A/B de conversión

---

## 📞 Contacto y Soporte

Para cualquier consulta sobre el proyecto, la documentación completa está disponible en:
- `/docs/` - Documentación técnica
- `/docs/DEVELOPER.md` - Guía para desarrolladores
- `/docs/MARKETING.md` - Estrategia de marketing
- `/docs/PRODUCT.md` - Especificaciones del producto

---

*Última actualización: Diciembre 2024*
