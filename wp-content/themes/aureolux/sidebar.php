<?php
/**
 * The sidebar containing the main widget area
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <?php dynamic_sidebar('sidebar-1'); ?>
    
    <?php if (!is_active_sidebar('sidebar-1')) : ?>
        <!-- Default widgets when no widgets are added -->
        <div class="widget">
            <h2 class="widget-title">Buscar</h2>
            <?php get_search_form(); ?>
        </div>
        
        <div class="widget">
            <h2 class="widget-title">Entradas Recientes</h2>
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
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'title_li'   => '',
                )); ?>
            </ul>
        </div>
        
        <div class="widget">
            <h2 class="widget-title">Archivo</h2>
            <ul>
                <?php wp_get_archives(array(
                    'type'  => 'monthly',
                    'limit' => 12,
                )); ?>
            </ul>
        </div>
    <?php endif; ?>
</aside>
