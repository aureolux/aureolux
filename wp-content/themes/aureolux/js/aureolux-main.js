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
  alert('¡Gracias por tu reserva! Te contactaremos pronto.');
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

// Inicializar funcionalidades cuando el DOM esté listo
const initializeAureolux = () => {
  initializeCountdown();
  initializePopup();
};

// Ejecutar cuando el DOM esté listo
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeAureolux);
} else {
  initializeAureolux();
}
