<?php
/**
 * Checkout Form - AUREOLUX Custom Template
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// Si el checkout está deshabilitado, mostrar mensaje
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}

// Obtener información del tier actual para mostrar en el checkout
$tier_info = function_exists('aureolux_get_tier_info') ? aureolux_get_tier_info() : array('tier' => 1, 'price' => 69, 'remaining' => 50, 'savings' => 80);
?>

<!-- Checkout Section con diseño AUREOLUX -->
<section class="aureolux-checkout-section">
  <div class="container">
    <div class="checkout-wrapper">
      
      <!-- Header del Checkout -->
      <div class="checkout-header">
        <h2>Finalizar Reserva AUREOLUX</h2>
        <p class="checkout-subtitle">Estás a un paso de conseguir tu máscara LED premium</p>
      </div>

      <!-- Resumen del Producto -->
      <div class="product-summary">
        <div class="product-info">
          <div class="product-image-mini">
            <div class="led-mask-mini">
              <div class="mask-glow-mini"></div>
            </div>
          </div>
          <div class="product-details">
            <h3>Máscara LED Facial AUREOLUX</h3>
            <p>Tecnología clínica certificada FDA • 219 LEDs médicos</p>
            <div class="price-breakdown">
              <div class="price-item">
                <span>Precio de reserva:</span>
                <strong><?php echo $tier_info ? $tier_info['price'] : 69; ?>€</strong>
              </div>
              <div class="price-item deposit">
                <span>Depósito hoy:</span>
                <strong>29€</strong>
              </div>
              <div class="price-item remaining">
                <span>Pendiente al envío:</span>
                <strong><?php echo $tier_info ? ($tier_info['price'] - 29) : 40; ?>€</strong>
              </div>
            </div>
            <div class="savings-badge">
              ¡Ahorras <?php echo $tier_info ? $tier_info['savings'] : 80; ?>€ con esta oferta!
            </div>
          </div>
        </div>
      </div>

      <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

        <?php if ( $checkout->get_checkout_fields() ) : ?>

          <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

          <div class="checkout-form-wrapper">
            
            <!-- Información del Cliente -->
            <div class="customer-details">
              <h3>Información de Contacto</h3>
              
              <div class="woocommerce-billing-fields">
                <?php do_action( 'woocommerce_checkout_billing' ); ?>
              </div>

              <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            </div>

            <!-- Resumen del Pedido -->
            <div class="order-review-wrapper">
              <h3 id="order_review_heading">Resumen del Pedido</h3>
              <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
              
              <div id="order_review" class="woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
              </div>
              
              <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </div>

          </div>

        <?php endif; ?>

      </form>

      <!-- Garantías y Seguridad -->
      <div class="checkout-guarantees">
        <div class="guarantee-item">
          <span class="guarantee-icon">🔒</span>
          <span>Pago 100% Seguro</span>
        </div>
        <div class="guarantee-item">
          <span class="guarantee-icon">↩️</span>
          <span>30 días de garantía</span>
        </div>
        <div class="guarantee-item">
          <span class="guarantee-icon">🚚</span>
          <span>Envío gratuito</span>
        </div>
        <div class="guarantee-item">
          <span class="guarantee-icon">✅</span>
          <span>Certificado FDA</span>
        </div>
      </div>

    </div>
  </div>
</section>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
