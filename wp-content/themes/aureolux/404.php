<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('¡Oops! Página no encontrada', 'custom-theme'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e('Parece que no se pudo encontrar lo que estabas buscando. Tal vez una búsqueda pueda ayudar.', 'custom-theme'); ?></p>

                <?php get_search_form(); ?>

                <div class="widget">
                    <h2 class="widget-title">Páginas más populares</h2>
                    <ul>
                        <?php
                        wp_list_pages(array(
                            'orderby' => 'menu_order',
                            'title_li' => '',
                            'number' => 5,
                        ));
                        ?>
                    </ul>
                </div>

                <div class="widget">
                    <h2 class="widget-title">Entradas recientes</h2>
                    <ul>
                        <?php
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish'
                        ));
                        foreach($recent_posts as $post) :
                        ?>
                            <li>
                                <a href="<?php echo get_permalink($post['ID']); ?>">
                                    <?php echo $post['post_title']; ?>
                                </a>
                            </li>
                        <?php endforeach; wp_reset_query(); ?>
                    </ul>
                </div>

                <div class="widget">
                    <h2 class="widget-title">Categorías</h2>
                    <ul>
                        <?php wp_list_categories(array(
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'title_li' => '',
                            'number' => 10,
                        )); ?>
                    </ul>
                </div>
            </div>
        </section>
    </div>

    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
