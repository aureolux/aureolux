<?php
/**
 * Theme functions and definitions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function custom_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location
    register_nav_menus(array(
        'menu-1' => esc_html__('Primary', 'custom-theme'),
    ));

    // Switch default core markup for search form, comment form, and comments
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));
}
add_action('after_setup_theme', 'custom_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet
 */
function custom_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters('custom_theme_content_width', 640);
}
add_action('after_setup_theme', 'custom_theme_content_width', 0);

/**
 * Register widget area
 */
function custom_theme_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'custom-theme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'custom-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'custom_theme_widgets_init');

/**
 * Enqueue scripts and styles
 */
function custom_theme_scripts() {
    // Cargar el CSS principal del tema
    wp_enqueue_style('aureolux-style', get_stylesheet_uri(), array(), '1.0.0');

    // Cargar el JavaScript principal de AUREOLUX
    wp_enqueue_script('aureolux-main', get_template_directory_uri() . '/js/aureolux-main.js', array(), '1.0.0', true);
    
    // Localizar script para AJAX
    wp_localize_script('aureolux-main', 'aureolux_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('aureolux_nonce')
    ));

    // Cargar script de navegación si existe
    if (file_exists(get_template_directory() . '/js/navigation.js')) {
        wp_enqueue_script('custom-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'custom_theme_scripts');

/**
 * Custom template tags for this theme
 */

/**
 * Prints HTML with meta information for the current post-date/time
 */
function custom_theme_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf($time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        esc_html_x('Posted on %s', 'post date', 'custom-theme'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>';
}

/**
 * Prints HTML with meta information for the current author
 */
function custom_theme_posted_by() {
    $byline = sprintf(
        esc_html_x('by %s', 'post author', 'custom-theme'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>';
}

/**
 * Prints HTML with meta information for the categories, tags and comments
 */
function custom_theme_entry_footer() {
    // Hide category and tag text for pages
    if ('post' === get_post_type()) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list(esc_html__(', ', 'custom-theme'));
        if ($categories_list) {
            printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'custom-theme') . '</span>', $categories_list);
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'custom-theme'));
        if ($tags_list) {
            printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'custom-theme') . '</span>', $tags_list);
        }
    }

    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'custom-theme'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            )
        );
        echo '</span>';
    }

    edit_post_link(
        sprintf(
            wp_kses(
                __('Edit <span class="screen-reader-text">%s</span>', 'custom-theme'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<span class="edit-link">',
        '</span>'
    );
}

/**
 * Custom excerpt length
 */
function custom_theme_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'custom_theme_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function custom_theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'custom_theme_excerpt_more');

/**
 * Add custom CSS for admin
 */
function custom_theme_admin_style() {
    wp_enqueue_style('custom-admin-styles', get_template_directory_uri() . '/admin-style.css');
}
add_action('admin_enqueue_scripts', 'custom_theme_admin_style');

/**
 * ================ AUREOLUX WOOCOMMERCE INTEGRATION ================
 * Sistema de preventa escalonado con depósitos
 */

// Verificar que WooCommerce esté activo
if (class_exists('WooCommerce')) {

    /**
     * Crear producto AUREOLUX automáticamente si no existe
     */
    function aureolux_create_product() {
        // Verificar si ya existe el producto
        $existing_product = get_posts(array(
            'post_type' => 'product',
            'meta_query' => array(
                array(
                    'key' => '_aureolux_mask',
                    'value' => 'yes'
                )
            )
        ));

        if (empty($existing_product)) {
            // Crear el producto
            $product_data = array(
                'post_title' => 'Máscara LED Facial AUREOLUX',
                'post_content' => 'Máscara LED facial premium con tecnología clínica certificada FDA. Incluye 219 LEDs médicos con 3 tipos de luz para tratamiento antiedad, control de acné y regeneración profunda.',
                'post_status' => 'publish',
                'post_type' => 'product'
            );

            $product_id = wp_insert_post($product_data);

            if ($product_id) {
                // Configurar como producto simple
                wp_set_object_terms($product_id, 'simple', 'product_type');
                
                // Meta datos del producto
                update_post_meta($product_id, '_aureolux_mask', 'yes');
                update_post_meta($product_id, '_visibility', 'visible');
                update_post_meta($product_id, '_stock_status', 'instock');
                update_post_meta($product_id, '_manage_stock', 'yes');
                update_post_meta($product_id, '_stock', 250); // Total de máscaras en preventa
                update_post_meta($product_id, '_sold_individually', 'yes');
                update_post_meta($product_id, '_virtual', 'no');
                update_post_meta($product_id, '_downloadable', 'no');
                
                // Precio inicial (se calculará dinámicamente)
                update_post_meta($product_id, '_regular_price', '69');
                update_post_meta($product_id, '_price', '69');
                
                // Contador de ventas por tramo
                update_post_meta($product_id, '_aureolux_tier1_sold', 0); // 0-50
                update_post_meta($product_id, '_aureolux_tier2_sold', 0); // 51-150
                update_post_meta($product_id, '_aureolux_tier3_sold', 0); // 151-250
            }
        }
    }
    add_action('init', 'aureolux_create_product');

    /**
     * Obtener el precio actual según las ventas
     */
    function aureolux_get_current_price() {
        $product_id = aureolux_get_product_id();
        if (!$product_id) return 69;

        $tier1_sold = get_post_meta($product_id, '_aureolux_tier1_sold', true) ?: 0;
        $tier2_sold = get_post_meta($product_id, '_aureolux_tier2_sold', true) ?: 0;
        $tier3_sold = get_post_meta($product_id, '_aureolux_tier3_sold', true) ?: 0;

        $total_sold = $tier1_sold + $tier2_sold + $tier3_sold;

        if ($total_sold < 50) {
            return 69; // Primeras 50
        } elseif ($total_sold < 150) {
            return 99; // Siguientes 100
        } elseif ($total_sold < 250) {
            return 129; // Siguientes 100
        } else {
            return false; // Preventa cerrada
        }
    }

    /**
     * Obtener información del tramo actual
     */
    function aureolux_get_tier_info() {
        $product_id = aureolux_get_product_id();
        if (!$product_id) return false;

        $tier1_sold = get_post_meta($product_id, '_aureolux_tier1_sold', true) ?: 0;
        $tier2_sold = get_post_meta($product_id, '_aureolux_tier2_sold', true) ?: 0;
        $tier3_sold = get_post_meta($product_id, '_aureolux_tier3_sold', true) ?: 0;

        $total_sold = $tier1_sold + $tier2_sold + $tier3_sold;

        if ($total_sold < 50) {
            return array(
                'tier' => 1,
                'price' => 69,
                'remaining' => 50 - $total_sold,
                'savings' => 80,
                'message' => 'Solo quedan ' . (50 - $total_sold) . ' unidades a este precio'
            );
        } elseif ($total_sold < 150) {
            return array(
                'tier' => 2,
                'price' => 99,
                'remaining' => 150 - $total_sold,
                'savings' => 50,
                'message' => 'Solo quedan ' . (150 - $total_sold) . ' unidades a este precio'
            );
        } elseif ($total_sold < 250) {
            return array(
                'tier' => 3,
                'price' => 129,
                'remaining' => 250 - $total_sold,
                'savings' => 20,
                'message' => 'Solo quedan ' . (250 - $total_sold) . ' unidades a este precio'
            );
        } else {
            return array(
                'tier' => 0,
                'price' => 0,
                'remaining' => 0,
                'savings' => 0,
                'message' => 'Preventa cerrada'
            );
        }
    }

    /**
     * Obtener ID del producto AUREOLUX
     */
    function aureolux_get_product_id() {
        $products = get_posts(array(
            'post_type' => 'product',
            'meta_query' => array(
                array(
                    'key' => '_aureolux_mask',
                    'value' => 'yes'
                )
            )
        ));

        return !empty($products) ? $products[0]->ID : false;
    }

    /**
     * Actualizar precio dinámicamente
     */
    function aureolux_update_product_price($cart) {
        if (is_admin() && !defined('DOING_AJAX')) return;

        foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            $product_id = $cart_item['product_id'];
            
            if (get_post_meta($product_id, '_aureolux_mask', true) === 'yes') {
                $current_price = aureolux_get_current_price();
                if ($current_price) {
                    $cart_item['data']->set_price($current_price);
                }
            }
        }
    }
    add_action('woocommerce_before_calculate_totals', 'aureolux_update_product_price', 10, 1);

    /**
     * Actualizar contador al completar pedido
     */
    function aureolux_update_sales_counter($order_id) {
        $order = wc_get_order($order_id);
        
        foreach ($order->get_items() as $item) {
            $product_id = $item->get_product_id();
            
            if (get_post_meta($product_id, '_aureolux_mask', true) === 'yes') {
                $tier_info = aureolux_get_tier_info();
                
                if ($tier_info['tier'] == 1) {
                    $current = get_post_meta($product_id, '_aureolux_tier1_sold', true) ?: 0;
                    update_post_meta($product_id, '_aureolux_tier1_sold', $current + 1);
                } elseif ($tier_info['tier'] == 2) {
                    $current = get_post_meta($product_id, '_aureolux_tier2_sold', true) ?: 0;
                    update_post_meta($product_id, '_aureolux_tier2_sold', $current + 1);
                } elseif ($tier_info['tier'] == 3) {
                    $current = get_post_meta($product_id, '_aureolux_tier3_sold', true) ?: 0;
                    update_post_meta($product_id, '_aureolux_tier3_sold', $current + 1);
                }
            }
        }
    }
    add_action('woocommerce_order_status_completed', 'aureolux_update_sales_counter');
    add_action('woocommerce_order_status_processing', 'aureolux_update_sales_counter');

    /**
     * AJAX para agregar al carrito desde la landing page
     */
    function aureolux_add_to_cart_ajax() {
        // Verificar nonce de seguridad
        if (!wp_verify_nonce($_POST['nonce'], 'aureolux_nonce')) {
            wp_send_json_error('Acceso denegado');
        }
        
        $product_id = aureolux_get_product_id();
        
        if (!$product_id) {
            wp_send_json_error('Producto no encontrado');
        }

        $tier_info = aureolux_get_tier_info();
        
        if ($tier_info['tier'] == 0) {
            wp_send_json_error('Preventa cerrada');
        }

        // Limpiar carrito (solo una máscara por pedido)
        WC()->cart->empty_cart();
        
        // Agregar producto
        $cart_item_key = WC()->cart->add_to_cart($product_id, 1);
        
        if ($cart_item_key) {
            wp_send_json_success(array(
                'message' => 'Producto agregado al carrito',
                'cart_url' => wc_get_cart_url(),
                'checkout_url' => wc_get_checkout_url(),
                'tier_info' => $tier_info
            ));
        } else {
            wp_send_json_error('Error al agregar al carrito');
        }
    }
    add_action('wp_ajax_aureolux_add_to_cart', 'aureolux_add_to_cart_ajax');
    add_action('wp_ajax_nopriv_aureolux_add_to_cart', 'aureolux_add_to_cart_ajax');

    /**
     * AJAX para obtener información actual del tier
     */
    function aureolux_get_tier_info_ajax() {
        // Verificar nonce de seguridad
        if (!wp_verify_nonce($_POST['nonce'], 'aureolux_nonce')) {
            wp_send_json_error('Acceso denegado');
        }
        
        $tier_info = aureolux_get_tier_info();
        wp_send_json_success($tier_info);
    }
    add_action('wp_ajax_aureolux_get_tier_info', 'aureolux_get_tier_info_ajax');
    add_action('wp_ajax_nopriv_aureolux_get_tier_info', 'aureolux_get_tier_info_ajax');

    /**
     * Personalizar checkout para mantener al usuario en la web
     */
    function aureolux_customize_checkout() {
        // Remover campos innecesarios del checkout
        add_filter('woocommerce_checkout_fields', 'aureolux_remove_checkout_fields');
        
        // Personalizar textos
        add_filter('woocommerce_order_button_text', function() {
            return 'Confirmar Reserva (29€)';
        });
    }
    add_action('init', 'aureolux_customize_checkout');

    /**
     * Remover campos innecesarios del checkout
     */
    function aureolux_remove_checkout_fields($fields) {
        // Mantener solo campos esenciales
        unset($fields['billing']['billing_company']);
        unset($fields['billing']['billing_address_2']);
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['billing_postcode']);
        unset($fields['billing']['billing_country']);
        unset($fields['billing']['billing_state']);
        
        // Hacer campos requeridos
        $fields['billing']['billing_first_name']['required'] = true;
        $fields['billing']['billing_last_name']['required'] = true;
        $fields['billing']['billing_email']['required'] = true;
        $fields['billing']['billing_phone']['required'] = true;
        
        return $fields;
    }

} // Fin verificación WooCommerce
