<?php
/**
 * Template Name: Checkout Page - AUREOLUX
 * 
 * Plantilla personalizada para la página de checkout de WooCommerce
 * que mantiene el diseño y branding de AUREOLUX
 */

get_header(); ?>

<main class="main-content">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        
        <div class="checkout-page-content">
            <?php the_content(); ?>
        </div>
        
        <?php
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
