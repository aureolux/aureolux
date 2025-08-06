<?php
/**
 * The template for displaying search results pages
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                printf(esc_html__('Resultados de búsqueda para: %s', 'custom-theme'), '<span>' . get_search_query() . '</span>');
                ?>
            </h1>
        </header>

        <?php if (have_posts()) : ?>

            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="entry-meta">
                            <span class="posted-on">
                                Publicado el <?php echo get_the_date(); ?>
                            </span>
                            <span class="byline">
                                por <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                            </span>
                        </div>
                    </header>

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="btn">Leer más</a>
                    </div>
                </article>
            <?php endwhile; ?>

            <div class="pagination">
                <?php
                the_posts_pagination(array(
                    'prev_text' => '&laquo; Anterior',
                    'next_text' => 'Siguiente &raquo;',
                ));
                ?>
            </div>

        <?php else : ?>
            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('No se encontraron resultados', 'custom-theme'); ?></h1>
                </header>

                <div class="page-content">
                    <p><?php esc_html_e('Lo sentimos, pero no se encontraron resultados para tu búsqueda. Intenta con palabras clave diferentes.', 'custom-theme'); ?></p>
                    
                    <?php get_search_form(); ?>
                </div>
            </section>
        <?php endif; ?>
    </div>

    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
