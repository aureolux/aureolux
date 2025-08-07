<?php
/**
 * AUREOLUX - Landing Page Principal
 * Template Name: Landing Page
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <div class="hero-grid">
      <div class="hero-content">
        <?php 
        // Obtener información dinámica de precios
        $tier_info = function_exists('aureolux_get_tier_info') ? aureolux_get_tier_info() : array('tier' => 1, 'price' => 69, 'remaining' => 50, 'savings' => 80, 'message' => 'Solo quedan 50 unidades a este precio');
        $discount_percent = $tier_info ? round(($tier_info['savings'] / 149) * 100) : 40;
        ?>
        <div class="badge">⚡ Oferta Pre-lanzamiento - <?php echo $discount_percent; ?>% DTO</div>
        <h1 class="hero-title">Borra 10 años en 10 minutos al día</h1>
        <p class="hero-subtitle">
          La única máscara LED que cuida tu rostro Y cuello con tecnología clínica certificada FDA, 
          al precio justo. Ya la usan 50.000 mujeres en Europa.
        </p>
        <div class="hero-cta-group">
          <button class="btn-primary btn-large" onclick="scrollToPreorder()">
            Reserva con <?php echo $discount_percent; ?>% DTO
            <span class="btn-subtitle"><?php echo $tier_info ? $tier_info['message'] : 'Solo quedan 47 unidades'; ?></span>
          </button>
          <div class="trust-badges">
            <span>✅ FDA</span>
            <span>✅ CE</span>
            <span>✅ Garantía 30 días</span>
          </div>
        </div>
        <div class="social-proof">
          <div class="avatars">
            <img src="https://i.pravatar.cc/40?img=1" alt="Cliente">
            <img src="https://i.pravatar.cc/40?img=2" alt="Cliente">
            <img src="https://i.pravatar.cc/40?img=3" alt="Cliente">
            <img src="https://i.pravatar.cc/40?img=4" alt="Cliente">
          </div>
          <p>+5,234 mujeres ya reservaron la suya</p>
        </div>
      </div>
      <div class="hero-image">
        <div class="product-showcase">
          <div class="product-image-placeholder">
            <div class="led-mask-visual">
              <div class="mask-glow"></div>
              <div class="mask-body">
                <div class="led-dots"></div>
              </div>
            </div>
          </div>
          <div class="price-tag">
            <span class="original-price">149€</span>
            <span class="sale-price"><?php echo $tier_info ? $tier_info['price'] : 69; ?>€</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Problema-Solución -->
<section class="problem-solution">
  <div class="container">
    <h2 class="section-title">¿Te suena familiar?</h2>
    <div class="problems-grid">
      <div class="problem-card">
        <span class="problem-icon">😔</span>
        <h3>Arrugas y líneas de expresión</h3>
        <p>Cada día más visibles pese a las cremas caras</p>
      </div>
      <div class="problem-card">
        <span class="problem-icon">💸</span>
        <h3>Tratamientos costosos</h3>
        <p>500€ por sesión en clínica, sin garantías</p>
      </div>
      <div class="problem-card">
        <span class="problem-icon">⏰</span>
        <h3>Sin tiempo para ti</h3>
        <p>Imposible ir a centros de estética regularmente</p>
      </div>
    </div>
    <div class="solution-banner">
      <h3>La solución: Tecnología LED clínica en casa</h3>
      <p>10 minutos mientras ves Netflix = Piel visiblemente más joven</p>
    </div>
  </div>
</section>

<!-- Beneficios -->
<section id="beneficios" class="benefits-section">
  <div class="container">
    <h2 class="section-title">Resultados visibles, científicamente probados</h2>
    <div class="benefits-grid">
      <div class="benefit-card">
        <div class="benefit-icon">✨</div>
        <h3>Anti-edad visible</h3>
        <p>Reduce arrugas un 35% en 4 semanas</p>
        <span class="benefit-tag">Luz Roja 630nm</span>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon">🎯</div>
        <h3>Control del acné</h3>
        <p>Elimina bacterias y reduce inflamación</p>
        <span class="benefit-tag">Luz Azul 415nm</span>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon">💆</div>
        <h3>Regeneración profunda</h3>
        <p>Mejora circulación y repara tejidos</p>
        <span class="benefit-tag">NIR 830nm</span>
      </div>
      <div class="benefit-card">
        <div class="benefit-icon">🏠</div>
        <h3>Spa en casa</h3>
        <p>Tratamiento profesional sin salir</p>
        <span class="benefit-tag">10-20 min/día</span>
      </div>
    </div>
  </div>
</section>

<!-- Tecnología -->
<section id="tecnologia" class="technology-section">
  <div class="container">
    <h2 class="section-title">Tecnología NASA en tu tocador</h2>
    <div class="tech-content">
      <div class="tech-specs">
        <div class="spec-item">
          <strong>219</strong>
          <span>LEDs médicos</span>
        </div>
        <div class="spec-item">
          <strong>3 en 1</strong>
          <span>Tipos de luz</span>
        </div>
        <div class="spec-item">
          <strong>FDA</strong>
          <span>Certificación</span>
        </div>
        <div class="spec-item">
          <strong>40min</strong>
          <span>Carga rápida</span>
        </div>
      </div>
      <div class="tech-comparison">
        <h3>¿Por qué AUREOLUX?</h3>
        <table class="comparison-table">
          <tr>
            <th>Característica</th>
            <th class="highlight">AUREOLUX</th>
            <th>Competencia</th>
          </tr>
          <tr>
            <td>Cubre cuello</td>
            <td class="check">✅ Sí</td>
            <td class="cross">❌ No</td>
          </tr>
          <tr>
            <td>Silicona flexible</td>
            <td class="check">✅ Sí</td>
            <td class="cross">❌ Rígida</td>
          </tr>
          <tr>
            <td>Certificación FDA</td>
            <td class="check">✅ Sí</td>
            <td class="cross">⚠️ Dudosa</td>
          </tr>
          <tr>
            <td>Precio</td>
            <td class="check">149€</td>
            <td>200-600€</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</section>

<!-- Testimonios -->
<section id="testimonios" class="testimonials-section">
  <div class="container">
    <h2 class="section-title">Mujeres reales, resultados reales</h2>
    <div class="testimonials-grid">
      <div class="testimonial-card">
        <div class="stars">⭐⭐⭐⭐⭐</div>
        <p>"En 3 semanas noté mi piel más firme y luminosa. Mi marido me preguntó qué me había hecho 😊"</p>
        <div class="testimonial-author">
          <img src="https://i.pravatar.cc/60?img=5" alt="María">
          <div>
            <strong>María G.</strong>
            <span>Barcelona, 45 años</span>
          </div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="stars">⭐⭐⭐⭐⭐</div>
        <p>"Las arrugas del contorno de ojos han disminuido visiblemente. ¡Mejor que el botox!"</p>
        <div class="testimonial-author">
          <img src="https://i.pravatar.cc/60?img=6" alt="Carmen">
          <div>
            <strong>Carmen R.</strong>
            <span>Madrid, 52 años</span>
          </div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="stars">⭐⭐⭐⭐⭐</div>
        <p>"Lo uso mientras leo por las noches. Es mi momento de relax y belleza. 100% recomendado"</p>
        <div class="testimonial-author">
          <img src="https://i.pravatar.cc/60?img=7" alt="Ana">
          <div>
            <strong>Ana P.</strong>
            <span>Valencia, 38 años</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq" class="faq-section">
  <div class="container">
    <h2 class="section-title">Preguntas Frecuentes</h2>
    <div class="faq-grid">
      <details class="faq-item">
        <summary>¿Cuándo veré resultados?</summary>
        <p>Mejora del brillo en 1 semana; disminución de arrugas finas en 3-4 semanas con uso diario.</p>
      </details>
      <details class="faq-item">
        <summary>¿Es segura para piel sensible?</summary>
        <p>Sí, certificada para todo tipo de piel. No genera UV ni infrarrojo lejano.</p>
      </details>
      <details class="faq-item">
        <summary>¿Puedo usarla con retinol?</summary>
        <p>Sí, usa la máscara sobre piel limpia y después aplica tus productos habituales.</p>
      </details>
      <details class="faq-item">
        <summary>¿Duele o genera calor?</summary>
        <p>No. La energía LED es fría y totalmente indolora. Solo sentirás una ligera tibieza.</p>
      </details>
      <details class="faq-item">
        <summary>¿Cuánto dura la batería?</summary>
        <p>Hasta 6 sesiones de 10 min. Se recarga completamente en solo 40 minutos.</p>
      </details>
      <details class="faq-item">
        <summary>¿Qué garantía tiene?</summary>
        <p>30 días de devolución sin preguntas + 1 año de garantía en componentes.</p>
      </details>
    </div>
  </div>
</section>

<!-- Pre-order Section -->
<section id="preorder" class="preorder-section">
  <div class="container">
    <div class="preorder-box">
      <h2>Reserva tu máscara AUREOLUX</h2>
      <p class="preorder-subtitle">Oferta especial pre-lanzamiento - Ahorra <?php echo $tier_info ? $tier_info['savings'] : 80; ?>€</p>
      
      <div class="countdown-timer">
        <div class="timer-block">
          <span id="hours">23</span>
          <label>Horas</label>
        </div>
        <div class="timer-block">
          <span id="minutes">45</span>
          <label>Minutos</label>
        </div>
        <div class="timer-block">
          <span id="seconds">32</span>
          <label>Segundos</label>
        </div>
      </div>

      <form class="preorder-form" onsubmit="handlePreorder(event)">
        <div class="form-group">
          <input type="text" placeholder="Nombre completo" required>
        </div>
        <div class="form-group">
          <input type="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="tel" placeholder="Teléfono" required>
        </div>
        <button type="submit" class="btn-primary btn-large btn-full">
          Reservar Ahora por <?php echo $tier_info ? $tier_info['price'] : 69; ?>€
          <span class="btn-subtitle">Depósito 29€ - Ahorra <?php echo $tier_info ? $tier_info['savings'] : 80; ?>€</span>
        </button>
        <p class="form-note">
          <span>🔒 Pago 100% seguro</span>
          <span>📦 Envío en 24-48h</span>
          <span>✅ Garantía 30 días</span>
        </p>
      </form>
    </div>
  </div>
</section>

<!-- Popup urgencia (aparece tras 30 segundos) -->
<div id="urgency-popup" class="popup hidden">
  <div class="popup-content">
    <button class="popup-close" onclick="closePopup()">×</button>
    <h3>⚡ ¡Espera! Oferta exclusiva</h3>
    <p>Solo para ti: 10€ extra de descuento si reservas en los próximos 5 minutos</p>
    <button class="btn-primary" onclick="applyExtraDiscount()">Aplicar Descuento</button>
  </div>
</div>

<?php get_footer(); ?>
