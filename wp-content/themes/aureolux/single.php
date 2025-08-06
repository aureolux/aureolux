<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>

<main class="site-main">
    <div class="content-area">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
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

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'custom-theme'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <?php if (has_tag()) : ?>
                    <footer class="entry-footer">
                        <div class="tag-links">
                            <?php the_tags('Etiquetas: ', ', ', ''); ?>
                        </div>
                    </footer>
                <?php endif; ?>
            </article>

            <nav class="post-navigation">
                <div class="nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    
                    if ($prev_post) :
                    ?>
                        <div class="nav-previous">
                            <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                &laquo; <?php echo get_the_title($prev_post->ID); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($next_post) : ?>
                        <div class="nav-next">
                            <a href="<?php echo get_permalink($next_post->ID); ?>">
                                <?php echo get_the_title($next_post->ID); ?> &raquo;
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

            <?php
            // If comments are open or we have at least one comment, load up the comment template
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </div>

    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
