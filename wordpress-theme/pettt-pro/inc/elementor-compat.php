<?php
if (!defined('ABSPATH')) { exit; }

add_action('after_setup_theme', function () {
    add_theme_support('elementor');
    add_theme_support('elementor-header-footer-builder');
    add_theme_support('elementor-pro-theme-builder');
    foreach (['page','post','pettt_brand','pettt_food','pettt_service','pettt_video','pettt_explore'] as $type) {
        add_post_type_support($type, 'elementor');
    }
    if (!isset($GLOBALS['content_width'])) $GLOBALS['content_width'] = 1240;
}, 0);

add_action('elementor/theme/register_locations', function ($manager) {
    if (method_exists($manager, 'register_all_core_location')) $manager->register_all_core_location();
});

function ninjapet_is_elementor_editor_context() {
    return isset($_GET['elementor-preview']) || isset($_GET['elementor_library']) || isset($_GET['action']) && $_GET['action'] === 'elementor';
}

function ninjapet_is_elementor_built_page($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    return $post_id && get_post_meta($post_id, '_elementor_edit_mode', true);
}
