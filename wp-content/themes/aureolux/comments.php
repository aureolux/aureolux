<?php
/**
 * The template for displaying comments
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('Un comentario en &ldquo;%1$s&rdquo;', 'custom-theme'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    esc_html(_nx(
                        '%1$s comentario en &ldquo;%2$s&rdquo;',
                        '%1$s comentarios en &ldquo;%2$s&rdquo;',
                        $comment_count,
                        'comments title',
                        'custom-theme'
                    )),
                    number_format_i18n($comment_count),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()) :
        ?>
            <p class="no-comments"><?php esc_html_e('Los comentarios están cerrados.', 'custom-theme'); ?></p>
        <?php
        endif;

    endif; // Check for have_comments().

    comment_form();
    ?>

</div><!-- #comments -->
