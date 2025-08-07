<?php
/**
 * Cart Page - AUREOLUX Custom Template
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_before_cart' ); ?>

<!-- Cart Section con diseño AUREOLUX -->
<section class="aureolux-cart-section">
  <div class="container">
    <div class="cart-wrapper">
      
      <!-- Header del Carrito -->
      <div class="cart-header">
        <h2>Tu Reserva AUREOLUX</h2>
        <p class="cart-subtitle">Revisa tu selección antes de continuar</p>
      </div>

      <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
        <?php do_action( 'woocommerce_before_cart_table' ); ?>

        <div class="cart-content">
          
          <!-- Productos en el carrito -->
          <div class="cart-items">
            <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
              $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
              $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

              if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                ?>
                
                <div class="cart-item">
                  <div class="item-image">
                    <div class="led-mask-cart">
                      <div class="mask-glow-cart"></div>
                    </div>
                  </div>
                  
                  <div class="item-details">
                    <h3><?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?></h3>
                    <p class="item-description">Máscara LED Facial Premium • Tecnología FDA</p>
                    
                    <div class="item-meta">
                      <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                    </div>
                  </div>
                  
                  <div class="item-quantity">
                    <?php
                    if ( $_product->is_sold_individually() ) {
                      $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                    } else {
                      $product_quantity = woocommerce_quantity_input(
                        array(
                          'input_name'   => "cart[{$cart_item_key}][qty]",
                          'input_value'  => $cart_item['quantity'],
                          'max_value'    => $_product->get_max_purchase_quantity(),
                          'min_value'    => '0',
                          'product_name' => $_product->get_name(),
                        ),
                        $_product,
                        false
                      );
                    }
                    echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                    ?>
                  </div>
                  
                  <div class="item-remove">
                    <?php
                    echo apply_filters(
                      'woocommerce_cart_item_remove_link',
                      sprintf(
                        '<a href="%s" class="remove-item" aria-label="%s" data-product_id="%s" data-product_sku="%s">×</a>',
                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                        esc_html__( 'Remove this item', 'woocommerce' ),
                        esc_attr( $product_id ),
                        esc_attr( $_product->get_sku() )
                      ),
                      $cart_item_key
                    );
                    ?>
                  </div>
                </div>
                
                <?php
              }
            } ?>
          </div>

          <!-- Resumen del carrito -->
          <div class="cart-summary">
            <h3>Resumen de la Reserva</h3>
            
            <div class="cart-totals">
              <?php do_action( 'woocommerce_before_cart_totals' ); ?>
              
              <div class="cart-totals-inner">
                <?php wc_cart_totals_subtotal_html(); ?>
                
                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                  <div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <span><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
                    <span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
                  </div>
                <?php endforeach; ?>
                
                <?php wc_cart_totals_shipping_html(); ?>
                <?php wc_cart_totals_fee_html(); ?>
                <?php wc_cart_totals_taxes_html(); ?>
                
                <div class="order-total">
                  <span><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
                  <span><?php wc_cart_totals_order_total_html(); ?></span>
                </div>
              </div>
              
              <?php do_action( 'woocommerce_after_cart_totals' ); ?>
            </div>

            <!-- Botón proceder al checkout -->
            <div class="proceed-to-checkout">
              <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn-primary btn-large btn-full checkout-button">
                Proceder al Pago
                <span class="btn-subtitle">Pago seguro con depósito</span>
              </a>
            </div>
          </div>

        </div>

        <div class="cart-actions">
          <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
          <?php do_action( 'woocommerce_cart_actions' ); ?>
          <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
        </div>

        <?php do_action( 'woocommerce_after_cart_table' ); ?>
      </form>

      <!-- Garantías -->
      <div class="cart-guarantees">
        <div class="guarantee-item">
          <span class="guarantee-icon">🔒</span>
          <span>Pago Seguro</span>
        </div>
        <div class="guarantee-item">
          <span class="guarantee-icon">🚚</span>
          <span>Envío Gratis</span>
        </div>
        <div class="guarantee-item">
          <span class="guarantee-icon">↩️</span>
          <span>30 días garantía</span>
        </div>
        <div class="guarantee-item">
          <span class="guarantee-icon">✅</span>
          <span>Certificado FDA</span>
        </div>
      </div>

    </div>
  </div>
</section>

<?php do_action( 'woocommerce_after_cart' ); ?>
