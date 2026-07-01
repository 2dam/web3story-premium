<?php
if (!defined('ABSPATH')) exit;

function web3story_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', ['height'=>80,'width'=>260,'flex-height'=>true,'flex-width'=>true]);
    add_theme_support('responsive-embeds');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form','gallery','caption','style','script']);
    register_nav_menus(['primary'=>'Primary Menu','footer'=>'Footer Menu']);
}
add_action('after_setup_theme','web3story_setup');

add_image_size('web3-featured',1400,800,true);
add_image_size('web3-card',700,420,true);

function web3story_enqueue() {
    wp_enqueue_style('parent', get_template_directory_uri().'/style.css');
    $css = ['base','layout','header','home','article','sidebar','button','card','progress','toc','dark','dark-toggle','footer','mobile'];
    foreach ($css as $file) {
        $path = get_stylesheet_directory().'/assets/css/'.$file.'.css';
        if (file_exists($path)) {
            wp_enqueue_style('web3-'.$file, get_stylesheet_directory_uri().'/assets/css/'.$file.'.css', ['parent'], filemtime($path));
        }
    }
    $js = ['progress','toc','darkmode','app'];
    foreach ($js as $file) {
        $path = get_stylesheet_directory().'/assets/js/'.$file.'.js';
        if (file_exists($path)) {
            wp_enqueue_script('web3-'.$file, get_stylesheet_directory_uri().'/assets/js/'.$file.'.js', [], filemtime($path), true);
        }
    }
}
add_action('wp_enqueue_scripts','web3story_enqueue');

function web3_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $words = str_word_count(wp_strip_all_tags($content));
    return max(1, ceil($words/220)).' min read';
}
add_shortcode('rt_reading_time','web3_reading_time');

function web3_set_views($id) {
    $views = get_post_meta($id,'views',true);
    update_post_meta($id,'views', empty($views) ? 1 : $views+1);
}
add_action('wp', function() { if (is_single()) web3_set_views(get_the_ID()); });

function web3_excerpt_length() { return 28; }
add_filter('excerpt_length','web3_excerpt_length');

remove_action('wp_head','print_emoji_detection_script',7);
remove_action('wp_print_styles','print_emoji_styles');

add_action('wp_enqueue_scripts', function() { wp_dequeue_style('global-styles'); }, 100);

add_filter('wp_lazy_loading_enabled','__return_true');

add_filter('body_class', function($classes) { $classes[]='web3story'; return $classes; });

function web3_widgets() {
    register_sidebar(['name'=>'Sidebar','id'=>'sidebar','before_widget'=>'<section class="widget">','after_widget'=>'</section>','before_title'=>'<h3 class="widget-title">','after_title'=>'</h3>']);
}
add_action('widgets_init','web3_widgets');
