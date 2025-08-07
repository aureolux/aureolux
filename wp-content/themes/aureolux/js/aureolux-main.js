/**
 * AUREOLUX - JavaScript Principal
 * Funcionalidades de la landing page
 */

// Funciones principales de la landing page
window.scrollToPreorder = () => {
  document.getElementById('preorder').scrollIntoView({ behavior: 'smooth' });
};

window.handlePreorder = (e) => {
  e.preventDefault();
  
  // Mostrar loading
  const button = e.target.querySelector('button[type="submit"]') || e.target;
  const originalText = button.innerHTML;
  button.innerHTML = 'Procesando...';
  button.disabled = true;
  
  // AJAX para agregar al carrito
  fetch(aureolux_ajax.ajax_url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
      action: 'aureolux_add_to_cart',
      nonce: aureolux_ajax.nonce
    })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      // Redirigir al checkout manteniendo el diseño
      window.location.href = data.data.checkout_url;
    } else {
      alert('Error: ' + data.data);
      button.innerHTML = originalText;
      button.disabled = false;
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Error al procesar la reserva. Inténtalo de nuevo.');
    button.innerHTML = originalText;
    button.disabled = false;
  });
};

window.closePopup = () => {
  document.getElementById('urgency-popup').classList.add('hidden');
};

window.applyExtraDiscount = () => {
  alert('¡Descuento aplicado! Usa el código: EXTRA10');
  closePopup();
};

// Countdown timer
const initializeCountdown = () => {
  let hours = 23, minutes = 45, seconds = 32;
  
  setInterval(() => {
    seconds--;
    if (seconds < 0) {
      seconds = 59;
      minutes--;
      if (minutes < 0) {
        minutes = 59;
        hours--;
        if (hours < 0) {
          hours = 23;
        }
      }
    }
    
    const hoursEl = document.getElementById('hours');
    const minutesEl = document.getElementById('minutes');
    const secondsEl = document.getElementById('seconds');
    
    if (hoursEl) hoursEl.textContent = String(hours).padStart(2, '0');
    if (minutesEl) minutesEl.textContent = String(minutes).padStart(2, '0');
    if (secondsEl) secondsEl.textContent = String(seconds).padStart(2, '0');
  }, 1000);
};

// Popup de urgencia
const initializePopup = () => {
  setTimeout(() => {
    const popup = document.getElementById('urgency-popup');
    if (popup) popup.classList.remove('hidden');
  }, 30000); // 30 segundos
};

// Función para redirigir al producto
const addToCartAjax = () => {
  const button = document.querySelector('.reserve-btn');
  if (button) {
    button.disabled = true;
    button.innerHTML = '⏳ Redirigiendo...';
  }

  // Redirigir directamente a la página del producto
  window.location.href = 'https://aureolux.com/producto/mascara-led-facial-aureolux/';
};

// Actualizar información de precios dinámicamente
const updatePriceInfo = () => {
  fetch(aureolux_ajax.ajax_url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
      action: 'aureolux_get_tier_info',
      nonce: aureolux_ajax.nonce
    })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success && data.data.tier > 0) {
      const tierInfo = data.data;
      
      // Actualizar precio en hero section
      const salePriceEl = document.querySelector('.sale-price');
      if (salePriceEl) {
        salePriceEl.textContent = tierInfo.price + '€';
      }
      
      // Actualizar mensaje de stock
      const stockMessage = document.querySelector('.btn-subtitle');
      if (stockMessage) {
        stockMessage.textContent = tierInfo.message;
      }
      
      // Actualizar badge de oferta
      const badge = document.querySelector('.badge');
      if (badge) {
        const discount = Math.round((tierInfo.savings / 149) * 100);
        badge.textContent = `⚡ Oferta Pre-lanzamiento - ${discount}% DTO`;
      }
      
      // Actualizar botón de reserva
      const reserveButtons = document.querySelectorAll('.btn-primary');
      reserveButtons.forEach(btn => {
        if (btn.textContent.includes('Reserva')) {
          const subtitle = btn.querySelector('.btn-subtitle');
          if (subtitle) {
            subtitle.textContent = `Antes 149€ - Ahorra ${tierInfo.savings}€`;
          }
        }
      });
      
      // Actualizar formulario de preorder
      const preorderButton = document.querySelector('.preorder-form button');
      if (preorderButton) {
        preorderButton.innerHTML = `
          Reservar Ahora por ${tierInfo.price}€
          <span class="btn-subtitle">Depósito 29€ - Ahorra ${tierInfo.savings}€</span>
        `;
      }
    } else if (data.success && data.data.tier === 0) {
      // Preventa cerrada
      const preorderSection = document.getElementById('preorder');
      if (preorderSection) {
        preorderSection.innerHTML = `
          <div class="container">
            <div class="preorder-box">
              <h2>Preventa Cerrada</h2>
              <p class="preorder-subtitle">¡Gracias por el interés! La preventa ha finalizado.</p>
              <p>Suscríbete para recibir información sobre el lanzamiento oficial.</p>
            </div>
          </div>
        `;
      }
    }
  })
  .catch(error => {
    console.error('Error al actualizar precios:', error);
  });
};

// Inicializar funcionalidades cuando el DOM esté listo
const initializeAureolux = () => {
  initializeCountdown();
  initializePopup();
  updatePriceInfo();
  
  // Actualizar precios cada 30 segundos
  setInterval(updatePriceInfo, 30000);
};

// Ejecutar cuando el DOM esté listo
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeAureolux);
} else {
  initializeAureolux();
}
