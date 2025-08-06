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
    wp_enqueue_style('custom-theme-style', get_stylesheet_uri(), array(), '1.0.0');

    wp_enqueue_script('custom-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true);

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
