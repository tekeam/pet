<?php
if (!defined('ABSPATH')) { exit; }

add_action('after_setup_theme', function () {
    add_image_size('pettt-card', 520, 380, true);
    add_image_size('pettt-hero', 1400, 800, true);
});

add_action('init', function () {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('template_redirect', 'rest_output_link_header', 11);
});

add_filter('style_loader_tag', function ($html, $handle, $href, $media) {
    if (is_admin()) return $html;
    if (strpos($handle, 'pettt-pro-font') !== false) {
        return '<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link rel="stylesheet" href="'.esc_url($href).'" media="print" onload="this.media=\'all\'"><noscript><link rel="stylesheet" href="'.esc_url($href).'"></noscript>';
    }
    return $html;
}, 10, 4);

add_filter('script_loader_tag', function ($tag, $handle, $src) {
    if (is_admin()) return $tag;
    if ($handle === 'pettt-pro-main') return '<script src="'.esc_url($src).'" defer></script>';
    return $tag;
}, 10, 3);

add_filter('wp_get_attachment_image_attributes', function ($attr) {
    if (!isset($attr['loading'])) $attr['loading'] = 'lazy';
    $attr['decoding'] = 'async';
    return $attr;
});

add_action('wp_head', function () {
    echo '<style id="pettt-critical-css">body{margin:0;font-family:Vazirmatn,Arial,sans-serif;background:#f8f7fc;color:#171321;direction:rtl}.pettt-header{position:sticky;top:0;z-index:50;background:rgba(255,255,255,.9);backdrop-filter:blur(18px)}.pettt-container{width:min(1220px,calc(100% - 32px));margin:auto}.pettt-hero-grid{background:linear-gradient(135deg,#2e1065,#7c3aed);color:#fff}</style>';
}, 1);

add_filter('wp_headers', function ($headers) {
    if (!is_admin()) {
        $headers['X-Content-Type-Options'] = 'nosniff';
        $headers['Referrer-Policy'] = 'strict-origin-when-cross-origin';
    }
    return $headers;
});

add_action('wp_enqueue_scripts', function () {
    if (!is_admin()) {
        wp_dequeue_style('global-styles');
        wp_dequeue_style('classic-theme-styles');
    }
}, 99);

add_filter('the_content', function ($content) {
    if (is_admin() || !is_singular()) return $content;
    return preg_replace('/<img(.*?)>/i', '<img$1 loading="lazy" decoding="async">', $content);
}, 12);
