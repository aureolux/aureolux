<?php
/**
 * Checkout Form - AUREOLUX Custom Template
 *
 * @package AUREOLUX
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<!-- Checkout Section con diseño AUREOLUX -->
<section class="aureolux-checkout-section">
  <div class="container">
    <div class="checkout-wrapper">
      
      <!-- Header del Checkout -->
      <div class="checkout-header">
        <h2>🚀 Finalizar Reserva AUREOLUX</h2>
        <p class="checkout-subtitle">Completa tu información para asegurar tu máscara LED</p>
        
        <!-- Progreso visual -->
        <div class="checkout-progress">
          <div class="progress-step completed">
            <span class="step-number">1</span>
            <span class="step-label">Producto</span>
          </div>
          <div class="progress-line"></div>
          <div class="progress-step active">
            <span class="step-number">2</span>
            <span class="step-label">Pago</span>
          </div>
          <div class="progress-line"></div>
          <div class="progress-step">
            <span class="step-number">3</span>
            <span class="step-label">Confirmación</span>
          </div>
        </div>
      </div>

      <form name="checkout" method="post" class="checkout woocommerce-checkout aureolux-checkout-form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

        <div class="checkout-content">
          
          <!-- Columna izquierda: Formulario -->
          <div class="checkout-form-section">
            
            <?php if ( $checkout->get_checkout_fields() ) : ?>
              <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

              <div class="customer-details-section">
                <h3>📋 Información de Facturación</h3>
                <div class="billing-fields">
                  <?php do_action( 'woocommerce_checkout_billing' ); ?>
                </div>

                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                  <h3>📦 Información de Envío</h3>
                  <div class="shipping-fields">
                    <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                  </div>
                <?php endif; ?>
              </div>

              <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            <?php endif; ?>

          </div>

          <!-- Columna derecha: Resumen del pedido -->
          <div class="checkout-summary-section">
            
            <!-- Resumen del producto -->
            <div class="order-summary">
              <h3>💎 Tu Reserva</h3>
              
              <div class="product-preview">
                <div class="led-mask-checkout">
                  <div class="mask-glow-checkout"></div>
                </div>
                <div class="product-info">
                  <h4>Máscara LED Facial AUREOLUX</h4>
                  <p>Tecnología FDA • 7 Colores LED</p>
                </div>
              </div>

              <!-- Detalles del pedido -->
              <?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
              
              <div class="order-review-section">
                <h4>📊 Desglose del Pedido</h4>
                
                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
                <div id="order_review" class="woocommerce-checkout-review-order">
                  <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>
                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
              </div>

              <!-- Garantías y certificaciones -->
              <div class="checkout-guarantees">
                <div class="guarantee-item">
                  <span class="guarantee-icon">🔒</span>
                  <span>Pago 100% Seguro</span>
                </div>
                <div class="guarantee-item">
                  <span class="guarantee-icon">🚚</span>
                  <span>Envío Gratis</span>
                </div>
                <div class="guarantee-item">
                  <span class="guarantee-icon">↩️</span>
                  <span>30 días devolución</span>
                </div>
                <div class="guarantee-item">
                  <span class="guarantee-icon">🏆</span>
                  <span>Garantía 2 años</span>
                </div>
              </div>

            </div>

          </div>

        </div>

      </form>

    </div>
  </div>
</section>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
