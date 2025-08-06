<?php
/**
 * The main template file
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
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
                            <?php if (has_category()) : ?>
                                <span class="cat-links">
                                    en <?php the_category(', '); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </header>

                    <div class="entry-content">
                        <?php
                        if (is_single()) {
                            the_content();
                        } else {
                            the_excerpt();
                            echo '<a href="' . get_permalink() . '" class="btn">Leer más</a>';
                        }
                        ?>
                    </div>

                    <?php if (is_single() && has_tag()) : ?>
                        <footer class="entry-footer">
                            <div class="tag-links">
                                <?php the_tags('Etiquetas: ', ', ', ''); ?>
                            </div>
                        </footer>
                    <?php endif; ?>
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
            <article class="post">
                <header class="entry-header">
                    <h2 class="entry-title">No se encontraron entradas</h2>
                </header>
                <div class="entry-content">
                    <p>Lo sentimos, no hay contenido disponible en este momento.</p>
                </div>
            </article>
        <?php endif; ?>
    </div>

    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
